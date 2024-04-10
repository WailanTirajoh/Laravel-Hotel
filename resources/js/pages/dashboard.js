import Chart from "chart.js/auto";

$(function () {
    const currentRoute = window.location.pathname;
    if (!currentRoute.startsWith("/dashboard")) return;

    let myVisitorChart;
    const charts = {
        init: function () {
            this.ajaxGetdailyGuestPerMonthData();
        },

        ajaxGetdailyGuestPerMonthData: function () {
            const urlPath = "/get-dialy-guest-chart-data";
            const request = $.ajax({
                method: "GET",
                url: urlPath,
            });

            request.done(function (response) {
                charts.createGuestsChart(response);
            });
        },

        createGuestsChart: function (response) {
            const ticksStyle = {
                color: "#495057",
                font: {
                    weight: "bold",
                },
            };

            const mode = "index";
            const intersect = true;

            const visitorsChart = $("#visitors-chart");
            const this_year = visitorsChart.attr("this-year");
            const this_month = visitorsChart.attr("this-month");
            if (myVisitorChart) myVisitorChart.destroy();
            myVisitorChart = new Chart(visitorsChart, {
                type: "line",
                data: {
                    labels: response.day,
                    datasets: [
                        {
                            label: "Occupied",
                            data: response.guest_count_data,
                            backgroundColor: "transparent",
                            borderColor: "#007bff",
                            pointBorderColor: "#007bff",
                            pointBackgroundColor: "#007bff",
                            fill: false,
                        },
                    ],
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            mode: mode,
                            intersect: intersect,
                        },
                        title: {
                            display: false,
                        },
                    },
                    interaction: {
                        mode: mode,
                        intersect: intersect,
                        onHover: function (evt, item) {
                            const point = item[0];
                            if (point) {
                                evt.target.style.cursor = "pointer";
                            } else {
                                evt.target.style.cursor = "default";
                            }
                        },
                    },
                    legend: {
                        display: true,
                    },
                    scales: {
                        y: {
                            display: true,
                            grid: {
                                display: true,
                                lineWidth: "4px",
                                color: "rgba(0, 0, 0, .2)",
                                drawBorder: false,
                                zeroLineColor: "transparent",
                            },
                            ticks: {
                                beginAtZero: true,
                                suggestedMax: response.max,
                                ...ticksStyle,
                            },
                        },
                        x: {
                            display: true,
                            grid: {
                                display: true,
                                drawBorder: false,
                            },
                            ticks: ticksStyle,
                        },
                    },
                },
            });

            visitorsChart.on("click", function (e) {
                const slice = myVisitorChart.getElementsAtEventForMode(
                    e,
                    "nearest",
                    { intersect: true }
                );
                if (slice.length) {
                    const label = slice[0].index + 1;
                    window.location.href = `/get-dialy-guest/${this_year}/${this_month}/${label}`;
                }
            });
        },

        recreate: function () {},
    };

    charts.init();

    window.Echo.channel("dashboard").listen(".dashboard.event", (e) => {
        charts.ajaxGetdailyGuestPerMonthData();
        // reloadJs("style/js/guestsChart.js");
        toastr.warning(e.message, "Hello");
    });
});
