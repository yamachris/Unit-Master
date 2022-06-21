const darkMode = document.getElementById('dark-Mode');

darkMode.addEventListener('change', () => {
    document.body.classList.toggle('dark');
});