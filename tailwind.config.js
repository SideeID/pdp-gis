/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./public/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#00999F'
      },
      fontFamily: {
        'poppins-regular': 'poppins-regular',
        'poppins-semibold': 'poppins-semibold',
        'poppins-bold': 'poppins-bold',
        'poppins-medium': 'poppins-medium'
      },
    },
  },
  plugins: [],
}

