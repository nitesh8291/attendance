<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
include 'db.php';

$data = $conn->query("SELECT * FROM attendance GROUP BY rollno");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h2 style="text-align:center;color:white;">Admin Dashboard</h2>

<table>
<tr>
<th>Name</th>
<th>Roll</th>
<th>Action</th>
</tr>

<?php while($row=$data->fetch_assoc()){ ?>
<tr>
<td><?php echo $row['fullname']; ?></td>
<td><?php echo $row['rollno']; ?></td>
<td><a href="view_student.php?roll=<?php echo $row['rollno']; ?>">View</a></td>
</tr>
<?php } ?>

</table>

</body>
</html>