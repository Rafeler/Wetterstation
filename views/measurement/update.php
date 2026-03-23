<div class="container">
    <div class="row">
        <h2>Messung bearbeiten</h2>
    </div>

    <form class="form-horizontal" action="index.php?r=measurement/update&id=<?= $model->getId() ?>" method="post">

        <div class="form-group <?= $model->hasError('time') ? 'has-error' : ''; ?>">
            <label class="control-label col-md-2">Zeitpunkt *</label>
            <div class="col-md-4">
                <input type="datetime-local" class="form-control" name="time" value="<?= date('Y-m-d\TH:i', strtotime($model->getTime())) ?>">
                <?php if ($model->hasError('time')): ?>
                    <div class="help-block"><?= $model->getError('time') ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group <?= $model->hasError('temperature') ? 'has-error' : ''; ?>">
            <label class="control-label col-md-2">Temperatur [°C] *</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="temperature" value="<?= $model->getTemperature() ?>">
                <?php if ($model->hasError('temperature')): ?>
                    <div class="help-block"><?= $model->getError('temperature') ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group <?= $model->hasError('rain') ? 'has-error' : ''; ?>">
            <label class="control-label col-md-2">Regenmenge [ml] *</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="rain" value="<?= $model->getRain() ?>">
                <?php if ($model->hasError('rain')): ?>
                    <div class="help-block"><?= $model->getError('rain') ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group <?= $model->hasError('station_id') ? 'has-error' : ''; ?>">
            <label class="control-label col-md-2">Station *</label>
            <div class="col-md-4">
                <select class="form-control" name="station_id">
                    <?php foreach ($stations as $station): ?>
                        <option value="<?= $station->getId() ?>" <?= $model->getStationId() == $station->getId() ? 'selected' : '' ?>>
                            <?= $station->getName() ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if ($model->hasError('station_id')): ?>
                    <div class="help-block"><?= $model->getError('station_id') ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4 col-md-offset-2">
                <button type="submit" class="btn btn-primary">Aktualisieren</button>
                <a class="btn btn-default" href="index.php?r=home/index">Abbruch</a>
            </div>
        </div>

    </form>
</div>