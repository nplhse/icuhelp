import $ from "jquery";

// Add ClipboardJS
import ClipboardJS from 'clipboard';
import { setTooltip } from './clipboard/tooltip';
import { hideTooltip } from './clipboard/tooltip';

var clipboard = new ClipboardJS('[data-clipboard-target]');

// Add clipboard tooltip
$('[data-clipboard-target]').tooltip({
    trigger: 'click',
    placement: 'top'
});

clipboard.on('success', function(e) {
    setTooltip('Copied!');
    hideTooltip();
});

clipboard.on('error', function(e) {
    setTooltip('Failed!');
    hideTooltip();
});