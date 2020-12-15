$(function() {

    var $methodEntries = $('.method');
    var numSuggestions = 3;
    var $hiddenMethods = $methodEntries.slice(numSuggestions).hide();
    var buttonTemplate = '<div id="loadmore"><input type="button" class="btn btn-info" value="Load more" /></div>';
    var $paginationBtn = $(buttonTemplate).appendTo('#methods-list .card-body');
    if (!$methodEntries.length) {
        $paginationBtn.html('<span class="text-muted">Please select your filtering options.</span>');
    } else {
        $paginationBtn.find('input').on('click', function(ev) {
            // Load one more suggestion.
            var $moreMethods = $('.method:hidden').slice(0, 1).show('fast');
            // Hide button when all suggestions are shown.
            if ($('.method:hidden').length === 0) {
                $(this).parent().html('<span class="text-muted">No more results found.</span>');
            }
        });
    }

});
