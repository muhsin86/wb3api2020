<?php

class Course {
    
   public function __construct() {
     $this->db = new mysqli('localhost', 'root', '', 'webb3project');
     //$this->db  = new mysqli('studentmysql.miun.se', 'momo1600', 'mg7xuf28', 'momo1600');
    if($this->db->connect_errno > 0) {
        die('SQL query error [' . $this->db->connect_error . ']');
      }
    }
    
    //Get courses
    public function getCourses() {
        $sql = "SELECT * FROM courses";
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

    // Add a new course 
    public function addCourse($startdate, $enddate, $course, $hei, $url) {
        $startdate = strip_tags($startdate);
        $enddate = strip_tags($enddate);
        $course = strip_tags($course);
        $hei = strip_tags($hei);
        $url = strip_tags($url);

        $sql = "INSERT INTO courses (
            startdate, 
            enddate, 
            course, 
            hei, 
            url
            ) 
            VALUES (
            '$startdate', 
            '$enddate', 
            '$course', 
            '$hei', 
            '$url'
            );";
        
        $result = $this->db->query($sql);

        return $result;
    }

     // Get course bye id
     public function getCourseById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM courses WHERE id=$id";

        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();

        return $row;
    }
// Delete Course
   public function deleteCourse($id) {
        $sql = "DELETE FROM courses WHERE id=$id;";
    
        $result = $this->db->query($sql);

        return $result;
    }


// Uppdatera Course
   public function updateCourse($id, $startdate, $enddate, $course, $hei, $url) 
   {
    $sql = "UPDATE courses SET startdate= '$startdate', enddate='$enddate',course='$course', hei='$hei', url='$url' WHERE id=$id;";
    $result = $this->db->query($sql);

    if(!$result = $this->db->query($sql)){
        die('Fel vid SQL-fråga [' . $this->db->error . ']');
    }

    return $result;
  }

}

?>