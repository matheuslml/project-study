$(function() {
    'use strict';

    var number = $('.number');


    //Numeral
    if (number.length) {
        new Cleave(number, {
            numeral: true
        });
    }

});