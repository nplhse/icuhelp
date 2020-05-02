/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// Custom CSS
import '../css/main.scss';

// Add jQuery
import $ from 'jquery';

require('bootstrap');

// Activate jQuery popover
$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});