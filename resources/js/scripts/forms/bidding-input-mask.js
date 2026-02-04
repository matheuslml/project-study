$(function() {
    'use strict';

    var valueMax = $('.value_max'),
        valueMin = $('.value_min'),
        quantity = $('.quantity'),
        value = $('.value');


    //Numeral
    if (valueMin.length) {
        new Cleave(valueMin, {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalMark: ',',
            delimiter: '.',
            prefix: 'R$ ',
            signBeforePrefix: true
        });
    }

    if (valueMax.length) {
        new Cleave(valueMax, {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalMark: ',',
            delimiter: '.',
            prefix: 'R$ ',
            signBeforePrefix: true
        });
    }

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

    if (quantity.length) {
        new Cleave(quantity, {
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