<?php

class Project {
    
   public function __construct() {
    $this->db = new mysqli('localhost', 'root', '', 'webb3project');
    //$this->db  = new mysqli('studentmysql.miun.se', 'momo1600', 'mg7xuf28', 'momo1600');
    if($this->db->connect_errno > 0) {
        die('SQL query error [' . $this->db->connect_error . ']');
      }
    }
    
    // Get Project
    public function getProjects() {
        $sql = "SELECT * FROM projects";
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

    // Add a new project 
    public function addProject($startdate, $enddate, $project, $title, $description) {
        $startdate = strip_tags($startdate);
        $enddate = strip_tags($enddate);
        $project = strip_tags($project);
        $title = strip_tags($title);
        $description = strip_tags($description);

        $sql = "INSERT INTO projects (
            startdate, 
            enddate, 
            project, 
            title, 
            description
            ) VALUES 
            (
            '$startdate', 
            '$enddate', 
            '$project', 
            '$title', 
            '$description'
            );";
        
        $result = $this->db->query($sql);

        return $result;
    }

     // Get project bye id
     public function getProjectById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM projects WHERE id=$id";

        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();

        return $row;
    }

   // Delete project
   public function deleteProject($id) {
        $sql = "DELETE FROM projects WHERE id=$id;";
    
        $result = $this->db->query($sql);

        return $result;
    }

   // Update project
   public function updateProject($id, $startdate, $enddate, $project, $title, $description) 
   {
    $sql = "UPDATE projects SET startdate= '$startdate', enddate='$enddate',project='$project', 
    title='$title', description='$description' WHERE id=$id;";
    $result = $this->db->query($sql);

    if(!$result = $this->db->query($sql)){
        die('Fel vid SQL-fråga [' . $this->db->error . ']');
    }

    return $result;
  }

}

?>