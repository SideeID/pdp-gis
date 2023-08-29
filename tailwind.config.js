/** @type {import('tailwindcss').Config} */
module.exports = {
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
      }
    },
  },
  plugins: [],
}

