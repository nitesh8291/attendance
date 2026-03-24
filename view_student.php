<?php
include 'db.php';

$roll = $_GET['roll'];
$data = $conn->query("SELECT * FROM attendance WHERE rollno='$roll'");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<table>
<tr>
<th>Name</th>
<th>Roll</th>
<th>Image</th>
<th>Date</th>
</tr>

<?php while($row=$data->fetch_assoc()){ ?>
<tr>
<td><?php echo $row['fullname']; ?></td>
<td><?php echo $row['rollno']; ?></td>
<td><img src="<?php echo $row['image']; ?>" width="80"></td>
<td><?php echo $row['datetime']; ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>