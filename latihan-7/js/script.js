AOS.init();

document.addEventListener('DOMContentLoaded', function () {
    const navbarLinks = document.querySelectorAll('#navbar .nav-link');
    const sections = document.querySelectorAll('section');
    const offset = 68;

    function updateNavbar() {
        const scrollPosition = window.pageYOffset + offset;

        sections.forEach(function (section) {
            const sectionId = section.getAttribute('id');
            const navLink = document.querySelector(`.navbar-nav .nav-link[href="#${sectionId}"]`);

            const isSectionActive = section.offsetTop <= scrollPosition && section.offsetTop + section.offsetHeight > scrollPosition;

            navLink.classList.toggle('active', isSectionActive);
        });
    }

    window.addEventListener('scroll', updateNavbar);
    window.addEventListener('resize', updateNavbar);

    navbarLinks.forEach(function (link) {
        const targetId = link.getAttribute('href');
        const targetSection = document.querySelector(targetId);

        if (targetSection) {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const targetOffset = targetSection.offsetTop - offset;

                window.scrollTo({
                    top: targetOffset,
                    behavior: 'smooth'
                });

                navbarLinks.forEach(function (navLink) {
                    navLink.classList.remove('active');
                });

                link.classList.add('active');
            });
        }
    });

    window.addEventListener('scroll', () => {
        if (window.scrollY > 0) {
            navbar.classList.add('shadow-sm');
        } else {
            navbar.classList.remove('shadow-sm');
        }
    });

    updateNavbar();
});

document.querySelectorAll('.footer-link').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        const targetElement = document.querySelector(this.getAttribute('href'));
        if (targetElement) {
            const targetOffset = targetElement.offsetTop - 68;

            window.scrollTo({
                top: targetOffset,
                behavior: 'smooth'
            });
        }
    });
});

const scrollToTopBtn = document.getElementById('scrollToTopBtn');

function toggleScrollToTopButton() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        scrollToTopBtn.style.display = 'block';
    } else {
        scrollToTopBtn.style.display = 'none';
    }
}

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

window.addEventListener('scroll', toggleScrollToTopButton);

scrollToTopBtn.addEventListener('click', scrollToTop);