$(function() {
    const charts = {
        init: function() {
            this.ajaxGetDialyGuestPerMonthData();
        },

        ajaxGetDialyGuestPerMonthData: function() {
            const urlPath = "/get-dialy-guest-chart-data";
            const request = $.ajax({
                method: "GET",
                url: urlPath
            });

            request.done(function(response) {
                console.log(response);
                charts.createGuestsChart(response);
            });
        },

        createGuestsChart: function(response) {
            const ticksStyle = {
                fontColor: "#495057",
                fontStyle: "bold"
            };

            const mode = "index";
            const intersect = true;

            let visitorsChart = $("#visitors-chart");
            const this_year = visitorsChart.attr("this-year");
            const this_month = visitorsChart.attr("this-month");
            const myVisitorChart = new Chart(visitorsChart, {
                data: {
                    labels: response.day,
                    datasets: [
                        {
                            type: "line",
                            data: response.guest_count_data,
                            backgroundColor: "transparent",
                            borderColor: "#007bff",
                            pointBorderColor: "#007bff",
                            pointBackgroundColor: "#007bff",
                            fill: false
                        }
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
                            const point = this.getElementAtEvent(e);
                            if (point.length) e.target.style.cursor = "pointer";
                            else e.target.style.cursor = "default";
                        }
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [
                            {
                                display: true,
                                gridLines: {
                                    display: true,
                                    lineWidth: "4px",
                                    color: "rgba(0, 0, 0, .2)",
                                    zeroLineColor: "transparent"
                                },
                                ticks: $.extend(
                                    {
                                        beginAtZero: true,
                                        suggestedMax: response.max
                                    },
                                    ticksStyle
                                )
                            }
                        ],
                        xAxes: [
                            {
                                display: true,
                                gridLines: {
                                    display: true
                                },
                                ticks: ticksStyle
                            }
                        ]
                    }
                }
            });

            visitorsChart.on("click", function(e) {
                const slice = myVisitorChart.getElementAtEvent(e);
                if (!slice.length) return; // return if not clicked on slice
                const label = slice[0]._index + 1;
                window.location.href =
                    "/get-dialy-guest/" +
                    this_year +
                    "/" +
                    this_month +
                    "/" +
                    label;
            });
        }
    };

    charts.init();
});
