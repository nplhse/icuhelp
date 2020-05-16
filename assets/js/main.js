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

// Activate jQuery popover and tooltips
$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip();
});

var clipboard = new ClipboardJS('[data-clipboard-target]');

// Tooltip
$('[data-clipboard-target]').tooltip({
    trigger: 'click',
    placement: 'top'
});

function setTooltip(message) {
    $('[data-clipboard-target]').tooltip('hide')
        .attr('data-original-title', message)
        .tooltip('show');
}

function hideTooltip() {
    setTimeout(function() {
        $('[data-clipboard-target]').tooltip('hide');
    }, 1000);
}

clipboard.on('success', function(e) {
    console.log('It worked!');
    setTooltip('Copied!');
    hideTooltip();
});

clipboard.on('error', function(e) {
    console.log('It did not work...');
    setTooltip('Failed!');
    hideTooltip();
});