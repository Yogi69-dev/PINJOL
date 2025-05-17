<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Auth::user()->loans()->latest()->paginate(10);
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('loans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:100000|max:100000000',
            'duration' => 'required|integer|min:1|max:24',
            'purpose' => 'required|string|max:500',
        ]);

        // Hitung bunga sederhana (2% per bulan)
        $interestRate = 0.02;
        $totalInterest = $validated['amount'] * $interestRate * $validated['duration'];
        $monthlyPayment = ($validated['amount'] + $totalInterest) / $validated['duration'];

        $loan = Loan::create([
            'user_id' => Auth::id(),
            'amount' => $validated['amount'],
            'duration' => $validated['duration'],
            'interest_rate' => $interestRate,
            'monthly_payment' => $monthlyPayment,
            'purpose' => $validated['purpose'],
            'status' => 'pending',
        ]);

        return redirect()->route('loans.show', $loan)->with('success', 'Pinjaman berhasil diajukan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        // Authorization - hanya pemilik pinjaman yang bisa melihat
        if ($loan->user_id !== Auth::id()) {
            abort(403);
        }

        return view('loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        // Authorization - hanya pemilik pinjaman dengan status pending yang bisa edit
        if ($loan->user_id !== Auth::id() || $loan->status !== 'pending') {
            abort(403);
        }

        return view('loans.edit', compact('loan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        // Authorization
        if ($loan->user_id !== Auth::id() || $loan->status !== 'pending') {
            abort(403);
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:100000|max:100000000',
            'duration' => 'required|integer|min:1|max:24',
            'purpose' => 'required|string|max:500',
        ]);

        // Hitung ulang jika amount atau duration berubah
        if ($loan->amount != $validated['amount'] || $loan->duration != $validated['duration']) {
            $interestRate = 0.02;
            $totalInterest = $validated['amount'] * $interestRate * $validated['duration'];
            $monthlyPayment = ($validated['amount'] + $totalInterest) / $validated['duration'];

            $loan->update([
                'amount' => $validated['amount'],
                'duration' => $validated['duration'],
                'interest_rate' => $interestRate,
                'monthly_payment' => $monthlyPayment,
                'purpose' => $validated['purpose'],
            ]);
        } else {
            $loan->update([
                'purpose' => $validated['purpose'],
            ]);
        }

        return redirect()->route('loans.show', $loan)->with('success', 'Pinjaman berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        // Authorization - hanya pemilik pinjaman dengan status pending yang bisa hapus
        if ($loan->user_id !== Auth::id() || $loan->status !== 'pending') {
            abort(403);
        }

        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Pinjaman berhasil dibatalkan!');
    }
}