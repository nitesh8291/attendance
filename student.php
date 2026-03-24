<?php
session_start();
if(!isset($_SESSION['student'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<h2>Student Form</h2>

<input id="name" placeholder="Full Name">
<input id="roll" placeholder="Roll Number">

<video id="video" width="250" autoplay></video>

<br><br>

<button onclick="capture()">📸 Capture</button>
<button onclick="retake()">🔁 Retake</button>

<br><br>

<!-- Preview Image -->
<img id="preview" width="250" style="display:none;">

<canvas id="canvas" style="display:none;"></canvas>

<br><br>

<button onclick="submitData()">✅ Submit</button>

</div>

<script>
// 🎥 Camera Start
navigator.mediaDevices.getUserMedia({video:true})
.then(stream=>{
    document.getElementById("video").srcObject = stream;
});

// 📸 Capture Image
function capture(){
    let canvas = document.getElementById("canvas");
    let video = document.getElementById("video");
    let preview = document.getElementById("preview");

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    canvas.getContext("2d").drawImage(video,0,0);

    // show preview
    let imgData = canvas.toDataURL();
    preview.src = imgData;
    preview.style.display = "block";
}

// 🔁 Retake
function retake(){
    document.getElementById("preview").style.display = "none";
    document.getElementById("canvas").getContext("2d").clearRect(0,0,500,500);
}

// ✅ Submit
function submitData(){

    let name = document.getElementById("name").value.trim();
    let roll = document.getElementById("roll").value.trim();
    let image = document.getElementById("canvas").toDataURL();

    // 🔒 Name validation (only letters)
    if(!/^[A-Za-z ]+$/.test(name)){
        alert("❌ Full Name me sirf letters allowed hai");
        return;
    }

    // 🔒 Roll validation (only numbers)
    if(!/^[0-9]+$/.test(roll)){
        alert("❌ Roll Number me sirf numbers allowed hai");
        return;
    }

    // 📸 Image check
    if(image.length < 100){
        alert("❌ Please capture image first!");
        return;
    }

    let formData = new FormData();
    formData.append("name", name);
    formData.append("roll", roll);
    formData.append("image", image);

    fetch("upload.php",{
        method:"POST",
        body:formData
    })
    .then(res=>res.text())
    .then(data=>{
        alert(data);
        location.reload(); // reset form
    });
}
</script>

</body>
</html>