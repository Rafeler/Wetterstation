<div class="container">
    <h2>Messung löschen</h2>

    <form class="form-horizontal" action="index.php?r=measurement/delete&id=<?= $model->getId() ?>" method="post">
        <input type="hidden" name="id" value="<?= $model->getId() ?>"/>
        <p class="alert alert-danger">Wollen Sie die Messung vom <?= $model->getTime() ?> wirklich löschen?</p>
        <div class="form-actions">
            <button type="submit" class="btn btn-danger">Löschen</button>
            <a class="btn btn-default" href="index.php?r=home/index">Abbruch</a>
        </div>
    </form>
</div>