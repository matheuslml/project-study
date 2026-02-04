$(function() {
    'use strict';

    var currentBalance = $('.current-balance'),
        currentBalanceShow = $('.current-balance-show'),
        blockedBalance = $('.blocked-balance'),
        usedBalance = $('.used-balance'),
        listValue = $('.list-value'),
        availableBalance = $('.available-balance');

    if (listValue.length) {
        listValue.toArray().forEach(function(field) {
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

    //Numeral
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
    if (blockedBalance.length) {
        new Cleave(blockedBalance, {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalMark: ',',
            delimiter: '.',
            prefix: 'R$ ',
            signBeforePrefix: true
        });
    }
    if (usedBalance.length) {
        new Cleave(usedBalance, {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalMark: ',',
            delimiter: '.',
            prefix: 'R$ ',
            signBeforePrefix: true
        });
    }
    if (availableBalance.length) {
        new Cleave(availableBalance, {
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
