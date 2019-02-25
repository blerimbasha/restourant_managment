$(document).ready(function () {
    $('#calendar').fullCalendar({
        events: [
            {
                title: 'My Event',
                start: '2019-02-10',
                url: 'http://google.com/'
            },
            {
                title: 'Second event',
                start: '2019-02-20',
                url: 'http://google.com/'
            }
            ],
        dayClick: function (date, jsEvent, view,resourceObj) {
            selectable: true
            alert('day clicked' + date.format() );
            $(this).css('background-color', 'red');

        }
    });
})
