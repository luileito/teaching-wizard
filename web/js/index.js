$(function() {

    // Initialize tooltips.
    $('[data-toggle="tooltip"]').tooltip();

    // "Mark as favorite" behavior.
    $('.method .title .fa')
    .css('cursor', 'pointer')
    .on('click', function(ev) {
        var methodId = $(this).parent().attr('id');
        var selected = !!Cookies.get(methodId);
        if (selected) {
            Cookies.remove(methodId);
            removeStar(this);
        } else {
            Cookies.set(methodId, 1);
            addStar(this);
        }
    })
    .each(function(index, el) {
        // Init stars.
        var methodId = $(this).parent().attr('id');
        var selected = !!Cookies.get(methodId);
        if (selected) addStar(this);
    });

    function addStar(el) {
        $(el).removeClass('fa-star-o').addClass('fa-star').attr('title', 'Mark as favorite');
    }

    function removeStar(el) {
        $(el).removeClass('fa-star').addClass('fa-star-o').attr('title', 'Unmark as favorite');
    }

    // TODO: Agree on these bins.
    var groupSize = {
        1: '5-20 students',
        2: '25-40 students',
        3: '45-60 students',
        4: '65-90 students',
        5: '100+ students',
    };

    $('input#group_size')
    .on('input', function(ev) {
        var val = groupSize[ev.target.value];
        this.$sliderElement = $(this).parent().find('.slider-value');
        this.$sliderElement.css({ opacity: 1 }).text(val);
    })
    .on('change', function(ev) {
        this.$sliderElement.delay(1000).animate({ opacity: 0 }, function(e) {
            $(this).empty().css({ opacity: 1 });
        });
    });

    $('input[type=checkbox]')
    .on('click', function(ev) {
        // Reset status of parent container to begin with.
        var $row = $(this).parents('.slider-group').removeClass('inactive');
        // Then update status.
        var isChecked = $(this).is(':checked');
        if (!isChecked) $row.addClass('inactive');
        // Also update slider status and label text.
        var statusLabel = isChecked ? 'enabled' : 'disabled';
        $row.find('input[type=range]').attr('disabled', !isChecked).find('.slider-status').text(statusLabel);
    });

});
