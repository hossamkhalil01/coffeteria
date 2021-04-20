const mix = require("laravel-mix");
const path = require("path");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js").sass(
    "resources/css/app.scss",
    "public/css"
);

mix.js("resources/js/main.js", "public/js").vue();

// path resovlers
mix.webpackConfig({
    resolve: {
        alias: {
            "~": path.resolve(__dirname, "resources/css"),
            "@helpers": path.resolve(__dirname, "resources/js/helpers"),
            "@services": path.resolve(__dirname, "resources/js/services"),
            "@pages": path.resolve(__dirname, "resources/js/pages"),
            "@components": path.resolve(__dirname, "resources/js/components"),
            "@layouts": path.resolve(
                __dirname,
                "resources/js/components/layouts"
            ),
            "@src": path.resolve(__dirname, "resources/js"),
        },
    },
});
