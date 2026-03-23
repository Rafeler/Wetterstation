var chartInstance = null;

$("#btnSearch").click(function() {
    var stationId = $("select[name='station_id']").val();

    $.get("http://localhost/wetterstation-angabe-php42/api.php?r=station/" + stationId + "/measurement", function(data) {
        var labels = [];
        var temps = [];
        var rains = [];

        data.forEach(function(m) {
            $("#measurements").append(
                "<tr>" +
                "<td>" + m.time + "</td>" +
                "<td>" + m.temperature + "</td>" +
                "<td>" + m.rain + "</td>" +
                "</tr>"
            );
            labels.push(m.time);
            temps.push(m.temperature);
            rains.push(m.rain);
        });

        if (chartInstance != null) {
            chartInstance.destroy();
        }

        var ctx = document.getElementById('chart');
        chartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Temperatur (°C)',
                        data: temps,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true
                    },
                    {
                        label: 'Regen (ml)',
                        data: rains,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: { display: false }
                }
            }
        });

    }).fail(function() {
        alert("Fehler beim Laden der Messwerte!");
    });
});