<?php
define('MYSITE', true);
include 'db/dbconnect.php';

$title = 'Register Service Provider';
$css_directory = 'css/main.min.css';
$css_directory2 = 'css/main.min.css.map';
include 'includes/header.php';
/*include 'includes/navbar.php';*/
?>


<?php
$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sp_name = $_POST["sp_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $city_name = $_POST["sp_city"];
    $pincode = $_POST["pincode"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];


    $existsql = "SELECT * FROM `login` where username ='$username' ";
    $existresult = mysqli_query($conn, $existsql);
    $numexist = mysqli_num_rows($existresult);
    if ($numexist > 0) {
        $showError = "Username is already existing.";
    } else {
        if ($password == $cpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            // insert into LOGIN TABLE only USERNAME & PASSWORD.
            $sql = "INSERT INTO `login` (`login_id` , `role_id`, `username`,`password`) VALUES ('', '2', '$username', '$hash')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                //fetch login id from login table.
                $fetch_loginid = "SELECT `login_id` FROM `login` where username ='$username'";
                $fetch_result = mysqli_query($conn, $fetch_loginid);
                $login_row = mysqli_fetch_assoc($fetch_result);
                $login_id = $login_row['login_id'];

                //fetch city is from city table.
                $fetch_cityid = "SELECT `city_id` FROM `city` where city_name ='$city_name'";
                $fetch_city_result = mysqli_query($conn, $fetch_cityid);
                $city_row = mysqli_fetch_assoc($fetch_city_result);
                $city_id = $city_row['city_id'];
                // $sql2 = "INSERT INTO `sp` (`sp_id`, `login_id`, `sp_name`, `email`, `phone`, `city_id`, `pincode`) VALUES (NULL, '16', 'deepkorat', 'deepkorat213@gmail.com', '9687480417', '5', '341262')";
                $sql2 = "INSERT INTO `sp` (`sp_id`, `login_id`, `sp_name`, `email`, `phone`, `city_id`, `pincode`, `status`) VALUES ('', '$login_id', '$sp_name', '$email','$phone','$city_id', '$pincode', 'deactive')";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2) {
                    $showAlert = "Your account is now created.";
                }
            } else {
                $showError = "Something went wrong!";
            }
        } else {
            $showError = "Password do no match!";
        }
    }
}

?>




<body class="d-flex justify-content-center align-items-center min-vh-100" style="background: linear-gradient(135deg, #f0f4f8, #d9e4f5);">

    <div class="container">
        <?php if ($showAlert): ?>
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <strong>Success!</strong> <?= $showAlert; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if ($showError): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <strong>Oops!</strong> <?= $showError; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="card shadow-lg border-0 rounded-4 mx-auto" style="max-width: 600px;">
            <div class="card-body p-4 p-md-5">
                <h3 class="text-center mb-3 fw-bold text-primary">Register as Service Provider</h3>
                <p class="text-center text-muted mb-4">Create your professional account to offer services</p>

                <form class="needs-validation" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" novalidate>

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="sp_name" class="form-label fw-semibold">Full Name</label>
                        <input type="text" id="sp_name" name="sp_name" class="form-control form-control-lg" placeholder="Enter your name" required pattern=".{3,}">
                        <div class="invalid-feedback">Please enter minimum 3 characters.</div>
                    </div>

                    <!-- Email & Phone -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="you@example.com" required>
                            <div class="invalid-feedback">Please provide a valid email.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label fw-semibold">Phone Number</label>
                            <input type="tel" name="phone" class="form-control form-control-lg" placeholder="09XXXXXXXXX" required pattern="^[0-9-+\s()]{10,}$">
                            <div class="invalid-feedback">Please provide a valid phone number.</div>
                        </div>
                    </div>

                    <!-- City & Pincode -->
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="sp_city" class="form-label fw-semibold">City</label>
                            <select id="sp_city" name="sp_city" class="form-select form-select-lg" required>
                                <option value="">Choose City</option>
                                <?php
                                $sql = "SELECT * FROM `city`";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['city_name'] . '">' . $row['city_name'] . '</option>';
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">Please select a city.</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="pincode" class="form-label fw-semibold">Pincode</label>
                            <input type="text" name="pincode" id="pincode" class="form-control form-control-lg" pattern="\d{6}" required>
                            <div class="invalid-feedback">Enter a valid 6-digit pincode.</div>
                        </div>
                    </div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Username</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-primary text-white">@</span>
                            <input type="text" id="username" name="username" class="form-control" placeholder="nickname_number" required pattern="(?=.*[a-z]).{4,}">
                            <div class="invalid-feedback">Please choose a valid username.</div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg"
                                placeholder="••••••••" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                            <div class="invalid-feedback">
                                Must contain uppercase, lowercase, number, and at least 8 characters.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cpassword" class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" id="cpassword" name="cpassword" class="form-control form-control-lg"
                                placeholder="••••••••" required>
                            <div class="invalid-feedback">Passwords do not match.</div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
                    </div>
                    <div class="text-center mt-3">
                        <a href="index.php" class="text-muted text-decoration-none">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        // Bootstrap form validation
        (function () {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>

    <?php
    include 'includes/footer.php';
    ?>