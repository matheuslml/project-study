$(function() {
    'use strict';

    var value = $('.value');


    //Numeral

    if (value.length) {
        new Cleave(value, {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalMark: ',',
            delimiter: '.',
            prefix: 'R$ ',
            signBeforePrefix: true
        });
    }

});