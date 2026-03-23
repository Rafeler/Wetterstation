<div class="container">
    <div class="row">
        <h2>Awesome Wetterstation</h2>
    </div>
    <div class="row">
        <p class="form-inline">
            <select class="form-control" name="station_id" style="width: 200px">
                <?php
                foreach($model as $station):
                    echo '<option value="' . $station->getId() . '">' . $station->getName() . '</option>';
                endforeach;
                ?>
            </select>
            <button id="btnSearch" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Messwerte anzeigen</button>
            <a class="btn btn-default" href="index.php?r=station/index"><span class="glyphicon glyphicon-pencil"></span> Messstationen bearbeiten</a>

            <canvas id="chart" width="400" height="100"></canvas>

        <br/>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Zeitpunkt</th>
                <th>Temperatur [C°]</th>
                <th>Regenmenge [ml]</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="measurements"></tbody>
        </table>
    </div>
</div>
<script>
    var apiBase = "http://localhost/wetterstation-angabe-php42/api.php";    var chartInstance = null;

    $("#btnSearch").click(function() {
        var stationId = $("select[name='station_id']").val();

        $.get(apiBase + "?r=station/" + stationId + "/measurement", function(data) {

            // Tabelle leeren
            $("#measurements").html("");

            var labels = [];
            var temps = [];
            var rains = [];

            data.forEach(function(m) {
                $("#measurements").append(
                    "<tr>" +
                    "<td>" + m.time + "</td>" +
                    "<td>" + m.temperature + "</td>" +
                    "<td>" + m.rain + "</td>" +
                    "<td>" +
                    "<a href='index.php?r=measurement/view&id=" + m.id + "' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-eye-open'></span></a>" +
                    "&nbsp;<a href='index.php?r=measurement/update&id=" + m.id + "' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-pencil'></span></a>" +
                    "&nbsp;<a href='index.php?r=measurement/delete&id=" + m.id + "' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span></a>" +
                    "</td>" +
                    "</tr>"
                );
                labels.push(m.time);
                temps.push(m.temperature);
                rains.push(m.rain);
            });

            // Chart neu zeichnen
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
</script>
