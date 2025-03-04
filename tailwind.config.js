/** @type {import('tailwindcss').Config} */
export default {
  content: [
    'node_modules/preline/dist/*.js',
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          500: '#1d4ed8', // Custom primary color
          600: '#1e40af', // Darker shade for hover
        },
      },
    },
  },

  plugins: [
    require('preline/plugin'),
  ],
}

