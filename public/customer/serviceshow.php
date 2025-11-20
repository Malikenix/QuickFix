<?php
define('MYSITE', true);
include '../db/dbconnect.php';

$title = 'Main';
$css_directory = '../css/main.min.css';
$css_directory2 = '../css/main.min.css.map';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<style>
    .card:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        transform: translateY(-5px);
        background-color: #0A2647;
        color: white;
    }

    .showcategoryimg {
        background-image: url('../img/services/service_14.jpg');
        object-fit: cover;
        background-repeat: no-repeat;
        background-size: cover;
        opacity: 0.5;
    }

    /* for sticky footer */
    .sticky {
        position: fixed;
        bottom: 0;
        left: 860px;
        bottom: 10px;
        width: 100%;
        z-index: 1;
    }
</style>

<body>
<?php
//fetch category name from index.php
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql = "SELECT * FROM `category` WHERE category_id = $category_id";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $category_id = $row['category_id'];
        $category_name = $row['category_name'];
    } else {
        echo "<script>window.location.href='customer_index.php';</script>";
        exit;
    }
} else {
    // if anyone directly enter url then else part run
    echo "<script>window.location.href='customer_index.php';</script>";
    exit;
}
?>
<style>
    /* ====== Simple & Modern Design ====== */

/* Global reset and font */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

body {
  background: #f4f6f8;
  color: #333;
  line-height: 1.6;
}

/* Category header */
.jumbotron {
  background: linear-gradient(135deg, #0a2647, #144272);
  color: #fff;
  padding: 2rem 1rem;
  border-radius: 0 0 12px 12px;
  margin-bottom: 1rem;
  text-align: center;
}

/* Service button row */
.btn-outline-c1-1 {
  border: 1px solid #0a2647;
  background: #fff;
  color: #0a2647;
  padding: 6px 14px;
  border-radius: 6px;
  margin: 5px 5px;
  cursor: pointer;
  transition: all 0.2s ease;
}

.btn-outline-c1-1:hover {
  background: #0a2647;
  color: #fff;
}

/* Card layout */
.media {
  background: #fff;
  border-radius: 10px;
  padding: 15px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  margin-bottom: 15px;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.media:hover {
  transform: translateY(-3px);
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
}

/* Image on card */
.media img {
  border-radius: 8px;
  margin-bottom: 10px;
}

/* Price & text highlight */
.text-success {
  color: #0a2647 !important;
  font-weight: 600;
}

.badge-success {
  background: #0a2647;
  color: #fff;
  font-size: 0.8rem;
  padding: 4px 8px;
  border-radius: 6px;
}

/* Add to list button */
.btn-c1-1 {
  background: #0a2647;
  color: #fff;
  border: none;
  padding: 6px 12px;
  font-size: 0.85rem;
  border-radius: 6px;
  cursor: pointer;
  transition: background 0.2s ease;
}

.btn-c1-1:hover {
  background: #144272;
}

/* View list button (right side) */
.btn-c1-2 {
  background: #144272;
  color: #fff;
  border-radius: 6px;
  text-decoration: none;
  text-align: center;
  padding: 8px 14px;
  display: inline-block;
  transition: background 0.2s ease;
}

.btn-c1-2:hover {
  background: #0a2647;
  color: #fff;
}

/* Alerts */
.alert {
  border-radius: 6px;
  padding: 10px 14px;
  margin-bottom: 10px;
  font-size: 0.9rem;
}

.alert-success {
  background: #e6f4ea;
  color: #256029;
}

.alert-danger {
  background: #fdecea;
  color: #a42424;
}

.alert-warning {
  background: #fff3cd;
  color: #856404;
}

/* Sticky sidebar (right) */
.sticky {
  position: sticky;
  top: 90px;
}

/* Responsive layout */
@media (max-width: 768px) {
  .media {
    flex-direction: column;
    text-align: center;
  }

  .ml-5 {
    margin-left: 0 !important;
  }

  .sticky {
    position: static;
    margin-top: 20px;
  }
}

</style>

<!-- ===landing page image Start=== -->
<div class="jumbotron jumbotron-fluid bg-c1-4 mb-0">
    <div class="container">
        <h1 class="display-4"><b><?php echo $category_name ?></b></h1>
    </div>
</div>
<div class="bg-white sticky-top">
    <div class="container mb-3 py-4">
        <?php
        //fetch service name
        $sql = "SELECT * FROM `service` WHERE category_id = $category_id";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $service_id = $row['service_id'];
                $service_name = $row['service_name'];
                ?>
                <a href="serviceshow.php?serviceid=<?php echo $service_id ?>">
                    <button type="button" class="btn btn-outline-c1-1"><?php echo $service_name ?></button>
                </a>
                <?php
            }
        } else {
            echo '
            <div class="alert alert-danger" role="alert">
                No Services under ' . $category_name . '
            </div>';
        }
        ?>
    </div>
</div>
<!-- ===landing page image End=== -->


<!-- ===Service provider gig show page image Start=== -->
<div class="container">
    <div class="row">
        <!-- ===Left side main page Start=== -->
        <div class="col-sm-7">
            <div class="">
                <?php
                // fetch sp_service joined with service and sp
                $fetchspgig = "
                    SELECT sp_service.*, sp.sp_name, service.service_name
                    FROM sp_service
                    LEFT JOIN sp ON sp_service.sp_id = sp.sp_id
                    INNER JOIN service ON sp_service.service_id = service.service_id
                    WHERE sp_service.category_id = $category_id
                ";
                $gigresult = mysqli_query($conn, $fetchspgig);

                if ($gigresult && mysqli_num_rows($gigresult) > 0) {
                    while ($gigrow = mysqli_fetch_assoc($gigresult)) {
                        $service_title = $gigrow['service_title'];
                        $category_id   = $gigrow['category_id'];
                        $sp_id         = $gigrow['sp_id'];
                        $sp_name       = !empty($gigrow['sp_name']) ? $gigrow['sp_name'] : "Unknown Provider";
                        $price         = $gigrow['price'];
                        $description   = $gigrow['description'];
                        $service_id    = $gigrow['service_id'];
                        $service_name  = $gigrow['service_name'];
                        $availability  = ($gigrow['availability'] == 1) ? "Yes" : "No";
                        ?>
                        <!-- main card start -->
                        <form action="manage_list.php" method="post">
                            <div class="media m-4">
                                <div class="media-body col-7">
                                    <span class="text-success" style="text-transform:uppercase;"><?php echo $service_name ?></span>
                                    <hr style="margin:2px;">
                                    <h5 class="mt-0"><?php echo $service_title; ?></h5>
                                    <h6>Service provider: <?php echo $sp_name; ?></h6>
                                    <h6 class="badge badge-success">4.4 <i class="fa-solid fa-star"></i></h6>
                                    <h6>Starts at <small>₱</small><?php echo $price ?>/-</h6>
                                    <hr style="margin-bottom: 5px;">
                                    <p><?php echo $description ?></p>
                                </div>

                                <div class="ml-5 text-center" style="width:10rem;">
                                    <img src="../img/<?php echo $category_id ?>.jpg"
                                         style="width:100px; height:100px;object-fit:cover; border-radius:10px"
                                         class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <button type="submit" name="add_to_list"
                                                class="card-link btn btn-c1-1" style="border-radius:10px;">Add to list</button>
                                        <input type="hidden" name="category_id" value="<?php echo $category_id ?>">
                                        <input type="hidden" name="service_id" value="<?php echo $service_id ?>">
                                        <input type="hidden" name="service_name" value="<?php echo $service_name ?>">
                                        <input type="hidden" name="service_title" value="<?php echo $service_title ?>">
                                        <input type="hidden" name="price" value="<?php echo $price ?>">
                                        <input type="hidden" name="sp_name" value="<?php echo $sp_name; ?>">
                                        <input type="hidden" name="sp_id" value="<?php echo $sp_id; ?>">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <!-- main card end -->
                        <?php
                    }
                } else {
                    echo '<div class="alert alert-warning">No providers available in this category.</div>';
                }
                ?>
            </div>
        </div>
        <!-- ===Left side main page End=== -->

        <!-- ===Right side main page Start=== -->
        <div class="col-sm-4 sticky">
            <div class="">
                <!-- Message section -->
                <?php
                if (isset($_SESSION['status'])) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success! </strong> ' . $_SESSION['status'] . '
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                          </div>';
                    unset($_SESSION['status']);
                } elseif (isset($_SESSION['statusfail'])) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Oops! </strong> ' . $_SESSION['statusfail'] . '
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                          </div>';
                    unset($_SESSION['statusfail']);
                }
                ?>

                <div class="row justify-content-around" style="bottom:0; align-items:center;">
                    <a href="mylisting.php" class="card-link btn btn-c1-2 px-5 py-3"><b>View list</b></a>
                </div>
            </div>
        </div>
        <!-- ===Right side main page End=== -->
    </div>
</div>
<!-- ===Service provider gig show page image End=== -->

<script>
    var grandtotal = document.getElementById('grandtotal');
    if (grandtotal) {
        var myVariable = localStorage.getItem("myVar");
        console.log(myVariable);
        grandtotal.innerText = myVariable;
    }
</script>

<?php
include '../includes/footer.php';
?> 
