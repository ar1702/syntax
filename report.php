<?php
include 'db.php';

$result = $conn->query("
SELECT 
COUNT(*) total,
SUM(CASE WHEN age BETWEEN 18 AND 25 THEN 1 ELSE 0 END) age1,
SUM(CASE WHEN age BETWEEN 26 AND 30 THEN 1 ELSE 0 END) age2,
SUM(CASE WHEN age >= 31 THEN 1 ELSE 0 END) age3,
AVG(basic_salary) avg_salary,
SUM(annual_salary) total_annual
FROM employees
");

$data = $result->fetch_assoc();
?>

<h2>Report</h2>

<table border="1" cellpadding="10">
<tr>
    <th rowspan="2">Number of Employees</th>
    <th colspan="3">Age Bracket</th>
    <th rowspan="2">Average Salary per Month</th>
    <th rowspan="2">Total Annual Salary</th>
</tr>

<tr>
    <th>18-25</th>
    <th>26-30</th>
    <th>31-Older</th>
</tr>

<tr>
    <td><?= $data['total'] ?></td>
    <td><?= $data['age1'] ?></td>
    <td><?= $data['age2'] ?></td>
    <td><?= $data['age3'] ?></td>
    <td><?= number_format($data['avg_salary'],2) ?></td>
    <td><?= number_format($data['total_annual'],2) ?></td>
</tr>
</table>