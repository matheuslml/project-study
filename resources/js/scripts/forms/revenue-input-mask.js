$(function() {
    'use strict';

    var value = $('.revenue-value');

    value.toArray().forEach(function(field) {
        new Cleave(field, {

            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalMark: ',',
            delimiter: '.',
            prefix: 'R$ ',
            signBeforePrefix: true

        });
    });

});