/**
 * App Calendar Events
 */

'use strict';

var date = new Date();
var nextDay = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
// prettier-ignore
var nextMonth = date.getMonth() === 11 ? new Date(date.getFullYear() + 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() + 1, 1);
// prettier-ignore
var prevMonth = date.getMonth() === 11 ? new Date(date.getFullYear() - 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() - 1, 1);

var events = [];
$.get('/orderly/get-orderlies', function(orderlies) {
    $.each(orderlies, function(key, value) {
        var ordely = {
            id: value.id,
            url: '',
            title: value.title,
            vacancy: value.vacancy,
            start: value.started_at,
            end: value.ended_at,
            allDay: false,
            extendedProps: {
                calendar: 'Business',
                location: value.location,
                description: value.description,
            }
        };
        events.push(ordely);
    });
    //console.log(events);

});