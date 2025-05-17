// Fungsi untuk menangani perubahan ukuran layar
function handleResize() {
  if (window.innerWidth < 768) {
    // Penyesuaian untuk mobile
    document.querySelectorAll('.card').forEach(card => {
      card.classList.add('shadow-none');
    });
  } else {
    document.querySelectorAll('.card').forEach(card => {
      card.classList.remove('shadow-none');
    });
  }
}

// Jalankan saat load dan resize
window.addEventListener('load', handleResize);
window.addEventListener('resize', handleResize);