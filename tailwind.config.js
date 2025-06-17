/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./resources/css/**/*.css",
    ],
    theme: {
        extend: {
            colors: { 
                //colors for text
                tWhite: "#D9D9D9",
                tHover: "#A9C6D9", 
                tBlack: "#400101",
                tLink:'#3C05FF',

                //colors for backgrounds
                NavBar1: "#ffffff",           //"#BF6B04",
                NavBar2: "#BF7E04",
                navBlue: '#253464',         //solo aumente esto


                btn1: "#BF3706",
                btn2: "#D9C7C1",

                //colors for background footer

                //colors general
                redAlert: "#8C1C03",
            },
            spacing: {
                //tamaños para formularios
                'wLR': '390px',
            },
        },
    }, 
    plugins: [],
};
