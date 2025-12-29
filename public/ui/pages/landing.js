// Navbar scroll effect
window.addEventListener('scroll', function () {
  const navbar = document.querySelector('.navbar-telkom');
  if (!navbar) return;

  if (window.scrollY > 50) navbar.classList.add('scrolled');
  else navbar.classList.remove('scrolled');
});

// Equipment card animation on scroll
function animateOnScroll() {
  const cards = document.querySelectorAll('.equipment-card');
  cards.forEach(card => {
    const cardPosition = card.getBoundingClientRect().top;
    const screenPosition = window.innerHeight / 1.2;

    if (cardPosition < screenPosition) {
      card.classList.add('animate__animated', 'animate__fadeInUp');
    }
  });
}
window.addEventListener('scroll', animateOnScroll);
animateOnScroll();

document.addEventListener('DOMContentLoaded', function () {
  // Date validation
  const borrowDate = document.getElementById('borrowDate');
  const returnDate = document.getElementById('returnDate');

  if (borrowDate && returnDate) {
    const today = new Date().toISOString().split('T')[0];
    borrowDate.min = today;

    borrowDate.addEventListener('change', function () {
      returnDate.min = this.value;

      const b = new Date(this.value);
      const maxReturn = new Date(b);
      maxReturn.setDate(maxReturn.getDate() + 7);
      returnDate.max = maxReturn.toISOString().split('T')[0];
    });
  }

  // Category filter UI
  document.querySelectorAll('.category-badge').forEach(badge => {
    badge.addEventListener('click', function () {
      document.querySelectorAll('.category-badge').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      console.log('Filter by category:', this.textContent);
    });
  });

  // Borrow form (demo)
  const borrowForm = document.getElementById('borrowForm');
  if (borrowForm) {
    borrowForm.addEventListener('submit', function (e) {
      e.preventDefault();
      alert('Permintaan peminjaman berhasil diajukan! Silakan tunggu konfirmasi dari admin.');

      const modalEl = document.getElementById('borrowModal');
      if (modalEl && window.bootstrap) {
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();
      }
      this.reset();
    });
  }

  // Search
  const searchInput = document.querySelector('input[placeholder*="Cari alat"]');
  if (searchInput) {
    searchInput.addEventListener('keyup', function (e) {
      const searchTerm = e.target.value.toLowerCase();
      const cards = document.querySelectorAll('.equipment-card');

      cards.forEach(card => {
        const title = (card.querySelector('.card-title')?.textContent || '').toLowerCase();
        const code = (card.querySelector('.text-muted')?.textContent || '').toLowerCase();
        const desc = (card.querySelectorAll('.card-text')[0]?.textContent || '').toLowerCase();

        const match = title.includes(searchTerm) || desc.includes(searchTerm) || code.includes(searchTerm);
        const col = card.closest('.col-md-6, .col-lg-4');
        if (col) col.style.display = match ? 'block' : 'none';
      });
    });
  }
});
