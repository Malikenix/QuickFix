<?php
include 'db/dbconnect.php';
session_start();

$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = "SELECT `login`.*, `role`.* 
            FROM `login`
            INNER JOIN `role` ON `login`.role_id = `role`.role_id
            WHERE `login`.username='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];
        $role_name = $row['role_name'];
        $login_id = $row['login_id'];

        if (password_verify($password, $hashed_password)) {
            if ($role_name == 'serviceprovider') {
                $fetchsp = "SELECT * FROM `sp` WHERE login_id = $login_id";
                $fetchspresult = mysqli_query($conn, $fetchsp);
                $rowsp = mysqli_fetch_assoc($fetchspresult);
                $status = $rowsp['status'];
                $sp_id = $rowsp['sp_id'];

                if ($status == 'deactive') {
                    $showError = "Please wait, your account is pending admin approval.";
                } else {
                    $_SESSION['sp_loggedin'] = true;
                    $_SESSION['sp_username'] = $username;
                    $_SESSION['sp_login_id'] = $login_id;
                    $_SESSION['role_name'] = $role_name;
                    $_SESSION['sp_id'] = $sp_id;
                    header("Location: serviceprovider/sp_index.php");
                    exit();
                }
            } elseif ($role_name == 'admin') {
                $_SESSION['admin_loggedin'] = true;
                $_SESSION['admin_username'] = $username;
                $_SESSION['admin_login_id'] = $login_id;
                $_SESSION['role_name'] = $role_name;
                header("Location: admin/index.php");
                exit();
            } elseif ($role_name == 'customer') {
                $fetchcustomer = "SELECT * FROM `customer` WHERE login_id = $login_id";
                $fetchcustomerresult = mysqli_query($conn, $fetchcustomer);
                $rowcustomer = mysqli_fetch_assoc($fetchcustomerresult);
                $customer_id = $rowcustomer['customer_id'];

                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['login_id'] = $login_id;
                $_SESSION['role_name'] = $role_name;
                $_SESSION['customer_id'] = $customer_id;
                header("Location: customer/customer_index.php");
                exit();
            }
        } else {
            $showError = "Invalid username or password.";
        }
    } else {
        $showError = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ✅ Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body style="background: linear-gradient(135deg, #e0eafc, #cfdef3); min-height: 100vh; display: flex; align-items: center;">

<div class="container py-5">
    <?php if ($showError): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow" role="alert">
            <strong>⚠ Error:</strong> <?= htmlspecialchars($showError) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-lg mx-auto" style="max-width: 450px; border-radius: 1rem;">
        <div class="card-body p-4">
            <h3 class="text-center mb-3 fw-bold text-primary">QuickFix</h3>
            <p class="text-center text-muted mb-4">Sign in to continue</p>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" novalidate>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="username" name="username" 
                               placeholder="Enter username" required pattern="[A-Za-z0-9_-]{3,20}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Enter password" required minlength="6">
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="showpassword">
                        <label class="form-check-label small" for="showpassword">Show Password</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2">Login</button>

                <div class="text-center mt-3">
                    <a href="ForgotPassword/forgotpassword.php" class="text-decoration-none small">Forgot password?</a>
                </div>
                <hr>
                <div class="text-center">
                    <small>Don't have an account? <a href="signup.php" class="fw-semibold text-primary text-decoration-none">Sign up</a></small>
                </div>
                <div class="text-center mt-2">
                    <a href="index.php" class="btn btn-outline-secondary btn-sm">Back to Home</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('showpassword').addEventListener('click', function () {
        const input = document.getElementById('password');
        input.type = input.type === 'password' ? 'text' : 'password';
    });
</script>

</body>
</html>
