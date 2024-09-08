import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
    './resources/js/**/*.js',
  ],
  theme: {
      extend: {
        fontFamily: {
          sans: ['Archivo', 'Noto Sans', ...defaultTheme.fontFamily.sans],
        },
        borderRadius: {
          'large': '14px',
        },
        colors: {
          'blue': {
            '50': '#f2fafe',
            '400': '#84D3F5',
            '500': '#49b7e6',
            '600': '#27a9e1',
            '700': '#1b92c5',
            '800': '#207aa1',
            'custom': '#07A0E5',
          },
        },
        backgroundImage: {
          'truly': 'url(\'@/Components/TrulyBackground.svg\')',
          'profile': 'url(\'@/Components/ProfileBackground.svg\')',
        },
        dropShadow: {
          custom: ['0 2px 4px rgb(0 0 0 / 0.07)', '0 2px 2px rgb(0 0 0 / 0.06)'],
        },
      },
  },
  plugins: [
    forms,
  ],
}

