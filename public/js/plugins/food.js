$(function() {
    $('input:text[name="name"]').each(function() {
        var width = $(this).outerWidth() - 2;

        $(this).autocomplete({
            serviceUrl: '/moonlight/elements/autocomplete',
            params: {
                item: 'App.Foodstuff'
            },
            formatResult: function(suggestion, currentValue) {
                return suggestion.value + ' <small>(' + suggestion.id + ')</small>';
            },
            onSelect: function (suggestion) {
                $('input:text[name="name"]').val(suggestion.value);
                $('input:hidden[name="foodstuff_id"]').val(suggestion.id);
                $('span[container][name="foodstuff_id"]').html(suggestion.value);

                if (suggestion.value.indexOf('кофе') >= 0) {
                    $('input:text[name="grams"]').val(300);
                } else if (suggestion.value.indexOf('чай') >= 0) {
                    $('input:text[name="grams"]').val(300);
                } else if (suggestion.value.indexOf('Агуша') >= 0) {
                    $('input:text[name="grams"]').val(100);
                }
            },
            width: width,
            minChars: 0
        });
    });
});