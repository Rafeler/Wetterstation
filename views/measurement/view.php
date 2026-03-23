<div class="container">
    <h2>Messung anzeigen</h2>

    <p>
        <a class="btn btn-primary" href="index.php?r=measurement/update&id=<?= $model->getId() ?>">Bearbeiten</a>
        <a class="btn btn-danger" href="index.php?r=measurement/delete&id=<?= $model->getId() ?>">Löschen</a>
        <a class="btn btn-default" href="index.php?r=home/index">Zurück</a>
    </p>

    <table class="table table-striped table-bordered detail-view">
        <tbody>
        <tr>
            <th>Zeitpunkt</th>
            <td><?= $model->getTime() ?></td>
        </tr>
        <tr>
            <th>Temperatur</th>
            <td><?= $model->getTemperature() ?> °C</td>
        </tr>
        <tr>
            <th>Regenmenge</th>
            <td><?= $model->getRain() ?> ml</td>
        </tr>
        </tbody>
    </table>
</div>