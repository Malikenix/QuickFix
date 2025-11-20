<?php
define('MYSITE', true);
include '../db/dbconnect.php';

$title = 'Main';
$css_directory = '../css/main.min.css';
$css_directory2 = '../css/main.min.css.map';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<body>
    <div class="container">
        <br><br>

        <?php
        $customer_id = $_SESSION['customer_id'];
        $query1 = "SELECT * FROM `hire_master` WHERE `customer_id` = $customer_id ORDER BY hire_id DESC";
        $result1 = mysqli_query($conn, $query1);

        if ($result1) {
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $hire_id = $row1['hire_id'];
                $full_name = $row1['full_name'];
                $delivery_address = $row1['address'];
                $hire_date = $row1['hire_date'];
                $real_hire_date = date('j F, Y', strtotime($hire_date));
        ?>

                <div class="bg-dark p-5">
                    <div class="table-responsive-sm mt-3 ">
                        <table class="table table-hover table-dark p-5 ">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" colspan="5">Hire Provider Confirmation #<?php echo $hire_id; ?> </th>
                                    <th scope="col" colspan="2">Hire Date:</th>
                                    <th scope="col" colspan="2"><?php echo $real_hire_date; ?> </th>
                                </tr>
                                <tr>
                                    <th scope="col">Sno. </th>
                                    <th scope="col">Service name</th>
                                    <th scope="col">Service provider name</th>
                                    <th scope="col">Phone(SP)</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Qty.</th>
                                    <th scope="col">Price(₱)</th>
                                    <th scope="col">Total(₱)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sno = 0;
                                // user_service still uses service_id (if you rename later, update here too)
                                $query2 = "SELECT * FROM `hire_service` WHERE `hire_id` = $hire_id";
                                $result2 = mysqli_query($conn, $query2);

                                if ($result2) {
                                    $grand_total = 0;
                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        $service_title = $row2['service_title'];
                                        $price = $row2['price'];
                                        $qty = $row2['qty'];
                                        $status = $row2['status'];
                                        $sp_id = $row2['sp_id'];
                                        $sno += 1;

                                        $spname = "SELECT * FROM `sp` WHERE sp_id = $sp_id";
                                        $spname_result = mysqli_query($conn, $spname);
                                        while ($sprow = mysqli_fetch_assoc($spname_result)) {
                                            $sp_name = $sprow['sp_name'];
                                            $phone = $sprow['phone'];
                                        }

                                        $line_total = $price * $qty;
                                        $grand_total += $line_total;
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo $sno ?></th>
                                            <td><?php echo $service_title ?></td>
                                            <td class="align-middle"><?php echo $sp_name ?></td>
                                            <td><?php echo $phone ?></td>
                                            <td class="align-middle">
                                                <?php
                                                if ($status == 'pending') echo '<span class="badge badge-warning">Pending</span>';
                                                if ($status == 'rejected') echo '<span class="badge badge-danger">Rejected</span>';
                                                if ($status == 'inprogress') echo '<span class="badge badge-primary">In Progress</span>';
                                                if ($status == 'completed') echo '<span class="badge badge-success">Completed</span>';
                                                if ($status == 'uncompleted') echo '<span class="badge badge-secondary">Uncompleted</span>';
                                                ?>
                                            </td>
                                            <td><?php echo $qty ?></td>
                                            <td><?php echo $price ?></td>
                                            <td><?php echo $line_total ?></td>
                                        </tr>
                                <?php
                                    } // while row2 end
                                } // if result2 end
                                ?>
                            </tbody>
                            <!-- total amount -->
                            <tr>
                                <th></th><th></th><th></th>
                                <th colspan="4"><h3>TOTAL</h3></th>
                                <td><h3>₱ <?php echo $grand_total ?></h3></td>
                            </tr>
                            <!-- delivery address -->
                            <tr>
                                <th></th><th></th><th></th>
                                <th colspan="4">Customer Address</th>
                                <td><?php echo $delivery_address ?></td>
                            </tr>
                            <tr>
                                <th colspan="7"></th>
                                <td>
                                    <form action="../php/invoice.php" method="post">
                                        <button type="submit" name="invoice" class="btn btn-success">Invoice</button>
                                        <input type="hidden" name="hire_id" value="<?php echo $hire_id ?>">
                                        <input type="hidden" name="customer_id" value="<?php echo $customer_id ?>">
                                        <button class="btn btn-danger">Cancel Provider</button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br><br><br><br>
        <?php
            } // while result1 end
        } // if result1 end
        ?>
    </div>

    <?php
    include '../includes/footer.php';
    ?>
