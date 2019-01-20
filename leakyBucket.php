<?php
session_start();
include_once('db.php');
    
class DropInTheBucket{
    private $count;
    private $dbh;
    private $conn;
    
    function __construct($ip)
    {
        // Database objects accessible to all class elements
        $this->dbh = new db();
        
        
        if($this->conn = $this->dbh->connect()){
              // insert the drop
                $this->insertDrop($ip);
                $this->setDropCount($ip);
        }
        
    }
    private function insertDrop($ip){
        
            $sql = "INSERT INTO login_drops(id, ip, timestamp)
            VALUES (null, '$ip', null)" ;
            $sqlResult = $this->conn->query($sql);
    }
    
    private function setDropCount($ip){
        
        $sql = "SELECT count('ip') as 'ip_count' FROM login_drops WHERE ip='$ip'";
        $result = $this->conn->query($sql);
        $resultArr = $result->fetch_assoc();
        $this->count = $resultArr['ip_count'];
        
        
    }
    public function getDropCount($ip){
         
        $_SESSION['count'] = $this->count;
        return $this->count;
    }
    public function emptyBucket($ip){
        $sql = "DELETE FROM login_drops WHERE ip='$ip'";
        $sqlResult = $this->conn->query($sql);
    }
    public function leak($amount,$ip){
        $sql = "DELETE FROM login_drops WHERE ip='$ip' LIMIT $amount";
        $sqlResult = $this->conn->query($sql);
    }

}
