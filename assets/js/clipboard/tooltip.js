import $ from "jquery";

export function setTooltip(message) {
    $('[data-clipboard-target]').tooltip('hide')
        .attr('data-original-title', message)
        .tooltip('show');
};

export function hideTooltip(message) {
    setTimeout(function() {
        $('[data-clipboard-target]').tooltip('hide');
    }, 1000);
}