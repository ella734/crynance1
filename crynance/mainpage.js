document.addEventListener("DOMContentLoaded", () => {
    console.log("✅ Page Crynance chargée avec succès.");

    const getStartedBtn = document.querySelector('.btn');
    const heroSection = document.querySelector('.hero');

    if (getStartedBtn && heroSection) {
        getStartedBtn.addEventListener('click', (e) => {
            e.preventDefault();
            heroSection.scrollIntoView({ behavior: 'smooth' });
        });
    }

    const rows = document.querySelectorAll("table tbody tr");
    rows.forEach((row, index) => {
        row.style.opacity = "0";
        row.style.transform = "translateY(20px)";
        setTimeout(() => {
            row.style.transition = "all 0.5s ease-out";
            row.style.opacity = "1";
            row.style.transform = "translateY(0)";
        }, index * 150);
    });
});
