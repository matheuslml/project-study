$(function() {
    'use strict';

    var percentage = $('.percentage');


    //Numeral
    if (percentage.length) {
        new Cleave(percentage, {
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
