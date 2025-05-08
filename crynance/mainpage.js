document.addEventListener("DOMContentLoaded", () => {
    console.log("✅ Page Crynance chargée avec succès.");

    // Animation du bouton "Commencer"
    const getStartedBtn = document.querySelector('.btn');
    const heroSection = document.querySelector('.hero');

    if (getStartedBtn && heroSection) {
        getStartedBtn.addEventListener('click', (e) => {
            e.preventDefault();
            heroSection.scrollIntoView({ behavior: 'smooth' });
            pulseButton(getStartedBtn);
        });

        getStartedBtn.addEventListener('mouseover', () => {
            getStartedBtn.style.animation = 'pulse 1s infinite';
        });

        getStartedBtn.addEventListener('mouseout', () => {
            getStartedBtn.style.animation = '';
        });

        getStartedBtn.addEventListener('dblclick', () => {
            spinButton(getStartedBtn);
        });
    }

    // Animation des lignes du tableau
    const rows = document.querySelectorAll("table tbody tr");
    rows.forEach((row, index) => {
        row.style.opacity = "0";
        row.style.transform = "translateY(20px)";
        setTimeout(() => {
            row.style.transition = "all 0.5s ease-out";
            row.style.opacity = "1";
            row.style.transform = "translateY(0)";
            highlightRow(row);
        }, index * 150);

        row.addEventListener('mouseenter', () => {
            row.style.cursor = 'pointer';
            row.style.background = 'rgba(74, 144, 226, 0.2)';
            animateRowHover(row);
        });

        row.addEventListener('mouseleave', () => {
            row.style.background = '';
            row.style.animation = '';
        });

        row.addEventListener('click', () => {
            pulseRow(row);
        });

        row.addEventListener('dblclick', () => {
            flipRow(row);
        });
    });

    // Animation des liens de navigation
    const navLinks = document.querySelectorAll('nav ul li a');
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId) || document.querySelector(link.getAttribute('href'));
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: 'smooth' });
                pulseLink(link);
            } else {
                window.location.href = link.getAttribute('href');
            }
        });

        link.addEventListener('mouseenter', () => {
            link.style.animation = 'pulse 0.8s infinite';
        });

        link.addEventListener('mouseleave', () => {
            link.style.animation = '';
        });

        link.addEventListener('animationend', () => {
            link.style.animation = '';
        });
    });

    // Animation de la navigation au défilement
    const nav = document.querySelector('nav');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    });

    // Animation des sections et images au défilement
    const sections = document.querySelectorAll('.hero, .crypto-table, figure, fieldset, footer');
    window.addEventListener('scroll', () => {
        sections.forEach(section => {
            const rect = section.getBoundingClientRect();
            if (rect.top < window.innerHeight * 0.8) {
                section.style.opacity = '1';
                section.style.transform = 'translateY(0)';
                section.style.transition = 'all 0.8s ease-out';
                section.classList.add('animated');
            }
        });
    });

    // Animation des images
    const images = document.querySelectorAll('figure img');
    images.forEach(img => {
        img.addEventListener('mouseenter', () => {
            img.style.animation = 'bounce 0.5s infinite';
        });
        img.addEventListener('mouseleave', () => {
            img.style.animation = '';
        });
    });

    // Animation des conseils d'investissement
    const adviceItems = document.querySelectorAll('.advice-item');
    adviceItems.forEach((item, index) => {
        item.style.opacity = "0";
        item.style.transform = "translateX(-20px)";
        setTimeout(() => {
            item.style.transition = "all 0.5s ease-out";
            item.style.opacity = "1";
            item.style.transform = "translateX(0)";
            highlightAdvice(item);
        }, index * 200);

        item.addEventListener('mouseenter', () => {
            item.style.cursor = 'pointer';
            animateAdviceHover(item);
        });

        item.addEventListener('mouseleave', () => {
            item.style.animation = '';
        });

        item.addEventListener('click', () => {
            pulseAdvice(item);
        });

        item.addEventListener('dblclick', () => {
            flipAdvice(item);
        });
    });

    // Fonction personnalisée pour animer un bouton
    function pulseButton(element) {
        element.style.animation = 'pulse 0.3s ease';
        setTimeout(() => {
            element.style.animation = '';
        }, 300);
    }

    // Fonction personnalisée pour faire tourner un bouton
    function spinButton(element) {
        element.style.animation = 'spin 0.5s ease';
        setTimeout(() => {
            element.style.animation = '';
        }, 500);
    }

    // Fonction personnalisée pour animer une ligne
    function pulseRow(row) {
        row.style.animation = 'pulse 0.3s ease';
        setTimeout(() => {
            row.style.animation = '';
        }, 300);
    }

    // Fonction personnalisée pour retourner une ligne
    function flipRow(row) {
        row.style.animation = 'flip 0.5s ease';
        setTimeout(() => {
            row.style.animation = '';
        }, 500);
    }

    // Fonction personnalisée pour surligner une ligne
    function highlightRow(row) {
        row.style.transition = 'background 0.3s ease';
    }

    // Fonction personnalisée pour animer une ligne au survol
    function animateRowHover(row) {
        row.style.animation = 'glow 1.5s infinite';
    }

    // Fonction personnalisée pour animer un lien
    function pulseLink(link) {
        link.style.animation = 'pulse 0.3s ease';
        setTimeout(() => {
            link.style.animation = '';
        }, 300);
    }

    // Fonction personnalisée pour surligner un conseil
    function highlightAdvice(item) {
        item.style.transition = 'all 0.3s ease';
    }

    // Fonction personnalisée pour animer un conseil au survol
    function animateAdviceHover(item) {
        item.style.animation = 'pulse 1s infinite';
    }

    // Fonction personnalisée pour animer un conseil au clic
    function pulseAdvice(item) {
        item.style.animation = 'bounce 0.3s ease';
        setTimeout(() => {
            item.style.animation = '';
        }, 300);
    }

    // Fonction personnalisée pour retourner un conseil
    function flipAdvice(item) {
        item.style.animation = 'flip 0.5s ease';
        setTimeout(() => {
            item.style.animation = '';
        }, 500);
    }
});

// Animation CSS pour la rotation
const style = document.createElement('style');
style.innerHTML = `
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    @keyframes flip {
        0% { transform: perspective(400px) rotateY(0); }
        50% { transform: perspective(400px) rotateY(180deg); }
        100% { transform: perspective(400px) rotateY(360deg); }
    }
`;
document.head.appendChild(style);
