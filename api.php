<?php
require_once('controllers/StationRESTController.php');
require_once('controllers/MeasurementRESTController.php');

try {
    $endpoint = isset($_GET['r']) ? explode('/', trim($_GET['r'], '/'))[0] : '';

    if ($endpoint === 'station') {
        $controller = new StationRESTController();
    } else if ($endpoint === 'measurement') {
        $controller = new MeasurementRESTController();
    } else {
        RESTController::responseHelper('Not Found', 404);
        exit;
    }

    $controller->handleRequest();

} catch (Exception $e) {
    RESTController::responseHelper($e->getMessage(), $e->getCode());
}