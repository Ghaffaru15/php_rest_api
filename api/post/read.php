<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once ('../../models/Post.php');

//Instantiate database & Connect

$database = new Database();

$db = $database->connect();

//Instantiate BlogPost Object
$post = new Post($db);

//Blog post query
$res = $post->read();

//Get row count
$num = $res->rowCount();

if ($num > 0){

    //Post array
     $post_arr = array();
     $post_arr['data'] = array();

     while ($row = $res->fetch(PDO::FETCH_ASSOC))
     {
         extract($row);

         $post_item = ['id' => $id, 'title' => $title, 'body' => html_entity_decode($body),'author' => $author,
             'category_id' => $category_id, 'category_name' => $category_name];

         //Push to "data"
         array_push($post_arr['data'],$post_item);
     }
     //Turn it to JSON & Output
    echo json_encode($post_arr);

}else{
    //No Posts
    echo json_encode(
        array('message' => 'no posts found')
    );
}