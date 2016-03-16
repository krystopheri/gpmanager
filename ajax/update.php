<?php

 

$student_id = $_POST['student_id'];
$exam = $_POST['exam'];
$test = $_POST['test'];
$project = $_POST['project'];
$class_id = $_POST['class_id'];
$session = $_POST['session'];
$term = $_POST['term'];
$subject = $_POST['subject'];
$assignment = $_POST['assignment'];

$total = $exam+$project+$test+$assignment;
$conn = mysqli_connect( "localhost", "root", "", "school") or die(mysqli_error($conn));
 

$query = "UPDATE result SET Exam ='$exam', Total = '$total', Assignment='$assignment', Project ='$project', Test ='$test' WHERE StudentID ='$student_id' AND class_id='$class_id' AND Session='$session' AND SubjectID='$subject'";

mysqli_query($conn, $query) or die(mysqli_error($conn));
echo "$query affected ".mysqli_affected_rows($conn);
 
?>