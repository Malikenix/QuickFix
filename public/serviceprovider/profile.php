<?php
session_start();
require_once '../db/dbconnect.php'; 

if (!isset($_SESSION['login_id'])) {
    header("Location: ../login.php");
    exit();
}

$login_id = $_SESSION['login_id'];

// Fetch current user details
$sql = "SELECT * FROM customer WHERE login_id = '$login_id' LIMIT 1";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $bio = mysqli_real_escape_string($conn, $_POST['bio']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);

    // Handle profile picture upload
    $profile_picture = $user['profile_picture']; 

    if (!empty($_FILES['profile_picture']['name'])) {
        $target_dir = "../img/uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $filename = time() . "_" . basename($_FILES["profile_picture"]["name"]);
        $target_file = $target_dir . $filename;

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $allowed)) {
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                $profile_picture = $filename;
            } else {
                echo "<div class='alert alert-danger'>Error uploading file.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Only JPG, JPEG, PNG & GIF files allowed.</div>";
        }
    }

    // Update query
    $update_sql = "UPDATE customer 
        SET first_name='$first_name',
            last_name='$last_name',
            email='$email',
            phone='$phone',
            address='$address',
            pincode='$pincode',
            bio='$bio',
            birthdate='$birthdate',
            profile_picture='$profile_picture'
        WHERE login_id='$login_id'";

    if (mysqli_query($conn, $update_sql)) {
        echo "<div class='alert alert-success text-center'>Profile updated successfully!</div>";
        // Refresh user data
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "<div class='alert alert-danger text-center'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-header bg-primary text-white text-center">
            <h4>My Profile</h4>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">

                <div class="text-center mb-3">
                    <img src="<?php echo !empty($user['profile_picture']) ? '../uploads/'.$user['profile_picture'] : '../img/user.png'; ?>" 
                         alt="Profile" class="rounded-circle" width="120" height="120">
                </div>

                <div class="form-group">
                    <label for="profile_picture">Change Profile Picture</label>
                    <input type="file" name="profile_picture" class="form-control-file">
                </div>

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($user['first_name']); ?>">
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($user['last_name']); ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>">
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone']); ?>">
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control"><?php echo htmlspecialchars($user['address']); ?></textarea>
                </div>

                <div class="form-group">
                    <label>Pincode</label>
                    <input type="text" name="pincode" class="form-control" value="<?php echo htmlspecialchars($user['pincode']); ?>">
                </div>

                <div class="form-group">
                    <label>Bio</label>
                    <textarea name="bio" class="form-control"><?php echo htmlspecialchars($user['bio']); ?></textarea>
                </div>

                <div class="form-group">
                    <label>Birthdate</label>
                    <input type="date" name="birthdate" class="form-control" value="<?php echo htmlspecialchars($user['birthdate']); ?>">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                <button type="submit" class="btn btn-primary btn-block">Cancel</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
