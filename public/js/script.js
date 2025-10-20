// script.js

let currentSlideIndex = 0;
const slidesContainer = document.querySelector('.slides-container');
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;
const dots = document.querySelectorAll('.dot');

function updateSlide(index) {
    // Menghitung seberapa jauh wadah harus digeser (translate)
    const offset = -index * 100; // 0%, -100%, -200%
    slidesContainer.style.transform = `translateX(${offset}%)`;
    
    // Memperbarui dot navigasi
    dots.forEach((dot, i) => {
        dot.classList.remove('active');
        if (i === index) {
            dot.classList.add('active');
        }
    });
}

function nextSlide() {
    if (currentSlideIndex < totalSlides - 1) {
        currentSlideIndex++;
        updateSlide(currentSlideIndex);
    } else {
        // Jika sudah slide terakhir, panggil fungsi finishOnboarding()
        finishOnboarding();
    }
}

function finishOnboarding() {
    alert("Selamat! Onboarding selesai. Redirect ke Halaman Utama...");
    // Di sini Anda bisa menambahkan logika redirect, misalnya:
    // window.location.href = '/home'; 
}

// Inisialisasi tampilan slide pertama
updateSlide(currentSlideIndex);

// Menambahkan event listener ke tombol next-btn
document.querySelectorAll('.next-btn').forEach(button => {
    button.addEventListener('click', nextSlide);
});