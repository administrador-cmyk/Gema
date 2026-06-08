(function () {
  const STORAGE_KEY = 'gema-theme';
  const DARK_CLASS = 'gema-theme-dark';

  function getInitialTheme() {
    const saved = window.localStorage.getItem(STORAGE_KEY);
    if (saved === 'dark' || saved === 'day') {
      return saved;
    }

    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'day';
  }

  function applyTheme(theme) {
    const isDark = theme === 'dark';
    document.documentElement.classList.toggle(DARK_CLASS, isDark);
    document.documentElement.dataset.gemaTheme = theme;

    document.querySelectorAll('.gema-theme-toggle').forEach((button) => {
      button.setAttribute('aria-pressed', String(isDark));

      const icon = button.querySelector('.gema-theme-toggle__icon');
      const text = button.querySelector('.gema-theme-toggle__text');

      if (icon) {
        icon.textContent = isDark ? 'Noche' : 'Dia';
      }

      if (text) {
        text.textContent = isDark ? 'Modo dia' : 'Modo noche';
      }
    });
  }

  const initialTheme = getInitialTheme();
  applyTheme(initialTheme);

  document.addEventListener('DOMContentLoaded', function () {
    applyTheme(document.documentElement.dataset.gemaTheme || initialTheme);

    document.querySelectorAll('.gema-theme-toggle').forEach((button) => {
      button.addEventListener('click', function () {
        const nextTheme = document.documentElement.classList.contains(DARK_CLASS) ? 'day' : 'dark';
        window.localStorage.setItem(STORAGE_KEY, nextTheme);
        applyTheme(nextTheme);
      });
    });
  });
})();
