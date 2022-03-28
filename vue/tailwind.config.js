module.exports = {
  content: [
    "index.js",
    "./src/**/*.{vue,js,css,ts,tsx}",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms')
  ],
}; 

