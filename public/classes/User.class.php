<?php


class User {
    function __construct() {
      $this->db = new mysqli('localhost', 'root', '', 'webb3project');
      //$this->db = new mysqli('studentmysql.miun.se', 'momo1600', 'mg7xuf28', 'momo1600');
        if($this->db->connect_errno > 0) {
            die('Fel vid anslutning [' . $this->db->connect_error . ']');
        }
    
    }

    function loginUser($username, $password) {
        $username = $this->db->real_escape_string($username);
        $password = $this->db->real_escape_string($password);

        $query="SELECT * FROM users WHERE username = '$username' and password = '$password'";

        $result = $this->db->query($query);

        if($result->num_rows > 0) {
            $_SESSION['username'] = $username;

            return true;
        } else {
            return false;
            
        }

    }
}

?>