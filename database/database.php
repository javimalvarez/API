<?php
class Connection extends Mysqli
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "api_rest";
    //Constructor
    function __construct()
    {
        parent::__construct($this->host, $this->user, $this->pass, $this->db);
        $this->set_charset("utf8");
        if ($this->connect_error) {
            echo $this->connect_error;
            die("Error de conexión");
        }
    }
}
