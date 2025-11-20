<?php
define('MYSITE', true);
include '../db/dbconnect.php';

$css_directory = '../css/main.min.css';
$css_directory2 = '../css/main.min.css.map';
include 'includes/header.php';
include 'includes/navbar.php';


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

    // Update user info
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
    <style>
        body {
           
            font-family: "Poppins", sans-serif;
        }
        .profile-container {
            max-width: 800px;
            background: white;
            margin: 40px auto;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            overflow: hidden;
            display: flex;
            flex-wrap: wrap;
        }
        .profile-left {
            background: #f0f4ff;
            flex: 1 1 250px;
            padding: 20px;
            text-align: center;
        }
        .profile-left img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .profile-left h3 {
            margin-top: 10px;
            font-size: 18px;
        }
        .profile-left p {
            color: #555;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .profile-left .edit-btn {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            text-decoration: none;
        }
        .profile-left .edit-btn:hover {
            background: #0056cc;
        }

        .profile-right {
            flex: 2 1 500px;
            padding: 25px;
        }
        .profile-right h4 {
            margin-bottom: 15px;
            font-weight: 600;
            font-size: 16px;
            color: #007bff;
            text-transform: uppercase;
        }
        .profile-right .form-group label {
            font-weight: 500;
        }
        .btn-save {
            background: #144272;
            color: white;
            border-radius: 8px;
        }
        .btn-save:hover {
            background: #0056cc;
        }
    </style>
</head>
<body>

<div class="profile-container">
    <!-- LEFT PROFILE CARD -->
    <div class="profile-left">
        <img src="<?php echo !empty($user['profile_picture']) ? '../img/uploads/'.$user['profile_picture'] : '../img/user.png'; ?>" alt="Profile Picture">
        <h3><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h3>
        <p><?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>📞</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
        <p><strong>📍</strong> <?php echo htmlspecialchars($user['address']); ?></p>
        <a href="#editForm" class="edit-btn">✏ Edit Profile</a>
    </div>

    <!-- RIGHT FORM -->
    <div class="profile-right">
        <h4>Profile Information</h4>
        <form action="" method="POST" enctype="multipart/form-data" id="editForm">
            <div class="form-group">
                <label>Change Profile Picture</label>
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

            <button type="submit" class="btn btn-save btn-block">💾 Save Changes</button>
            <a href="customer_index.php" class="btn btn-secondary btn-block mt-2">Cancel</a>
        </form>
    </div>
</div>

</body>

</html>
<?php
include 'includes/footer.php';
include 'includes/navfooter.php';
?>

