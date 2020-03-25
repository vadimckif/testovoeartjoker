<?php
class MainModel
{
    public $connect;
    public function __construct()
    {
        $this->connect=new mysqli(DB_SERVER, DB_USER, DB_PASSWORD,DB_NAME);
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        $this->connect->set_charset('utf8');

    }
    public function get_result($sql)
    {
        $arr=[];
        $result=$this->connect->query($sql);
        while($row = $result->fetch_object()) {
             $arr[]=$row;
        }
        $result->free();
        return $arr;
    }
    public function insert($sql)
    {
        $this->connect->query($sql);
        return $this->connect->insert_id;
    }


}