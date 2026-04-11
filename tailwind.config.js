/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/js/**/*.js",
    "./resources/js/**/*.vue",     // ← Très important
    "./app/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#22c55e',
        'primary-dark': '#16a34a',
        'primary-foreground': '#ffffff',
        accent: '#f97316',
        'accent-dark': '#ea6c0a',
        'accent-foreground': '#ffffff',
        muted: '#ececf0',
        'muted-foreground': '#717182',
        background: '#ffffff',
        foreground: '#0a0a0a',
        border: 'rgba(0,0,0,0.1)',
        'input-background': '#f3f3f5',
        card: '#ffffff',
      },
      borderRadius: {
        DEFAULT: '0.625rem',
        lg: '0.75rem',
        xl: '1rem',
        '2xl': '1.25rem',
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      },
    },
  },
  plugins: [],
}