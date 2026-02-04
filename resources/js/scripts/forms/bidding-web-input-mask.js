$(function() {
    'use strict';

    var currentBalance = $('.current-balance');

    if (currentBalance.length) {
        new Cleave(currentBalance, {

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