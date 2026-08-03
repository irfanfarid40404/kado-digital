/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/Livewire/**/*.php",
  ],
  theme: {
    extend: {
      fontFamily: {
        'display-romantic': ['Fraunces', 'serif'],
        'display-playful': ['Fredoka', 'sans-serif'],
        'display-elegant': ['Playfair Display', 'serif'],
        'body': ['Plus Jakarta Sans', 'sans-serif'],
        'body-elegant': ['Inter Tight', 'sans-serif'],
      },
      colors: {
        romantic: {
          base: '#FAF3E9',
          deep: '#6B1F2A',
          soft: '#A8434F',
          gold: '#C9A24B',
          ink: '#2E2A26',
          card: '#F1DCD4',
        },
        playful: {
          base: '#FFF6E9',
          coral: '#F4623A',
          mustard: '#F2B705',
          teal: '#2E8B8B',
          ink: '#3A2A1E',
          card: '#FFDCC2',
        },
        elegant: {
          base: '#0F1B2D',
          card: '#1C2E47',
          gold: '#D4B98C',
          text: '#EDE3D0',
          accent: '#7A2E3D',
        },
      },
    },
  },
  plugins: [],
}
