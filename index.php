<!DOCTYPE html>
<html>
<head>
    <title>PRACTICE</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial; }
        table { border-collapse: collapse; width: 100%; margin-top:20px; }
        table, th, td { border: 1px solid black; padding: 8px; }
        input, select { margin: 5px; }
        button { padding: 5px 10px; }
    </style>
</head>
<body>

<h2>Employee Module</h2>

<form id="form">
    <input type="hidden" id="id" name="id">

    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" placeholder="Last Name" required>
    <input type="text" name="middle_name" placeholder="Middle Name">

    <input type="date" name="birth_date" id="birth_date" required>
    <input type="number" name="age" id="age" readonly placeholder="Age">

    <select name="address" required>
        <option value="">Select Address</option>
        <option value="Manila">Manila</option>
        <option value="Cebu">Cebu</option>
        <option value="Davao">Davao</option>
    </select>

    <input type="number" name="basic_salary" id="basic_salary" placeholder="Basic Salary" required>
    <input type="number" name="annual_salary" id="annual_salary" readonly placeholder="Annual Salary">

    <button type="submit">Save</button>
</form>

<br>
<a href="report.php" target="_blank">View Report</a>

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
// AUTO AGE
$("#birth_date").on("change", function(){
    let birth = new date($(this).val());
    let today = new date();
    let age = today.getFullYear() - birth.getFullYear();
    let m = today.getMonth() - birth.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) age--;
    $("#age").val(age);
});

// AUTO ANNUAL
$("#basic_salary").on("keyup change", function(){
    let basic = $(this).val();
    $("#annual_salary").val(basic * 12);
});

// LOAD TABLE
function loadData(){
    $.get("fetch.php", function(data){
        $("#tableData").html(data);
    });
}
loadData();

// SAVE (INSERT OR UPDATE)
$("#form").submit(function(e){
    e.preventDefault();
    let id = $("#id").val();
    let url = id == "" ? "insert.php" : "update.php";

    $.post(url, $(this).serialize(), function(){
        loadData();
        $("#form")[0].reset();
        $("#id").val("");
    });
});

// DELETE
function deleteData(id){
    if(confirm("Delete this record?")){
        $.post("delete.php", {id:id}, function(){
            loadData();
        });
    }
}

// EDIT
function editData(data){
    $("#id").val(data.id);
    $("input[name='first_name']").val(data.first_name);
    $("input[name='last_name']").val(data.last_name);
    $("input[name='middle_name']").val(data.middle_name);
    $("#birth_date").val(data.birth_date).trigger("change");
    $("select[name='address']").val(data.address);
    $("#basic_salary").val(data.basic_salary).trigger("change");
}
</script>

</body>
</html>