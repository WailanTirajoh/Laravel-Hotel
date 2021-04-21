$(function() {
    var charts = {
        init: function() {
            this.ajaxGetDialyGuestPerMonthData();
        },

        ajaxGetDialyGuestPerMonthData: function() {
            var urlPath = '/get-dialy-guest-chart-data';
            var request = $.ajax({
                method: 'GET',
                url: urlPath
            });

            request.done(function(response) {
                console.log(response);
                charts.createGuestsChart(response);
            });
        },

        createGuestsChart: function(response) {
            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true

            var visitorsChart = $('#visitors-chart')
            var this_year = $('#visitors-chart').attr('this-year')
            var this_month = $('#visitors-chart').attr('this-month')
            var visitorsChart = $('#visitors-chart')
            var myVisitorChart = new Chart(visitorsChart, {
                data: {
                    labels: response.day,
                    datasets: [{
                            type: 'line',
                            data: response.guest_count_data,
                            backgroundColor: 'transparent',
                            borderColor: '#007bff',
                            pointBorderColor: '#007bff',
                            pointBackgroundColor: '#007bff',
                            fill: false
                        },
                        // {
                        //     type: 'line',
                        //     // Data bulan sebelumnya
                        //     data: [60, 80, 70, 67, 80, 77, 100],
                        //     backgroundColor: 'tansparent',
                        //     borderColor: '#ced4da',
                        //     pointBorderColor: '#ced4da',
                        //     pointBackgroundColor: '#ced4da',
                        //     fill: false
                        // }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect,
                        onHover: function(e) {
                            var point = this.getElementAtEvent(e);
                            if (point.length) e.target.style.cursor = 'pointer';
                            else e.target.style.cursor = 'default';
                        }
                    },
                    legend: {
                        display: false,
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                suggestedMax: response.max
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: true
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })

            var visitorsChart = document.getElementById("visitors-chart");
            visitorsChart.onclick = function(e) {
                var slice = myVisitorChart.getElementAtEvent(e)
                if (!slice.length) return // return if not clicked on slice
                var label = (slice[0]._index) + 1
                window.location.href = ('/get-dialy-guest/' + this_year + '/' + this_month + '/' + label)

            }

        }
    }

    charts.init();
})
