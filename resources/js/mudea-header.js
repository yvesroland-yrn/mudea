
    // mudea-header.js — Header interactif MUDEA

document.addEventListener('DOMContentLoaded', function () {

    // --- Burger menu (mobile) ---
    const burgerBtn = document.getElementById('burgerBtn');
    const mainNav   = document.getElementById('mainNav');

    if (burgerBtn && mainNav) {
        burgerBtn.addEventListener('click', function () {
            mainNav.classList.toggle('open');
            burgerBtn.classList.toggle('active');
        });
    }

    // --- Dropdowns mobile (tap pour ouvrir) ---
    const dropdownItems = document.querySelectorAll('.nav-item.has-dropdown');

    dropdownItems.forEach(function (item) {
        const link = item.querySelector('.nav-link');
        link.addEventListener('click', function (e) {
            if (window.innerWidth <= 900) {
                e.preventDefault();
                item.classList.toggle('open');
            }
        });
    });

    // --- Barre de recherche ---
    const searchToggle = document.getElementById('searchToggle');
    const searchBar    = document.getElementById('searchBar');
    const searchClose  = document.getElementById('searchClose');
    const searchInput  = document.getElementById('searchInput');

    if (searchToggle && searchBar) {
        searchToggle.addEventListener('click', function () {
            searchBar.classList.toggle('open');
            if (searchBar.classList.contains('open') && searchInput) {
                searchInput.focus();
            }
        });
    }

    if (searchClose && searchBar) {
        searchClose.addEventListener('click', function () {
            searchBar.classList.remove('open');
        });
    }

    // Fermer avec Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            if (searchBar) searchBar.classList.remove('open');
            if (mainNav)   mainNav.classList.remove('open');
        }
    });

    // --- Active nav selon URL courante ---
    const currentPath = window.location.pathname;
    document.querySelectorAll('.nav-link').forEach(function (link) {
        if (link.getAttribute('href') === currentPath) {
            link.closest('.nav-item').classList.add('active');
        }
    });
});

