<?php

require_once('Controller.php');
require_once('models/Station.php');
require_once('models/Measurement.php');

class MeasurementController extends Controller
{
    /**
     * @param $route array, e.g. [measurement, view]
     */
    public function handleRequest($route)
    {
        $operation = sizeof($route) > 1 ? $route[1] : 'index';
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        if ($operation == 'view') {
            $this->actionView($id);
        } elseif ($operation == 'update') {
            $this->actionUpdate($id);
        } elseif ($operation == 'delete') {
            $this->actionDelete($id);
        } else {
            Controller::showError("Page not found", "Page for operation " . $operation . " was not found!");
        }
    }

    public function actionView($id)
    {
        $model = Measurement::get($id);
        $this->render('measurement/view', $model);
    }

    public function actionUpdate($id)
    {
        $stations = Station::getAll();

        $model = Measurement::get($id);

        if (!empty($_POST)) {
            $model->setTime($this->getDataOrNull('time'));
            $model->setTemperature($this->getDataOrNull('temperature'));
            $model->setRain($this->getDataOrNull('rain'));
            $model->setStationId($this->getDataOrNull('station_id'));

            if ($model->save()) {
                $this->redirect('measurement/view&id=' . $model->getId());
                return;
            }
        }

        $this->renderUpdate($model, $stations);
    }
    public function renderUpdate($model, $stations) {
        include 'views/layouts/top.php';
        include 'views/measurement/update.php';
        include 'views/layouts/bottom.php';
    }
    public function actionDelete($id)
    {
        if (!empty($_POST)) {
            Measurement::delete($id);
            $this->redirect('home/index');
            return;
        }

        $this->render('measurement/delete', Measurement::get($id));
    }

    public function getId() {
        return $this->id;
    }

    public function getTime() {
        return $this->time;
    }

    public function getTemperature() {
        return $this->temperature;
    }

    public function getRain() {
        return $this->rain;
    }

    public function getStationId() {
        return $this->station_id;
    }

    public function setTime($time) {
        $this->time = $time;
    }

    public function setTemperature($temperature) {
        $this->temperature = $temperature;
    }

    public function setRain($rain) {
        $this->rain = $rain;
    }

    public function setStationId($station_id) {
        $this->station_id = $station_id;
    }

}
