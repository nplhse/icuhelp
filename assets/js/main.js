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

// Add bootstrap+fontawsome
require('bootstrap');
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

// Add ClipboardJS
import ClipboardJS from 'clipboard';

// Activate jQuery popover
$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

var clipboard = new ClipboardJS('.btn');

// Add some debugging for the clipboard
clipboard.on('success', function(e) {
    console.info('Action:', e.action);
    console.info('Text:', e.text);
    console.info('Trigger:', e.trigger);

    e.clearSelection();
});

clipboard.on('error', function(e) {
    console.error('Action:', e.action);
    console.error('Trigger:', e.trigger);
});