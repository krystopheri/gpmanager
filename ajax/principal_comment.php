<?php

 

		
$comment = $_POST['comment'];
$session = $_POST['sessionp'];
$term = $_POST['termp'];
$class_id = $_POST['classid'];
$student_id = $_POST['student_id']; 
$session = str_replace("/", "_", $session);
$conn = mysqli_connect("localhost", "root", "", "school") or die("Error Connecting" .mysqli_error($conn));

$query  = "INSERT INTO principal_comment (comment, session, term, class_id, student_id) VALUES('$comment', '$session', '$term', '$class_id', '$student_id')";

mysqli_query($conn, $query) or die(mysqli_error($conn));

?>