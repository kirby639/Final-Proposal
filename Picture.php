<?php
session_start();
if (!isset($_SESSION["loggedInUser"])) {
    header("Location: Login.html");
    exit();
}

$userID = $_SESSION["loggedInUser"];

require "db_connect.php";

// Fetch user info from database
$sql = "SELECT * FROM students WHERE user_id = '$userID'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    die("User not found in database.");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CTU ID Card</title>
    <link rel="stylesheet" href="style.css">

    <style>
        .container {
            width: 700px;
            margin: 80px auto;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
        }

        h1 {
            margin-bottom: 25px;
            font-size: 28px;
            color: #f0eaea;
        }

        .id-card-container {
            position: relative;
            width: 600px;
            margin: 0 auto;
            color: black;
        }

        #id-template {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }

        #user-photo-overlay {
            position: absolute;
            width: 233px;
            height: 230px;
            top: 148px;
            left: 190px;
            overflow: hidden;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        #user-pic {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info-overlay {
            position: absolute;
            font-family: Arial, sans-serif;
            color: #fcfcfc;
            font-weight: bold;
            width: 100%;
            text-align: center;
        }

        #name-overlay {
            top: 63%;
            left: 0;
            font-size: 21px;
        }

        #course-overlay {
            top: 69%;
            left: 0;
            font-size: 21px;
        }

        #id-overlay {
            top: 77%;
            left: 0;
            font-size: 20px;
        }

        #logoutBtn {
            margin-top: 30px;
            padding: 12px 25px;
            background: #d90429;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">
    <h1>Cebu Technological University - ID Card</h1>

    <div class="id-card-container">
        <img id="id-template" src="ID.png">

        <!-- PHOTO -->
        <div id="user-photo-overlay">
            <img id="user-pic" src="data:image/jpeg;base64,<?php echo base64_encode($user['photo']); ?>">
        </div>

        <!-- TEXT FIELDS -->
        <div class="info-overlay" id="name-overlay">
            <?php echo htmlspecialchars($user['full_name']); ?>
        </div>

        <div class="info-overlay" id="course-overlay">
            <?php echo htmlspecialchars($user['course']); ?>
        </div>

        <div class="info-overlay" id="id-overlay">
            <?php echo htmlspecialchars($user['user_id']); ?>
        </div>

    </div>

    <button id="logoutBtn" onclick="window.location='logout.php'">Logout</button>
</div>

</body>
</html>
