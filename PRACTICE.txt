<!DOCTYPE html>
<html>
<head>
<title>Employee Module</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
body{font-family:Arial}
table{border-collapse:collapse;width:100%;margin-top:20px}
table,th,td{border:1px solid #000;padding:8px}
input,select{margin:5px;padding:5px}
button{padding:5px 10px}
</style>
</head>
<body>

<h2>Employee Module</h2>

<form id="form">
<input type="hidden" name="id" id="id">

<input type="text" name="first_name" placeholder="First Name" required>
<input type="text" name="last_name" placeholder="Last Name" required>
<input type="text" name="middle_name" placeholder="Middle Name">

<input type="date" name="birth_date" id="birth_date" required>
<input type="number" name="age" id="age" readonly placeholder="Age">

<select name="street" required>
<option value="">Street</option>
<option>123 Main St</option>
<option>456 Rizal St</option>
</select>

<select name="barangay" required>
<option value="">Barangay</option>
<option>San Antonio</option>
<option>Sto Niño</option>
</select>

<select name="city" required>
<option value="">City</option>
<option>Manila</option>
<option>Quezon City</option>
</select>

<select name="province" required>
<option value="">Province</option>
<option>Metro Manila</option>
<option>Cebu</option>
</select>

<input type="number" name="basic_salary" id="basic_salary" placeholder="Basic Salary" required>
<input type="number" name="annual_salary" id="annual_salary" readonly placeholder="Annual Salary">

<button type="submit">Save</button>
</form>

<br>

<table>
<thead>
<tr>
<th>Name</th>
<th>Age</th>
<th>Address</th>
<th>Basic</th>
<th>Annual</th>
<th>Action</th>
</tr>
</thead>
<tbody id="tableData"></tbody>
</table>

<script>

$(document).ready(function(){

$("#birth_date").change(function(){
let b=new Date($(this).val())
let t=new Date()
let age=t.getFullYear()-b.getFullYear()
let m=t.getMonth()-b.getMonth()
if(m<0||(m===0&&t.getDate()<b.getDate()))age--
$("#age").val(age)
})

$("#basic_salary").on("keyup change",function(){
$("#annual_salary").val($(this).val()*12)
})

function loadData(){
$.get("fetch.php",function(data){
$("#tableData").html(data)
})
}
loadData()

$("#form").submit(function(e){
e.preventDefault()
$.post("save.php",$(this).serialize(),function(){
loadData()
$("#form")[0].reset()
$("#id").val("")
})
})

window.deleteData=function(id){
if(confirm("Delete?")){
$.post("delete.php",{id:id},function(){
loadData()
})
}
}

window.editData=function(d){
$("#id").val(d.id)
$("input[name='first_name']").val(d.first_name)
$("input[name='last_name']").val(d.last_name)
$("input[name='middle_name']").val(d.middle_name)
$("#birth_date").val(d.birth_date).trigger("change")

$("select[name='street']").val(d.street)
$("select[name='barangay']").val(d.barangay)
$("select[name='city']").val(d.city)
$("select[name='province']").val(d.province)

$("#basic_salary").val(d.basic_salary).trigger("change")
}

})

</script>

</body>
</html>
