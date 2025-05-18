<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanAdminController extends Controller
{
    // Menampilkan daftar pinjaman
    public function index()
    {
        $loans = Loan::with('user')->latest()->paginate(10);
        return view('admin.loans.index', compact('loans'));
    }

    // Menampilkan detail pinjaman
    public function show(Loan $loan)
    {
        return view('admin.loans.show', compact('loan'));
    }

    // Menampilkan formulir untuk mengedit pinjaman
    public function edit(Loan $loan)
    {
        return view('admin.loans.edit', compact('loan'));
    }

    // Memperbarui data pinjaman
    public function update(Request $request, Loan $loan)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,paid',
        ]);

        $loan->update($request->only('status'));

        return redirect()->route('admin.loans.index')->with('success', 'Status pinjaman berhasil diperbarui.');
    }

    // Menghapus pinjaman
    public function destroy(Loan $loan)
    {
        $loan->delete();
        return redirect()->route('admin.loans.index')->with('success', 'Pinjaman berhasil dihapus.');
    }
}
