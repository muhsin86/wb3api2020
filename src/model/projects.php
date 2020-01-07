<?php
    // Include the config php file 
    include('../includes/config.php'); 
    // Send header information
    header("Access-Control-Allow-Origin: *"); 
    header("Access-Control-Allow-Credentials:", true);
    header("Content-Type: application/json; charset=UTF-8"); 

    // Get HTTP method and input of the request
     $method = $_SERVER['REQUEST_METHOD'];
     // Convert to JSON-format
     $input = json_decode(file_get_contents('php://input'),true);
     
     $project = new Project();
    
    // HTTP method implementations of GET, POST PUT, and DELETE
    switch ($method){ 

        case "GET": // Retrieve project 

        $response = $project->getProjects(); 
        
        if(sizeof($response) > 0 ) { 
        http_response_code(200); // project was found
        } else 
        { http_response_code(404); // Not found 
            $response = array("message" => "Sorry, no projects where found!"); //Show error message 
        } 
        break; 

        case "POST": // Add project
        if($project->addProject($input['startdate'], $input['enddate'], $input['project'], 
            $input['title'], $input['description'])) { 
            http_response_code(201); // project was successfully added 
            $response = array("message" => "project added." ); 

        } else { http_response_code(503); // Server error 

            $response = array("message" => "Sorry, no project was added!"); // Show error message 
        } 
        break; 
        case "DELETE": // Add project
        if($project->deleteProject($request[1])) { 
            http_response_code(201); // project was successfully added 
            $response = array("message" => "project deleted." ); 

        } else { http_response_code(503); // Server error 

            $response = array("message" => "Sorry, no project was deleted!"); // Show error message 
        } 
        break;
        case "PUT": // Add project
        if($project->updateProject($request[1], $input['startdate'], $input['enddate'], $input['project'], 
            $input['title'], $input['description'])) { 
            http_response_code(201); // project was successfully added 
            $response = array("message" => "project updated." ); 

        } else { http_response_code(503); // Server error 

            $response = array("message" => "Sorry, no project was updated!"); // Show error message 
        } 
        break;

        default:

            break;
}
    // Return the result in JSON format
    echo json_encode($response);
?>
