/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// personal files
import '../js/menu.js';
import '../js/content.js';
import '../css/menu.css';
import '../css/content.css';
import '../css/app.css';

// Font Awesome
import '@fortawesome/fontawesome-free/js/fontawesome';
import '@fortawesome/fontawesome-free/js/solid';
import '@fortawesome/fontawesome-free/js/regular';
import '@fortawesome/fontawesome-free/js/brands';

//bootbox
import 'bootbox/dist/bootbox.min.js';
import 'bootbox/dist/bootbox.locales.min.js';

// bootstrap
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.min.js';


// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';
global.jQuery = global.$ = require ('jquery'); 

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
