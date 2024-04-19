var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
var themeToggleSystemIcon = document.getElementById('theme-toggle-system-icon');

// Change the icons inside the button based on previous settings
var currentTheme = localStorage.getItem('color-theme');
if (currentTheme === 'dark') {
    console.log('color-theme is dark', currentTheme)
    themeToggleDarkIcon.classList.remove('hidden');
    themeToggleLightIcon.classList.add('hidden');
    themeToggleSystemIcon.classList.add('hidden');
} else if (currentTheme === 'light') {
    console.log('color-theme is light', currentTheme)
    themeToggleDarkIcon.classList.add('hidden');
    themeToggleLightIcon.classList.remove('hidden');
    themeToggleSystemIcon.classList.add('hidden');
} else {
    console.log('color-theme is else', currentTheme)
    themeToggleDarkIcon.classList.add('hidden');
    themeToggleLightIcon.classList.add('hidden');
    themeToggleSystemIcon.classList.remove('hidden');
}

var themeToggleBtn = document.getElementById('theme-toggle');

themeToggleBtn.addEventListener('click', function() {
    var currentTheme = localStorage.getItem('color-theme');

    if (currentTheme === 'dark') {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('color-theme', 'light');
        themeToggleDarkIcon.classList.add('hidden');
        themeToggleLightIcon.classList.remove('hidden');
        themeToggleSystemIcon.classList.add('hidden');
    } else if (currentTheme === 'light') {
        document.documentElement.classList.remove('light');;
        localStorage.removeItem('color-theme');
        themeToggleDarkIcon.classList.add('hidden');
        themeToggleLightIcon.classList.add('hidden');
        themeToggleSystemIcon.classList.remove('hidden');
    } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('color-theme', 'dark');
        themeToggleLightIcon.classList.add('hidden');
        themeToggleDarkIcon.classList.remove('hidden');
        themeToggleSystemIcon.classList.add('hidden');
    }
});