document.addEventListener("DOMContentLoaded", function() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    const body = document.body;
    const logo = document.getElementById('logo');
    const home = document.getElementById('home');
    const banner = document.getElementById('banner');

    function toggleDarkMode(isDarkMode) {
        body.classList.toggle('dark-mode', isDarkMode);
        if (isDarkMode) {
            logo.src = "assets/imgs/logodark.png";
            home.style.backgroundImage = "url('assets/imgs/backgroundd.png')";
            home.style.backgroundColor = "#333";
            banner.style.backgroundImage = "url('assets/imgs/backgroundd.png')";
        } else {
            logo.src = 'assets/imgs/logo2.png';
            home.style.backgroundImage = "url('assets/imgs/backk.jpg')";
            home.style.backgroundColor = "#fff";
            banner.style.backgroundImage = "url('assets/imgs/backk.jpg')";
        }
        localStorage.setItem('darkMode', isDarkMode);
    }

    function loadDarkModeState() {
        const isDarkModeSaved = localStorage.getItem('darkMode');
        if (isDarkModeSaved !== null) {
            const isDarkMode = JSON.parse(isDarkModeSaved);
            darkModeToggle.checked = isDarkMode;
            toggleDarkMode(isDarkMode);
        }
    }

    darkModeToggle.addEventListener('change', function() {
        const isDarkMode = darkModeToggle.checked;
        toggleDarkMode(isDarkMode);
    });

    window.addEventListener('beforeunload', function() {
        localStorage.setItem('darkMode', darkModeToggle.checked);
    });

    // Chame a função para carregar o estado do modo escuro ao carregar a página
    loadDarkModeState();


});
