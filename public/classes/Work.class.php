<?php

class Work {
    
   public function __construct() {
    $this->db = new mysqli('localhost', 'root', '', 'webb3project');
    //$this->db  = new mysqli('studentmysql.miun.se', 'momo1600', 'mg7xuf28', 'momo1600');
    if($this->db->connect_errno > 0) {
        die('SQL query error [' . $this->db->connect_error . ']');
      }
    }
    
    //Get works
    public function getWorks() {
        $sql = "SELECT * FROM works";
        if(!$result = $this->db->query($sql)){
            die('SQL query error [' . $db->error . ']');
        }
        $results = []; 
        // Run through the result (all rows returned by the SQL query) 
        while($row = $result->fetch_assoc()){
            $results[] = $row;
        }
        return $results;
    }

    // Add a new work 
    public function addWork($startdate, $enddate, $work, $title, $url) {
        $startdate = strip_tags($startdate);
        $enddate = strip_tags($enddate);
        $work = strip_tags($work);
        $title = strip_tags($title);
        $url = strip_tags($url);

        $sql = "INSERT INTO works (
        	 startdate, 
             enddate,
        	 work, 
             title, 
             url
             ) 
             VALUES 
            (
            '$startdate', 
            '$enddate', 
            '$work', 
            '$title', 
            '$url'
            );";
        
        $result = $this->db->query($sql);
    }
    
      // Get work bye id
      public function getWorkById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM works WHERE id=$id";

        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();

        return $row;
    }

     // Delete work
   public function deleteWork($id) {
        $sql = "DELETE FROM works WHERE id=$id;";
    
        $result = $this->db->query($sql);

        return $result;
    }


// Uppstartdatera work
   public function updateWork($id, $startdate, $enddate, $work, $title, $url) 
   {
    $sql = "UPDATE works SET startdate='$startdate', enddate='$enddate', work='$work', title='$title', url='$url' WHERE id=$id;";
    $result = $this->db->query($sql);

    if(!$result = $this->db->query($sql)){
        die('Fel vid SQL-fråga [' . $this->db->error . ']');
    }

    return $result;
  }

}

?>