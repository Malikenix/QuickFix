        <?php
        session_start();
        include '../db/dbconnect.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['hire'])) {
                if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
                echo "<script>window.location.href = '../login.php';</script>";
                exit;
                } else {
                $customer_id = $_SESSION['customer_id'];
                $full_name   = $_POST['full_name'];
                $phone       = $_POST['phone'];
                $address     = $_POST['address'];
                $pincode     = $_POST['pincode'];

                date_default_timezone_set('Asia/Kolkata');
                $hire_date = date('Y-m-d H:i:s');

                // ✅ Adjusted insert query (removed pay_mode, total, due_date)
                $masterquery = "INSERT INTO `hire_master`
                        (`customer_id`, `full_name`, `phone`, `address`, `pincode`, `hire_date`)
                        VALUES ($customer_id, '$full_name','$phone','$address','$pincode','$hire_date')";

                $result = mysqli_query($conn, $masterquery);

                if ($result) {
                        $hire_id = mysqli_insert_id($conn);

                        $query2 = "INSERT INTO `hire_service`
                        (`hire_id`, `service_id`, `sp_id`, `service_title`, `price`, `qty`, `status`)
                        VALUES (?,?,?,?,?,?,?)";
                        $stmt = mysqli_prepare($conn, $query2);

                        if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "iiissis",
                                $hire_id, $service_id, $sp_id, $service_title, $price, $quantity, $status
                        );

                        foreach ($_SESSION['list'] as $key => $value) {
                                $service_id    = $value['service_id'];
                                $sp_id         = $value['sp_id'];
                                $service_title = $value['service_title'];
                                $price         = $value['price'];
                                $quantity      = $value['quantity'];
                                $status        = "pending";

                                mysqli_stmt_execute($stmt);
                        }

                        unset($_SESSION['list']);

                        echo '<script>
                                window.location.href="service_placed.php?hire_id='.$hire_id.'&customer_id='.$customer_id.'";
                        </script>';
                        } else {
                        echo '<script>
                                alert("SQL Query prepare Error");
                                window.location.href="mylisting.php";
                        </script>';
                        }
                } else {
                        echo '<script>
                        alert("SQL Error");
                        window.location.href="mylisting.php";
                        </script>';
                }
                }
        }
        }
        ?>
