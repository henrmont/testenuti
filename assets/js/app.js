/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// personal files
import '../css/app.css';
import '../js/menu.js';
import '../css/menu.css';
import '../js/content.js';

// Font Awesome
import '@fortawesome/fontawesome-free/js/fontawesome';
import '@fortawesome/fontawesome-free/js/solid';
import '@fortawesome/fontawesome-free/js/regular';
import '@fortawesome/fontawesome-free/js/brands';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';
global.jQuery = global.$ = require ('jquery');
// import bootstrap
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.min.js';

//bootbox
import 'bootbox/dist/bootbox.min.js';
import 'bootbox/dist/bootbox.locales.min.js';

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
