AOS.init();

// Mendapatkan elemen navbar
const navbar = document.getElementById('navbar');

// Event listener untuk peristiwa scroll
window.addEventListener('scroll', () => {
    if (window.scrollY > 0) {
        // Jika terjadi scroll, tambahkan kelas shadow-sm
        navbar.classList.add('shadow-sm');
    } else {
        // Jika berada di atas, hapus kelas shadow-sm
        navbar.classList.remove('shadow-sm');
    }
});

const scrollToTopBtn = document.getElementById('scrollToTopBtn');

// Fungsi untuk menampilkan atau menyembunyikan tombol "Scroll to Top" berdasarkan posisi scroll
function toggleScrollToTopButton() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        scrollToTopBtn.style.display = 'block';
    } else {
        scrollToTopBtn.style.display = 'none';
    }
}

// Fungsi untuk melakukan scroll ke bagian atas halaman
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // Efek smooth scroll
    });
}

// Event listener untuk peristiwa scroll
window.addEventListener('scroll', toggleScrollToTopButton);

// Event listener untuk klik pada tombol "Scroll to Top"
scrollToTopBtn.addEventListener('click', scrollToTop);