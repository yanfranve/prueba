<!DOCTYPE html>
<html>
<head>
    <title>Employee Certificate</title>
</head>
<body>
    <h1>Certificate of Employment</h1>
    <p>Name: {{ $employee->name }} {{ $employee->last_name }}</p>
    <p>Email: {{ $employeers->email }}</p>
    <p>Birthdate: {{ $employee->birthdate }}</p>
    <p>Unique Code: {{ $uniqueCode }}</p>
</body>
</html>
