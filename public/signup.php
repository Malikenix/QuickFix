<?php 
define('MYSITE', true); 
include 'db/dbconnect.php';  
$title = 'Signup'; 
$css_directory = 'css/main.min.css'; 
$css_directory2 = 'css/main.min.css.map'; 
include 'includes/header.php';   
/*include 'includes/navbar.php'; */
?>

<?php 
$showAlert = false; 
$showError = false;  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["firstname"];
    $last_name = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $city_name = $_POST["city"];
    $pincode = $_POST["pincode"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $existsql = "SELECT * FROM `login` WHERE username ='$username'";
    $existresult = mysqli_query($conn, $existsql);
    $numexist = mysqli_num_rows($existresult);

    if ($numexist > 0) {
        $showError = "Username is already existing.";
    } else {
        if ($password == $cpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `login` (`login_id`, `role_id`, `username`, `password`) VALUES ('', '3', '$username', '$hash')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $fetch_loginid = "SELECT `login_id` FROM `login` WHERE username ='$username'";
                $fetch_result = mysqli_query($conn, $fetch_loginid);
                $login_row = mysqli_fetch_assoc($fetch_result);
                $login_id = $login_row['login_id'];

                $fetch_cityid = "SELECT `city_id` FROM `city` WHERE city_name ='$city_name'";
                $fetch_city_result = mysqli_query($conn, $fetch_cityid);
                $city_row = mysqli_fetch_assoc($fetch_city_result);
                $city_id = $city_row['city_id'];

                $sql2 = "INSERT INTO `customer` (`customer_id`, `login_id`, `first_name`, `last_name`, `email`, `phone`, `address`, `city_id`, `pincode`) 
                         VALUES ('', '$login_id', '$first_name', '$last_name', '$email', '$phone', '$address', '$city_id', '$pincode')";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2) {
                    $showAlert = "Your account has been successfully created.";
                }
            } else {
                $showError = "Something went wrong!";
            }
        } else {
            $showError = "Passwords do not match!";
        }
    }
}
?> 

<body style="background: linear-gradient(135deg, #e0eafc, #cfdef3); min-height: 100vh; display:flex; align-items:center;">

<div class="container py-5">
    <?php if ($showAlert): ?>
        <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
            <strong>✅ Success!</strong> <?= $showAlert ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if ($showError): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow" role="alert">
            <strong>⚠ Error!</strong> <?= $showError ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-lg mx-auto" style="max-width: 650px; border-radius: 1rem;">
        <div class="card-body p-4 p-md-5">
            <h3 class="text-center mb-4 fw-bold text-primary">Create Your Account</h3>
            <hr>

            <form class="needs-validation" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" novalidate>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="spemail" name="email" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone No.</label>
                        <input type="tel" class="form-control" name="phone" required pattern="^[0-9-+\s()]{10,}$">
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" placeholder="Enter your address" required></textarea>
                    </div>
                    <div class="col-md-8">
                        <label for="city" class="form-label">City</label>
                        <select id="city" class="form-select" name="city" required>
                            <option value="">Choose City</option>
                            <?php 
                            $sql = "SELECT * FROM `city`";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $city_name = $row['city_name'];
                                    echo '<option value="' . $city_name . '">' . $city_name . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="pincode" class="form-label">Pincode</label>
                        <input type="text" class="form-control" name="pincode" pattern="\d{6}" id="pincode" required>
                    </div>

                    <hr class="my-3">

                    <div class="col-12">
                        <label for="username" class="form-label">Create Username</label>
                        <div class="input-group">
                            <span class="input-group-text">@</span>
                            <input type="text" class="form-control" pattern="(?=.*[a-z]).{4,}" id="username" name="username" placeholder="nickname_number" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Create Password</label>
                        <input type="password" class="form-control" id="password" name="password" 
                               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                        <div class="form-text text-muted">
                            Must include 8+ characters, 1 uppercase, 1 lowercase, and 1 number.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword" 
                               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                    </div>

                    <div class="col-12 d-flex justify-content-between mt-4">
                        <a href="sp_signup.php" class="btn btn-outline-secondary">Sign Up As Service Provider</a>
                    </div>

                    <div class="col-12 d-flex justify-content-between mt-4">
                        <a href="index.php" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">Sign Up</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
(function () {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>

<?php include 'includes/footer.php'; ?>
