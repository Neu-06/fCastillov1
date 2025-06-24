/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./resources/css/**/*.css",
    ],
    theme: {
        extend: {
            colors: { 
                tWhite: "#D9D9D9",
                tHover: "#A9C6D9", 
                tBlack: "#400101",
                tLink:'#3C05FF',
                NavBar1: "#ffffff",
                NavBar2: "#BF7E04",
                navBlue: '#253464',
                btn1: "#BF3706",
                btn2: "#D9C7C1",
                redAlert: "#8C1C03",
            },
            spacing: {
                'wLR': '390px',
            },
        },
    },
    plugins: [require("daisyui")],
    daisyui: {
        themes: ["light"], 
        darkTheme: "light", 
    },
};
