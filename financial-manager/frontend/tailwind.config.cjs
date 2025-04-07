/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#3498db', // Azul Royal
          light: '#5dade2',
          dark: '#2980b9',
        },
        success: {
          DEFAULT: '#2ecc71', // Verde Limão
          light: '#55d98d',
          dark: '#27ae60',
        },
        warning: {
          DEFAULT: '#f1c40f', // Amarelo Ouro
          light: '#f4d03f',
          dark: '#d4ac0d',
        },
        danger: {
          DEFAULT: '#e74c3c', // Vermelho Coral
          light: '#ec7063',
          dark: '#c0392b',
        },
        background: '#ecf0f1', // Cinza Claro
        text: {
          DEFAULT: '#2c3e50', // Azul Marinho
          light: '#34495e',
          muted: '#7f8c8d',
        }
      },
      fontFamily: {
        sans: ['Poppins', 'Roboto', 'sans-serif'],
        body: ['Roboto', 'sans-serif'],
      },
      spacing: {
        '72': '18rem',
        '84': '21rem',
        '96': '24rem',
      },
      borderRadius: {
        'lg': '12px',
        'xl': '24px',
      },
      boxShadow: {
        'inner-lg': 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)',
      },
      transitionProperty: {
        'height': 'height',
        'spacing': 'margin, padding',
      },
      animation: {
        'fade-in': 'fadeIn 0.3s ease-in-out',
        'slide-in': 'slideIn 0.3s ease-in-out',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideIn: {
          '0%': { transform: 'translateY(-10px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
