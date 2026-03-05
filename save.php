<?php
include "db.php";

$id=$_POST['id'];
$fn=$_POST['first_name'];
$ln=$_POST['last_name'];
$mn=$_POST['middle_name'];
$bd=$_POST['birth_date'];
$age=$_POST['age'];
$street=$_POST['street'];
$brgy=$_POST['barangay'];
$city=$_POST['city'];
$prov=$_POST['province'];
$basic=$_POST['basic_salary'];
$annual=$_POST['annual_salary'];

if($id==""){
$conn->query("INSERT INTO employees 
(first_name,last_name,middle_name,birth_date,age,street,barangay,city,province,basic_salary,annual_salary)
VALUES('$fn','$ln','$mn','$bd','$age','$street','$brgy','$city','$prov','$basic','$annual')");
}
else{
$conn->query("UPDATE employees SET
first_name='$fn',
last_name='$ln',
middle_name='$mn',
birth_date='$bd',
age='$age',
street='$street',
barangay='$brgy',
city='$city',
province='$prov',
basic_salary='$basic',
annual_salary='$annual'
WHERE id='$id'");
}
?>