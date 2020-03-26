<?php

include '_includes/Synology/Abstract.php';
include '_includes/Synology/Api.php';
include '_includes/Synology/Exception.php';
include '_includes/Synology/Api/Authenticate.php';
include '_includes/Synology/DownloadStation/Api.php';
include '_includes/Synology/FileStation/Api.php';

class syno extends connectDb
{

    protected $_now;
    protected $_syno;

    public function __construct()
    {
        parent::__construct();
        $this->_now = date("Y-m-d H:i:s");
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    private function sendResponse($t)
    {
        header("Content-type: text/json; charset=utf-8");
        //header('Access-Control-Allow-Origin: *');
        //header('Access-Control-Allow-Origin: http://www.krolanta.fr');
        //header('Access-Control-Allow-Methods: GET');
        echo json_encode($t, JSON_NUMERIC_CHECK);

    }

    private function downloadStationApi()
    {
        $this->syno = new Synology_DownloadStation_Api('localhost', 5000, 'http', 1);
        $this->syno->connect();

    }

    public function addFile($path)
    {
        $this->log->debug("Class " . __CLASS__ . " | " . __FUNCTION__ . " | path | " . $path);
        $this->downloadStationApi();
        $this->sendResponse($this->syno->addTask($path));
    }

    public function listDlFile()
    {
        $this->downloadStationApi();
        $this->sendResponse($this->syno->getTaskList()->tasks);
    }

    public function deleteFileQueue($id)
    {
        $this->downloadStationApi();
        $this->log->debug("Class " . __CLASS__ . " | " . __FUNCTION__ . " | id | " . $id);
        $this->sendResponse($this->syno->deleteTask($id));

        /* structure de retour success
    [
    {
    "error": 0,
    "id": "dbid_588"
    }
    ]
     */
    }

}
