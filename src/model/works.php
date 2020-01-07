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
     
     $work = new Work();
    
    // HTTP method implementations of GET, POST PUT, and DELETE
    switch ($method){ 

        case "GET": // Retrieve work 

        $response = $work->getWorks(); 
        
        if(sizeof($response) > 0 ) { 
        http_response_code(200); // work was found
        } else 
        { http_response_code(404); // Not found 
            $response = array("message" => "Sorry, no works where found!"); //Show error message 
        } 
        break; 

        case "POST": // Add work
        if($work->addWork($input['startdate'], $input['enddate'], $input['work'], 
            $input['title'], $input['url'])) { 
            http_response_code(201); // work was successfully added 
            $response = array("message" => "work added." ); 

        } else { http_response_code(503); // Server error 

            $response = array("message" => "Sorry, no work was added!"); // Show error message 
        } 
        break; 
        case "DELETE": // Add work
        if($work->deleteWork($request[1])) { 
            http_response_code(201); // work was successfully added 
            $response = array("message" => "work deleted." ); 

        } else { http_response_code(503); // Server error 

            $response = array("message" => "Sorry, no work was deleted!"); // Show error message 
        } 
        break;
        case "PUT": // Add work
        if($work->updateWork($request[1], $input['startdate'], $input['enddate'], $input['work'], 
            $input['title'], $input['url'])) { 
            http_response_code(201); // work was successfully added 
            $response = array("message" => "work updated." ); 

        } else { http_response_code(503); // Server error 

            $response = array("message" => "Sorry, no work was updated!"); // Show error message 
        } 
        break;

        default:

            break;
}
    // Return the result in JSON format
    echo json_encode($response);
?>
