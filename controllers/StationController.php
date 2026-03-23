<?php

require_once('Controller.php');
require_once('models/Measurement.php');
require_once('models/Station.php');

class StationController extends Controller
{
    public function handleRequest($route)
    {
        $operation = sizeof($route) > 1 ? $route[1] : 'index';

        if ($operation == 'index') {
            $this->actionIndex();
        } else if ($operation == 'view') {
            $this->actionView($route[2]);
        } else if ($operation == 'create') {
            $this->actionCreate();
        } else if ($operation == 'update') {
            $this->actionUpdate($route[2]);
        } else if ($operation == 'delete') {
            $this->actionDelete($route[2]);
        } else {
            Controller::showError("Page not found", "Page for operation " . $operation . " was not found!");
        }
    }

    public function actionIndex()
    {
        $model = Station::getAll();
        $this->render('station/index', $model);
    }

    public function actionView($id)
    {
        $model = Station::get($id);
        $this->render('station/view', $model);
    }

    public function actionCreate()
    {
        $model = new Station();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model->setName($this->getDataOrNull('name'));
            $model->setAltitude($this->getDataOrNull('altitude'));
            $model->setLocation($this->getDataOrNull('location'));

            if ($model->save()) {
                $this->redirect('station/index');
                return;
            }
        }

        $this->render('station/create', $model);
    }

    public function actionUpdate($id)
    {
        $model = Station::get($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model->setName($this->getDataOrNull('name'));
            $model->setAltitude($this->getDataOrNull('altitude'));
            $model->setLocation($this->getDataOrNull('location'));

            if ($model->save()) {
                $this->redirect('station/index');
                return;
            }
        }

        $this->render('station/update', $model);
    }

    public function actionDelete($id)
    {
        $model = Station::get($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Station::delete($id);
            $this->redirect('station/index');
            return;
        }

        $this->render('station/delete', $model);
    }
}