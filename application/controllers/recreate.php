<?php

$conn = mysqli_connect("localhost", "root", "", "school") or die(mysqli_error($conn));

$create_result_query = "CREATE TABLE  result (
	int id PRIMARY KEY AUTO_INCREMENT, 
	Year varchar(5),
	Term varchar(5),
	SubjectID int,
	StudentID int,
	Assignment int,
	Exam int,
	Project int,
	Test int,
	RemarkId int)";

mysqli_query($conn, $create_result_query)	or die(mysqli_error($conn));
	

  





?>