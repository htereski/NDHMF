import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'
import daisyui from 'daisyui'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './vendor/laravel/jetstream/**/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],

  theme: {
    extend: {
      colors: {
        text: '#000000',
        background: '#ffffff',
        primary: '#4ade80',
        secondary: '#abe582',
        accent: '#61de76',
      },
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
      typography: ({ theme }) => ({
        DEFAULT: {
          css: {
            p: {
              margin: 0,
            },
            li: {
              margin: 0,
              p: {
                margin: 0,
              },
            },
            strong: {
              color: '#000',
            },
            h1: {
              color: '#000',
            },
            h2: {
              color: '#000',
            },
            li: {
              color: '#000',
            },
            ul: {
              padding: 10,
              margin: 0,
              li: {
                margin: 0,
                p: {
                  margin: 0,
                },
              },
            },
            ol: {
              padding: 10,
              margin: 0,
              li: {
                margin: 0,
                p: {
                  margin: 0,
                },
              },
            },
            blockquote: {
              color: '#000',
            },
            code: {
              color: '#000',
            },
            hr: {
              backgroundColor: '#b7b5b5',
              padding: 1,
              margin: 5,
            },
          },
        },
      }),
    },
  },

  plugins: [
    function ({ addBase }) {
      addBase({
        input: {
          color: '#000',
        },
        select: {
          color: '#000',
        },
      })
    },
    forms,
    typography,
    daisyui,
  ],
}
