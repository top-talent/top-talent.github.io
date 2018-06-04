// Pie Chart
var Piechart = function() {
    "use strict";

    // Handle Pie Chart
    var handlePiechart = function() {
        // Circles 1
        Circles.create({
            id: 'circles-1',
            radius: 55,
            value: 55,
            width: 5,
            textClass: 'circles-text-v1',
            text: function(value) {
                return value + '%';
            },
            colors: ['#fff', '#00bcd4'],
            duration: 1500
        });

        // Circles 2
        Circles.create({
            id: 'circles-2',
            radius: 55,
            value: 72,
            width: 5,
            textClass: 'circles-text-v1',
            text: function(value) {
                return value + '%';
            },
            colors: ['#fff', '#00bcd4'],
            duration: 1500
        });

        // Circles 3
        Circles.create({
            id: 'circles-3',
            radius: 55,
            value: 69,
            width: 5,
            textClass: 'circles-text-v1',
            text: function(value) {
                return value + '%';
            },
            colors: ['#fff', '#00bcd4'],
            duration: 1500
        });

        // Circles 4
        Circles.create({
            id: 'circles-4',
            radius: 65,
            value: 85,
            width: 65,
            textClass: 'circles-text-v2',
            text: function(value) {
                return value + '%';
            },
            colors: ['rgba(30,53,98,.6)', 'rgba(30,53,98,1)'],
            duration: 1500
        });

        // Circles 5
        Circles.create({
            id: 'circles-5',
            radius: 65,
            value: 72,
            width: 65,
            textClass: 'circles-text-v2',
            text: function(value) {
                return value + '%';
            },
            colors: ['rgba(34,76,110,.6)', 'rgba(34,76,110,1)'],
            duration: 1500
        });

        // Circles 6
        Circles.create({
            id: 'circles-6',
            radius: 65,
            value: 65,
            width: 65,
            textClass: 'circles-text-v2',
            text: function(value) {
                return value + '%';
            },
            colors: ['rgba(41,98,131,.6)', 'rgba(41,98,131,1)'],
            duration: 1500
        });

        // Circles 7
        Circles.create({
            id: 'circles-7',
            radius: 65,
            value: 80,
            width: 65,
            textClass: 'circles-text-v2',
            text: function(value) {
                return value + '%';
            },
            colors: ['rgba(72,132,169,.6)', 'rgba(72,132,169,1)'],
            duration: 1500
        });

        // Circles 8
        Circles.create({
            id: 'circles-8',
            radius: 65,
            value: 82,
            width: 65,
            textClass: 'circles-text-v2',
            text: function(value) {
                return value + '%';
            },
            colors: ['rgba(41,47,82,.6)', 'rgba(41,47,82, 1)'],
            duration: 1500
        });

        // Circles 9
        Circles.create({
            id: 'circles-9',
            radius: 65,
            value: 72,
            width: 65,
            textClass: 'circles-text-v2',
            text: function(value) {
                return value + '%';
            },
            colors: ['rgba(53,99,169,.6)', 'rgba(53,99,169,1)'],
            duration: 1500
        });

        // Circles 10
        Circles.create({
            id: 'circles-10',
            radius: 65,
            value: 65,
            width: 65,
            textClass: 'circles-text-v2',
            text: function(value) {
                return value + '%';
            },
            colors: ['rgba(0,132,180,.6)', 'rgba(0,132,180,1)'],
            duration: 1500
        });
    }

    return {
        init: function() {
            handlePiechart(); // initial setup for pie chart
        }
    }
}();

$(window).scroll(function() {
    var top = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
    if (top >= 1200 || top <= 1600 ) Piechart.init();
});
