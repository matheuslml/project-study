$(function() {
    'use strict';

    var document = $('.document');


    //Numeral

    if (document.length) {
        new Cleave(document, {
            blocks: [2, 3, 3, 4, 2],
            delimiters: ['.', '.', '/', '-']
        });
    }

});