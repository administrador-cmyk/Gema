/**
 * Tailwind preset — Gema Digital + ERP Cumbre + Sovereign bridge
 * Uso: presets: [require('./config/tailwind.preset.js')]
 */
/** @type {import('tailwindcss').Config} */
module.exports = {
  theme: {
    extend: {
      colors: {
        gema: {
          primary: '#0B192C',
          secondary: '#00F2FE',
          accent: '#E2E8F0',
          surface: '#F8FAFC',
          muted: '#64748B',
        },
        cumbre: {
          primary: '#0F172A',
          'primary-alt': '#1E293B',
          secondary: '#10B981',
          accent: '#F59E0B',
          surface: '#F1F5F9',
        },
        sovereign: {
          blue: '#003366',
          yellow: '#FFD400',
          success: '#008037',
          warning: '#F37021',
          danger: '#ED1C24',
          slate: '#1E293B',
        },
      },
      fontFamily: {
        'gema-display': ['Geist', 'Inter Tight', 'system-ui', 'sans-serif'],
        'gema-body': ['Inter', 'system-ui', 'sans-serif'],
        'cumbre-display': ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
        'cumbre-mono': ['Roboto Mono', 'ui-monospace', 'monospace'],
      },
      maxWidth: {
        container: '1440px',
      },
      spacing: {
        gutter: '24px',
      },
      borderRadius: {
        sovereign: '0.25rem',
      },
    },
  },
};
