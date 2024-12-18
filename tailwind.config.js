const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        'header.php',
        'footer.php',
        'index.php',
        'singular.php',
        'woocommerce.php',
        '404.php',
        './template-parts/*.php',
        './template-parts/*/*.php',
        './templates/*.php',
    ],
    safelist: ['lg:grid-cols-2', 'lg:grid-cols-3', 'lg:col-span-6', 'lg:col-span-8', 'lg:col-span-3'],
    theme: {
        container: {
            center: true,
            padding: '1rem',
            screens: {
                sm: '100%',
                md: '100%',
                lg: '100%',
                '2xl': '90rem',
            },
        },
        screens: {
            xs: '480px',
            ...defaultTheme.screens,
        },
        extend: {},
    },
    plugins: [],
};
