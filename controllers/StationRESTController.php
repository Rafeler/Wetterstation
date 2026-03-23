<?php

require_once('RESTController.php');
require_once('models/Station.php');
require_once('models/Measurement.php');

class StationRESTController extends RESTController
{
    public function handleRequest()
    {
        switch ($this->method) {
            case 'GET':
                $this->handleGETRequest();
                break;
            case 'POST':
                $this->handlePOSTRequest();
                break;
            case 'PUT':
                $this->handlePUTRequest();
                break;
            case 'DELETE':
                $this->handleDELETERequest();
                break;
            default:
                $this->response('Method Not Allowed', 405);
                break;
        }
    }

    /**
     * get single/all stations
     * single station: GET api.php?r=/station/25 -> args[0] = 25
     * all stations: GET api.php?r=station
     * all measurements of single station: GET api.php?r=/station/2/measurement -> arg[0] = 2, args[1] = measurement
     */
    private function handleGETRequest()
    {
        // GET api.php?r=station
        if ($this->verb == null && empty($this->args)) {

            $stations = Station::getAll();
            $this->response($stations);

        }

        // GET api.php?r=station/1
        else if ($this->verb == null && sizeof($this->args) == 1) {

            $station = Station::get($this->args[0]);
            $this->response($station);

        }

        // GET api.php?r=station/1/measurement
        else if (sizeof($this->args) == 2 && $this->args[1] == "measurement") {
            $measurements = Measurement::getAllByStation($this->args[0]);
            $this->response($measurements);

        }

        else {
            $this->response("Bad Request", 400);
        }
    }

    private function handlePOSTRequest()
    {
        $station = new Station();

        $station->setName($this->getDataOrNull("name"));
        $station->setAltitude($this->getDataOrNull("altitude"));
        $station->setLocation($this->getDataOrNull("location"));

        if ($station->save()) {
            $this->response("Created", 201);
        } else {
            $this->response("Error", 400);
        }
    }

    private function handlePUTRequest()
    {
        if ($this->verb == null && sizeof($this->args) == 1) {

            $station = Station::get($this->args[0]);

            $station->setName($this->getDataOrNull("name"));
            $station->setAltitude($this->getDataOrNull("altitude"));
            $station->setLocation($this->getDataOrNull("location"));

            if ($station->save()) {
                $this->response("OK", 200);
            } else {
                $this->response("Error", 400);
            }

        } else {
            $this->response("Not Found", 404);
        }
    }

    private function handleDELETERequest()
    {
        if ($this->verb == null && sizeof($this->args) == 1) {

            Station::delete($this->args[0]);

            $this->response("OK", 200);

        } else {
            $this->response("Not Found", 404);
        }
    }}