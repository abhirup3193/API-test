<?php 
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('content-Type: application/json');   

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect(); 

    // Instantiate post object
    $post = new Post($db);

    //Post Query
    $result = $post->read();
    //Get row count
    $num = $result->rowCount();
    // check if any posts
    if($num > 0 ){
        //Post array
        $posts_arr =  array();
        $posts_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $post_item = array(
                'id' => $id,
                'organization' => $organization,
                //'body' => html_entity_decode($body),
                'projectName'=> $projectName,
                'projectDescription' => $projectDescription,
                'req_date' => $req_date,
                'endUser' => $endUser               
            );

            // Push to "data"
            array_push($posts_arr['data'], $post_item);
        }

        //Turn to JSON & Output
        echo json_encode($posts_arr);
        
    } else {
        // No posts
        echo json_encode(
            array('message' => 'No posts Found')
        );
    }