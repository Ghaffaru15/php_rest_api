<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/Database.php');
include_once ('../../models/Post.php');

//Instantiate database & Connect

$database = new Database();

$db = $database->connect();

//Instantiate BlogPost Object
$post = new Post($db);

$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;
$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

if ($post->update()){
echo json_encode(
array('message'=> 'Post Updated')
);
}else{
echo json_encode(array('message' => 'Post not Updated '));
}