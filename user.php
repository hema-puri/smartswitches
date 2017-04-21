<?php

class User{
    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "6AD7AcZwNR6KVvtx";
    //private $dbName     = "smartswitch";
    private $userTbl    = "users";
    
    $dbconn = pg_connect("host=ec2-54-243-107-66.compute-1.amazonaws.com dbname=publishing user=penqubzduicfyj password=b56764297b8becbbf73a2f8bdeaeb44a04469643cf87bb28150d8b111e95589d" dbname=d5ia4h1qdpcnbi)
    or die('Could not connect: ' . pg_last_error());
    
    /*public function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            $dbconn = pg_connect("host=sheep port=5432 dbname=mary user=lamb password=foo");
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }*/
    
    
    public function getRows($conditions = array()){
        $sql = 'SELECT ';
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
        $sql .= ' FROM users ';
        if(array_key_exists("where",$conditions)){
            $sql .= ' WHERE ';
            $i = 0;
            foreach($conditions['where'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        
        if(array_key_exists("order_by",$conditions)){
            $sql .= ' ORDER BY '.$conditions['order_by']; 
        }
        
        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['limit']; 
        }
        
        $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
        
        if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
            switch($conditions['return_type']){
                case 'count':
                    $data = pg_free_result($result);
                    break;
                case 'single':
                    $data = pg_free_result($result);
                    break;
                default:
                    $data = '';
            }
        }else{
            if($result->num_rows > 0){
                while($row = pg_fetch_array($result, null, PGSQL_ASSOC)){
                    $data[] = $row;
                }
            }
        }
        return !empty($data)?$data:false;
    }
    
   
    public function insert($data){
        if(!empty($data) && is_array($data)){
            $columns = '';
            $values  = '';
            $i = 0;
            if(!array_key_exists('created',$data)){
                $data['created'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists('modified',$data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $columns .= $pre.$key;
                $values  .= $pre."'".$val."'";
                $i++;
            }
            $query = "INSERT INTO users (".$columns.") VALUES (".$values.")";
            if($insert = pg_query($query))
            return true;        }else{
            return false;
        }
    }
}
