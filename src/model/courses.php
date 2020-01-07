<?php
    // Include the config php file 
    include('../includes/config.php'); 
    // Send header information
    header("Access-Control-Allow-Origin: *"); 
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT');
    // header("Access-Control-Allow-Credentials:", true);
    header("Content-Type: application/json; charset=UTF-8"); 

    // Get HTTP method and input of the request
     $method = $_SERVER['REQUEST_METHOD'];
     // Convert to JSON-format
     $input = json_decode(file_get_contents('php://input'),true);
     
     $course = new Course();


    // HTTP method implementations of GET, POST PUT, and DELETE
    switch ($method){ 

        case "GET": // Retrieve courses 

        $response = $course->getCourses(); 
        
        if(sizeof($response) > 0 ) { 
        http_response_code(200); // Courses was found
        } else 
        { http_response_code(404); // Courses Not found 
            $response = array("message" => "Sorry, no courses where found!"); //Show error message 
        } 
        break; 

        case "POST": // Add course
        if($course->addCourse($input['startdate'], $input['enddate'], $input['course'], $input['hei'], $input['url'])) { 
            http_response_code(200); // Course was successfully added 
            $response = array("message" => "Course added." ); 

        } else {
            http_response_code(503); // Server error 

            $response = array("message" => "Sorry, no course was added!"); // Show error message 
        } 
        break; 
        case "DELETE": // Add course
        if($course->deleteCourse($input['id'])) { 
            http_response_code(201); // Course was successfully added 
            $response = array("message" => "Course deleted." ); 

        } else { http_response_code(503); // Server error 

            $response = array("message" => "Sorry, no course was deleted!"); // Show error message 
        } 
        break;
        case "PUT": // Add course
        if($course->updateCourse($input['id'], $input['startdate'], $input['enddate'], $input['course'], 
            $input['hei'], $input['url'])) { 
            http_response_code(201); // Course was successfully added 
            $response = array("message" => "Course updated." ); 

        } else { http_response_code(503); // Server error 

            $response = array("message" => "Sorry, no course was updated!"); // Show error message 
        } 
        break;

        default:

            break;
}
    // Return the result in JSON format
    echo json_encode($response);
?>
