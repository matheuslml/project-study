$(function() {
    'use strict';

    var currentBalance = $('.current-balance'),
        blockedBalance = $('.blocked-balance'),
        usedBalance = $('.used-balance'),
        availableBalance = $('.available-balance');

    if (currentBalance.length) {
        currentBalance.toArray().forEach(function(field) {
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
    }
    if (blockedBalance.length) {
        blockedBalance.toArray().forEach(function(field) {
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
    }
    if (usedBalance.length) {
        usedBalance.toArray().forEach(function(field) {
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
    }
    if (availableBalance.length) {
        availableBalance.toArray().forEach(function(field) {
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
    }

});