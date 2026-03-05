<?php
include "db.php";

$r=$conn->query("SELECT * FROM employees");

while($row=$r->fetch_assoc()){

$name=$row['first_name']." ".$row['middle_name']." ".$row['last_name'];
$address=$row['street'].", ".$row['barangay'].", ".$row['city'].", ".$row['province'];

$data=json_encode($row);

echo "<tr>
<td>$name</td>
<td>{$row['age']}</td>
<td>$address</td>
<td>{$row['basic_salary']}</td>
<td>{$row['annual_salary']}</td>
<td>
<button onclick='editData($data)'>Edit</button>
<button onclick='deleteData({$row['id']})'>Delete</button>
</td>
</tr>";
}
?>