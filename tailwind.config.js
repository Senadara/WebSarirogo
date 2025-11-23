/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          1: "#E8F5E9",
          2: "#81C784",
          3: "#60AD5E",
          4: "#2E7D32",
          5: "#1B5E20",
          6: "#0D3B15",
        },
        secondary: {
          1: "#EFEBE9",
          2: "#A1887F",
          3: "#8D6E63",
          4: "#5F4339",
          5: "#3E2723",
        },
        accent: {
          1: "#E1F5FE",
          2: "#4FC3F7",
          3: "#039BE5",
          4: "#0277BD",
          5: "#01579B",
        },
        bg: {
          1: "#FFFFFF",
          2: "#F5F5F5",
          3: "#EEEEEE",
          4: "#E0E0E0",
          5: "#BDBDBD",
        },
        text: {
          1: "#FAFAFA",
          2: "#9E9E9E",
          3: "#616161",
          4: "#424242",
          5: "#212121",
        },
        red: {
          1: "#DC2626",
          2: "#F06A6C",
          3: "#FEF2F2",
        }
      }
    },
  },
  plugins: [],
};
