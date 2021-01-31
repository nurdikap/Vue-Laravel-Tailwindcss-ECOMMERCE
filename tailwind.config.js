module.exports = {
    purge: [],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            boxShadow: {
                "azul-grande":
                    "0 20px 25px -5px rgba(34, 145, 255, 0.06), -10px 10px 10px -5px rgba(34, 145, 255, 0.06), 10px 0px 10px -5px rgba(34, 145, 255, 0.06)",

                azul:
                    "0 2px 3px 0 rgba(34, 145, 255, 0.06), 0 1px 2px 0 rgba(34, 145, 255, 0.05)"
            },

            colors: {
                primario: "#2291FF",
                fondo: "#FFFF",
                texto: "#DADDE1",
                enfatizado: "#0E3746",
                fondoClaro: "#e8f1f9"
            }
        }
    },
    variants: {
        extend: {}
    },
    plugins: []
};
