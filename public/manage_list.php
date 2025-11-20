<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_to_list'])) {
        $category_id = $_POST['category_id'];
        if (isset($_SESSION['list'])) {
            // check whether this item already added or not
            $myservice = array_column($_SESSION['list'], 'service_title');
            if (in_array($_POST['service_title'], $myservice)) {
                foreach ($_SESSION['list'] as $key => $value) {
                    if ($value['service_title'] == $_POST['service_title']) {
                        $_SESSION['list'][$key]['quantity'] += 1;
                        $_SESSION['status'] = "Quantity updated";
                        echo "<script>
            window.location.href = 'serviceshow.php?category_id=" . $category_id . "';
            </script>";
                    }
                }
                
            } else {
                // success added
                //count the list item. it shows how many services added in this list.
                $count = count($_SESSION['list']);
                $_SESSION['list'][$count] = array(
                    'service_title' => $_POST['service_title'],
                    'service_id' => $_POST['service_id'],
                    'sp_name' => $_POST['sp_name'],
                    'sp_id' => $_POST['sp_id'],
                    'price' => $_POST['price'],
                    'quantity' => 1

                );
                $_SESSION['status'] = "Service successfully added";
                // header("location: serviceshow.php?category_id=' . $category_id . '");
                echo "<script>
                window.location.href = 'serviceshow.php?category_id=" . $category_id . "';
                </script>";
            }
            // print_r($_SESSION['list']);  

        } else {
            $_SESSION['list'][0] = array(
                'service_title' => $_POST['service_title'],
                'service_id' => $_POST['service_id'],
                'sp_name' => $_POST['sp_name'],
                'sp_id' => $_POST['sp_id'],
                'price' => $_POST['price'],
                'quantity' => 1
                
            );

            $_SESSION['status'] = "Service successfully added";
            // header("location: serviceshow.php?category_id='.$category_id.'");

            echo "<script>
                window.location.href = 'serviceshow.php?category_id=" . $category_id . "';
                </script>";

            // print_r($_SESSION['list']);  
        }
    }

    //remove from list code
    if (isset($_POST['remove_service'])) {
        foreach ($_SESSION['list'] as $key => $value) {
            if ($value['service_title'] == $_POST['service_title']) {
                unset($_SESSION['list'][$key]);
                $_SESSION['list'] = array_values($_SESSION['list']); //session ni value rearange krse aa line-code.
                $_SESSION['removesuccess'] = "Service successfully removed.";
                echo '
                <script>
                window.location.href="mylisting.php";
                </script>
                ';
            }
        }
    }



    //change quantity code
    if (isset($_POST['Mod_Quantity'])) {
        foreach ($_SESSION['list'] as $key => $value) {
            if ($value['service_title'] == $_POST['service_title']) {
                $_SESSION['list'][$key]['quantity'] = $_POST['Mod_Quantity'];
                // print_r($_SESSION['list']);
                echo '
                    <script>
                        window.location.href="mylisting.php";
                    </script>
                ';
            }
        }
    }
}
