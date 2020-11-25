<?php
session_start();

// include 'customFunctions/db_config.php';
include 'customFunctions/config.php';
include 'classes/Database.class.php';

$data = $_POST;

// $sql = "INSERT INTO user_counter";
// echo $data['liked'];
// echo $data['who_clicked'];

$db = new Database();

$db->likeUser($data['liked'], $data['who_clicked']);

// var_dump($db->likeUser($data['liked'], $data['who_clicked']));

