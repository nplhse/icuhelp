import $ from "jquery";
import Sortable from "sortablejs";

$(document).ready(function() {
    var notesList = new NotesList($('.js-notes-list'));
});

class NotesList
{
    constructor($element, $route) {
        this.$element = $element;
        this.sortable = Sortable.create(this.$element[0], {
            handle: '.drag-handle',
            animation: 150,
            onEnd: () => {
                $.ajax({
                    url: '/_onboarding/reorder/notes',
                    method: 'POST',
                    data: JSON.stringify(this.sortable.toArray())
                });
            }
        });
        this.references = [];
    }
}