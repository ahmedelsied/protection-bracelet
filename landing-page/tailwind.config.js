/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./pages/**/*.{js,ts,jsx,tsx}",
    "./components/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      backgroundImage: {
        // 'circle': "radial-gradient(circle, rgb(153, 1, 138) 12% , rgb(87, 8, 76) 53%, rgb(23, 17, 21) 78%)",
      },
      fontFamily: {
        kRegular: "kanit Regular",
        kBlack: "kanit Black",
        kLight: "kanit Light"
      }
    },
  },
  plugins: [],
}
