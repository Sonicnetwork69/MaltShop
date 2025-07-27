"use strict";

var fetchError = jsLang('Error In Fetching Data');
var visitorsChart;
var devicesChart;
var audienceChart;
var locationChart;
var pageViewsChart;
var startDate = moment().subtract(29, 'days');
var endDate = moment();

function device(startDate, endDate) {

    $(".device").find('.placeholder').removeClass('d-none');
    $(".device").find('#devicesChart').addClass('d-none');
    $(".device").find('.card-block h6').addClass('d-none');

    $.ajax({
        type: "GET",
        url: SITE_URL + "/device",
        dataType: "json",
        data: {
            startDate: startDate,
            endDate: endDate
        },
        success: function (data) {

            $(".device").find('.placeholder').addClass('d-none');

            if (data.status != 200) {
                $(".device").find('.card-block h6').removeClass('d-none').text(fetchError + '. ' + data.error[0].message);
                return false;
            }

            if (Object.keys(data.device).length < 1 || data.device.length < 1 || data.device.level.length < 1) {
                $(".device").find('.card-block h6').removeClass('d-none').text(jsLang('No data available'));
                return false;
            }

            $(".device").find('#devicesChart').removeClass('d-none');

            if (devicesChart) {
                devicesChart.destroy();
            }

            // Devices Chart
            devicesChart = new Chart(document.getElementById('devicesChart'), {
                type: 'doughnut',
                data: {
                    labels: data.device.level,
                    datasets: [{
                        data: data.device.data,
                        backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(75, 192, 192)']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'right'
                    }
                }
            });
        },
    });
}



function audience(startDate, endDate) {

    $(".audience").find('.placeholder').removeClass('d-none');
    $(".audience").find('#audienceChart').addClass('d-none');
    $(".audience").find('.card-block h6').addClass('d-none');

    $.ajax({
        type: "GET",
        url: SITE_URL + "/audience",
        dataType: "json",
        data: {
            startDate: startDate,
            endDate: endDate
        },
        success: function (data) {

            $(".audience").find('.placeholder').addClass('d-none');

            if (data.status != 200) {
                $(".audience").find('.card-block h6').removeClass('d-none').text(fetchError + '. ' + data.error[0].message);
                return false;
            }

            $(".audience").find('#audienceChart').removeClass('d-none');

            if (audienceChart) {
                audienceChart.destroy();
            }

            // Audience Chart
            audienceChart = new Chart(document.getElementById('audienceChart'), {
                type: 'bar',
                data: {
                    labels: ['New Users', 'Returning Users'],
                    datasets: [{
                        label: 'Audience',
                        data: data.audience,
                        backgroundColor: ['rgb(54, 162, 235)', 'rgb(255, 99, 132)']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    }
                }
            });
        },
    });
}


function locations(startDate, endDate) {
    $(".location").find('.placeholder').removeClass('d-none');
    $(".location").find('#locationChart').addClass('d-none');
    $(".location").find('.card-block h6').addClass('d-none');

    $.ajax({
        type: "GET",
        url: SITE_URL + "/location",
        dataType: "json",
        data: {
            startDate: startDate,
            endDate: endDate
        },
        success: function (data) {

            $(".location").find('.placeholder').addClass('d-none');

            if (data.status != 200) {
                $(".location").find('.card-block h6').removeClass('d-none').text(fetchError + '. ' + data.error[0].message);
                return false;
            }

            if (Object.keys(data.location).length < 1 || data.location.length < 1 || data.location.level.length < 1) {
                $(".location").find('.card-block h6').removeClass('d-none').text(jsLang('No data available'));
                return false;
            }

            $(".location").find('#locationChart').removeClass('d-none');

            if (locationChart) {
                locationChart.destroy();
            }

            // Location Chart
            locationChart = new Chart(document.getElementById('locationChart'), {
                type: 'pie',
                data: {
                    labels: data.location.level,
                    datasets: [{
                        data: data.location.value,
                        backgroundColor: getDynamicColors(data.location.level.length)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'right'
                    }
                }
            });
        },
    });
}
function pageView(startDate, endDate) {

    $(".pageView").find('#pageViewsChart').addClass('d-none');
    $(".pageView").find('.placeholder').removeClass('d-none');
    $(".pageView").find('.card-block h6').addClass('d-none');

    $.ajax({
        type: "GET",
        url: SITE_URL + "/page_view",
        dataType: "json",
        data: {
            startDate: startDate,
            endDate: endDate
        },
        success: function (data) {

            $(".pageView").find('.placeholder').addClass('d-none');

            if (data.status != 200) {
                $(".pageView").find('.card-block h6').removeClass('d-none').text(fetchError + '. ' + data.error[0].message);
                return false;
            }

            $(".pageView").find('#pageViewsChart').removeClass('d-none');

            if (pageViewsChart) {
                pageViewsChart.destroy();
            }

            // Page Views Chart
            pageViewsChart = new Chart(document.getElementById('pageViewsChart'), {
                type: 'line',
                data: {
                    labels: data.pageView.level,
                    datasets: [{
                        label: 'Page Views',
                        data: data.pageView.value,
                        borderColor: 'rgb(255, 99, 132)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    }
                }
            });
        },
    });
}

function visitor(startDate, endDate) {

    $(".visitor").find('.placeholder').removeClass('d-none');
    $(".visitor").find('#visitorsChart').addClass('d-none');
    $(".visitor").find('.card-block h6').addClass('d-none');

    $.ajax({
        type: "GET",
        url: SITE_URL + "/visitor",
        dataType: "json",
        data: {
            startDate: startDate,
            endDate: endDate
        },
        success: function (data) {

            $(".visitor").find('.placeholder').addClass('d-none');

            if (data.status != 200) {
                $(".visitor").find('.card-block h6').removeClass('d-none').text(fetchError + '. ' + data.error[0].message);
                return false;
            }

            $(".visitor").find('#visitorsChart').removeClass('d-none');


            if (visitorsChart) {
                visitorsChart.destroy();
            }

            // Visitors Chart
            visitorsChart = new Chart(document.getElementById('visitorsChart'), {
                type: 'line',
                data: {
                    labels: data.visitor.level,
                    datasets: [{
                        label: 'Visitors',
                        data: data.visitor.value,
                        borderColor: 'rgb(54, 162, 235)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    }
                }
            });
        },
    });
}

function activeUser() {
    $.ajax({
        type: "GET",
        url: SITE_URL + "/active_user",
        dataType: "json",
        success: function (data) {

            $(".active-user").find('.placeholder').addClass('d-none');

            if (data.status != 200) {
                var div = '<span class="card-title f-16">' + fetchError + '. ' + data.error[0].message + "</span> ";
                $(".active-user").find('.card-block').html(div);
                return false;
            }

            $(".active-user").find('.active-card').removeClass('d-none');
            $("#active_user").text(data.activeUser[0]["activeUsers"] || 0);


        },
    });
}

$(document).ready(function () {
    device(startDate.format('YYYY-MM-DD'), endDate.format('YYYY-MM-DD'));
    audience(startDate.format('YYYY-MM-DD'), endDate.format('YYYY-MM-DD'));
    pageView(startDate.format('YYYY-MM-DD'), endDate.format('YYYY-MM-DD'));
    visitor(startDate.format('YYYY-MM-DD'), endDate.format('YYYY-MM-DD'));
    locations(startDate.format('YYYY-MM-DD'), endDate.format('YYYY-MM-DD'));
    activeUser();
    $('#date-range-btn span').html('<i class="fa fa-calendar"> </i> ' + formatMomentDate(startDate) + ' - ' + formatMomentDate(endDate));
});

// Function to generate dynamic background colors
function getDynamicColors(count) {
    var colors = [];

    for (var i = 0; i < count; i++) {
        var hue = i * (360 / count);
        var color = 'hsl(' + hue + ', 50%, 50%)';
        colors.push(color);
    }

    return colors;
}


$('#date-range-btn').daterangepicker(dateConfig(startDate, endDate), function (startDate, endDate) {

    let type = null;
    let selOne = startDate;
    let selTwo = endDate;
    let label;
    let df = true;
    if (startDate == 'undefined' || endDate == 'undefined') {
        label = jsLang('Pick a date range');
    } else if (startDate == '' || endDate == '' || (type && formatMomentDate(startDate) === formatMomentDate(new Date(0)))) {
        label = jsLang('Any Time');
    } else {
        label = formatMomentDate(startDate) + ' - ' + formatMomentDate(endDate);
        df = false;
    }
    if (df === true) {
        $(selOne).val('');
        $(selTwo).val('');
    } else {
        $(selOne).val(formatMomentDate(startDate));
        $(selTwo).val(formatMomentDate(endDate));
    }
    $('#date-range-btn span').html('<i class="fa fa-calendar"> </i> ' + label);

    visitor(startDate.format('YYYY-MM-DD'), endDate.format('YYYY-MM-DD'))
    device(startDate.format('YYYY-MM-DD'), endDate.format('YYYY-MM-DD'))
    audience(startDate.format('YYYY-MM-DD'), endDate.format('YYYY-MM-DD'))
    pageView(startDate.format('YYYY-MM-DD'), endDate.format('YYYY-MM-DD'))
    locations(startDate.format('YYYY-MM-DD'), endDate.format('YYYY-MM-DD'))

});


function dateConfig(startDate, endDate) {
    return {
        startDate: startDate,
        endDate: endDate,
        maxDate: new Date(),
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                'month')]
        },
        format: 'YYYY-MM-DD'
    }
}
