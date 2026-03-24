<?php
include 'db.php';

if(isset($_POST['name'])){

    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $image = $_POST['image'];

    $image = str_replace('data:image/png;base64,','',$image);
    $image = base64_decode($image);

    $filename = time() . ".png";
    $filepath = __DIR__ . "/uploads/" . $filename;

    if(file_put_contents($filepath,$image)){

        $db_path = "uploads/" . $filename;

        $conn->query("INSERT INTO attendance (fullname,rollno,image)
                      VALUES ('$name','$roll','$db_path')");

        echo "Saved Successfully";

    } else {
        echo "File not saved";
    }

} else {
    echo "No Data";
}
?>