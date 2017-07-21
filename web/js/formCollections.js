var $collectionHolder;

var $addQuestionLink = $('<td colspan="6" class="add_question_link"><a href="#" class="add_question_link">Add a question</a></td>');
var $newLinkTr = $('<tr class="add_question_row"></tr>').append($addQuestionLink);

function hasClass(target, className) {
    return new RegExp('(\\s|^)' + className + '(\\s|$)').test(target.className);
}

jQuery(document).ready(function () {

    $collectionHolder = $('tbody.questions');

    $collectionHolder.find('tr').each(function () {
        addQuestionFormDeleteLink($(this));
    });

    $collectionHolder.append($newLinkTr);

    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addQuestionLink.on('click', function (e) {

        e.preventDefault();
        var rowCount = $('tbody tr').length;
        if (rowCount <= 40) {
            addQuestionForm($collectionHolder, $newLinkTr);
        } else {
            $("#dialog").dialog("open");
        }
        var table = document.getElementsByTagName('tbody')[0],
            rows = table.getElementsByTagName('tr'),
            text = 'textContent' in document ? 'textContent' : 'innerText';
        var j = 1;
        for (var i = 0, len = rows.length; i < len - 1; i++) {
            if (!(hasClass(rows[i], 'not-count'))) {
                rows[i].children[0][text] = j;
                j++;
            }
        }
    });
    addNumberOfRows();
});


function addQuestionForm($collectionHolder, $newLinkTr) {
    var prototype = $collectionHolder.data('prototype');

    var index = $collectionHolder.data('index');

    var newForm = prototype.replace(/__name__/g, index);

    $collectionHolder.data('index', index + 1);

    var $newFormTr = $('<tr></tr>').append(newForm);
    $newLinkTr.before($newFormTr);
    addQuestionFormDeleteLink($newFormTr);

}

function addQuestionFormDeleteLink($questionFormTr) {
    var $removeFormA = $('<td class="remove-form"><a class="remove-link" href="#"><i class="glyphicon glyphicon-trash"></i></a></td>');
    var $removedFormTr = $('<tr class="not-count"><td colspan="6">Otázka bude odstraněna, klikněte na tlačítko Uložit pro potvrzení.<a href="#">Vrátit zpět.</a></td></tr>');
    $questionFormTr.append($removeFormA);

    $removeFormA.on('click', function (e) {
        e.preventDefault();
        $questionFormTr.children().last().remove();
        $removedFormTr.data('backup', $questionFormTr);
        $questionFormTr.replaceWith($removedFormTr);
        addNumberOfRows();
    });

    $removedFormTr.on('click', function (e) {
        e.preventDefault();
        $removedFormTr.replaceWith($removedFormTr.data('backup'));
        addNumberOfRows();
        addQuestionFormDeleteLink($questionFormTr);
    })
}

function addNumberOfRows() {
    var table = document.getElementsByTagName('tbody')[0],
        rows = table.getElementsByTagName('tr'),
        text = 'textContent' in document ? 'textContent' : 'innerText';
    var j = 1;
    for (var i = 0, len = rows.length; i < len - 1; i++) {
        if (!(hasClass(rows[i], 'not-count'))) {
            rows[i].children[0][text] = j;
            j++;
        }
    }
}
