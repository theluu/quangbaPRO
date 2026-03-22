/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        'primary-1': '#4285F4',
        'danger-1': '#FF9D3D',
        'danger-2': '#FF4E42',
        'danger-3': '#FBBC05',
        'dark-1': '#0D0D0D',
        'green-1': '#25B37C',
        'green-2': '#91C767',
        'grey-1': '#F7F7F7',
        'grey-2': '#BFBFBF'
      }
    },
  },
  plugins: [],
}

