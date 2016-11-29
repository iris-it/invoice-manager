const elixir = require('laravel-elixir');

var fonts = [
    "./node_modules/bootstrap-sass/assets/fonts/bootstrap/",
    "./node_modules/font-awesome/fonts/"
];

elixir(mix => {

    mix.copy(fonts, "public/build/fonts");

    mix.sass('app.scss');

    mix.webpack('app.js');

    mix.version(['css/app.css', 'js/app.js']);

});
