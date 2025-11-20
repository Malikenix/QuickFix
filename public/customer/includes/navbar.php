<?php
if (!defined('MYSITE')) {
    header('Location: ../customer_index.php');
    exit();
}

// ensure session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ensure $conn exists (attempt to include common paths if not)
if (!isset($conn)) {
    $paths = [
        __DIR__ . '/../db/dbconnect.php',
        __DIR__ . '/db/dbconnect.php',
        __DIR__ . '/../../db/dbconnect.php'
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            include $path;
            break;
        }
    }
}

// default values
$customer_name = "Guest";
$customer_pic  = "../img/user.png"; // default avatar

// if logged in, try to fetch profile
if (isset($_SESSION['login_id']) && !empty($_SESSION['login_id']) && isset($conn)) {
    $login_id = (int) $_SESSION['login_id'];

    $q = "SELECT first_name, last_name, profile_picture FROM customer WHERE login_id = $login_id LIMIT 1";
    $res = mysqli_query($conn, $q);
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $fname = trim($row['first_name'] ?? '');
        $lname = trim($row['last_name'] ?? '');
        $customer_name = trim("$fname $lname");
        if ($customer_name === '') {
            $customer_name = "User";
        }

        $pp = $row['profile_picture'] ?? '';
        if (!empty($pp)) {
            // Directly use the path from database if it contains uploads
            if (strpos($pp, 'uploads/') !== false || strpos($pp, '../img/uploads/') !== false) {
                $customer_pic = $pp;
            } else {
                // Otherwise construct the path
                $customer_pic = "../img/uploads/" . $pp;
            }
            
            // Check if file actually exists, if not use default
            if (!file_exists($customer_pic)) {
                $customer_pic = "../img/user.png";
            }
        }
    }
}
?>

<style>
    .list {
        position: relative;
        display: block;
        height: auto;
        overflow: hidden;
    }
    .count {
        position: absolute;
        top: 0;
        right: 0;
        z-index: 2;
        font-size: 11px;
        border-radius: 50%;
        background: #d60b28;
        width: 16px;
        height: 16px;
        line-height: 16px;
        display: block;
        text-align: center;
        color: white;
        font-family: 'Roboto', sans-serif;
        font-weight: bold;
    }
    
    .profile-img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #fff;
    }
   .navbar .btn-c1-2 {
  background: #144272;
  color: #fff;
  border-radius: 6px;
  text-decoration: none;
  text-align: center;
  padding: 8px 14px;    
  display: inline-block;
  transition: background 0.2s ease;
  border-color: 1px solidrgb(12, 94, 16);
}

.navbar .btn-c1-2:hover {
  background: #0a2647;
  color: #fff;
}


</style>

<!-- ===Navbar start=== -->
<nav class="navbar navbar-expand-lg navbar-dark bg-c1-1 sticky-top">
    <a class="navbar-brand" href="customer_index.php">
        <img src="../img/mainlogo.png" style="width:170px;" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="customer_index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="aboutus.php">About Us </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="contactus.php">Contact Us </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    Category
                </a>
                <div class="dropdown-menu">
                    <?php
                    $sql = "SELECT * FROM `category`";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $category_id = $row['category_id'];
                            $category_name = $row['category_name'];
                            echo '<a class="dropdown-item" href="serviceshow.php?category_id=' . $category_id . '">' . htmlspecialchars($category_name) . '</a>';
                        }
                    }
                    ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>

        <form class="form-inline my-2 my-lg-0">
           <!-- <a href="../sp_signup.php"><button type="button" class="btn btn-outline-light mr-2">Register As a Service Provider</button></a>-->

            <div class="btn-group mr-3">
                <a href="service_detailss.php"><button type="button" class="btn btn-c1-2">
                <i class="fa fa-th-list pr-2"></i> My Invoice
                </button></a>
            </div>

            <!-- avatar + dropdown -->
            <div class="dropdown mr-4">
                <a href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo htmlspecialchars($customer_pic); ?>"
                         alt="Profile" class="profile-img" onerror="this.src='../img/user.png'">
                </a>

                <div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-item-text text-center">
                        <strong><?php echo htmlspecialchars($customer_name); ?></strong>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="profile.php"><i class="fa fa-user pr-2"></i> Profile</a>
                    <a class="dropdown-item" href="service_details.php"><i class="fa fa-th-list pr-2"></i> Services</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off pr-2"></i> Logout</a>
                </div>
            </div>

            <!-- list/count -->
            <div class="list">
                <?php
                if (isset($_SESSION['list']) && is_array($_SESSION['list'])) {
                    $count = count($_SESSION['list']);
                    echo '<span class="count">' . intval($count) . '</span>';
                }
                ?>
                <a href="mylisting.php"><img src="../img/clipboard.png" style="width:50px;" alt=""></a>
            </div>
        </form>
    </div>
</nav>
<!-- ===Navbar End=== -->