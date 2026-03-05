<?php
$conn = new mysqli("localhost","root","","applicant_exam");

if($conn->connect_error){
    die("Connection failed");
}
?>