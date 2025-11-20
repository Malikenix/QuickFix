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
    <div class="row">
        <div class="col-lg-12 mt-4">
            <?php
            // Alert messages
            if (isset($_SESSION['removesuccess'])) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success! </strong> ' . $_SESSION['removesuccess'] . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
                unset($_SESSION['removesuccess']);
            } elseif (isset($_SESSION['removeunsuccess'])) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops! </strong> ' . $_SESSION['removeunsuccess'] . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
                unset($_SESSION['removeunsuccess']);
            }
            ?>

            <div class="text-center border rounded bg-light my-4">
                <h4>YOUR SERVICE PROVIDER LISTING</h4>
            </div>
        </div>

        <?php
        if (!isset($_SESSION['list']) || count($_SESSION['list']) == 0) {
        ?>
            <div class="container-fluid mt-5">
                <div class="row align-self-center">
                    <div class="col-md-12">
                        <div class="card" style="border:none;">
                            <div class="card-body text-center">
                                <img src="../img/no-task.png" width="130" height="130" class="img-fluid mb-4">
                                <h3><strong>Your List is Empty</strong></h3>
                                <h5 class="text-secondary">You can find more services on our "Service" page :)</h5>
                                <a href="customer_index.php" class="btn btn-c1-1 m-3">Find Services</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="col-lg-12">
                <div class="row">
                    <?php
                    foreach ($_SESSION['list'] as $key => $value) {
                        $sr = $key + 1;
                        $total = $value['price'] * $value['quantity'];

                        // Provider photo (fallback if no image set)
                        $photo = !empty($value['photo']) ? "../uploads/" . $value['photo'] : "../img/default-provider.png";
                    ?>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">

                                    <!-- Provider Photo -->
                                    <div class="text-center mb-3">
                                        <img src="<?php echo $photo; ?>" 
                                             alt="Provider Photo" 
                                             class="img-fluid rounded" 
                                             style="max-width: 200px; height: 200px; object-fit: cover; border: 2px solid #ddd;">
                                    </div>

                                    <h5 class="card-title text-primary"><?php echo $value['service_title']; ?></h5>
                                    <p class="mb-1"><strong>Provider:</strong> <?php echo $value['sp_name']; ?></p>
                                    <p class="mb-1"><strong>Price:</strong> ₱<?php echo $value['price']; ?></p>
                                    <p class="mb-1"><strong>Quantity:</strong> <?php echo $value['quantity']; ?></p>
                                    <p><strong>Total:</strong> ₱<?php echo $total; ?></p>

                                    <!-- Update Quantity -->
                                    <form action="manage_list.php" method="post" class="d-inline-block">
                                        <input type="hidden" name="service_title" value="<?php echo $value['service_title']; ?>">
                                        <input type="number" name="Mod_Quantity" value="<?php echo $value['quantity']; ?>" min="1" onchange="this.form.submit();" class="form-control form-control-sm w-50 d-inline">
                                    </form>

                                    <!-- Remove Button -->
                                    <form action="manage_list.php" method="post" class="d-inline-block">
                                        <input type="hidden" name="service_title" value="<?php echo $value['service_title']; ?>">
                                        <button class="btn btn-sm btn-outline-danger" name="remove_service">Remove</button>
                                    </form>

                                    <hr>

                                    <!-- Inquire Button + Hidden Form -->
                                    <button type="button" class="btn btn-outline-primary btn-sm toggle-inquire-btn">Inquire This Provider</button>

                                    <div class="inquire-form mt-3" style="display: none;">
                                        <form action="hire.php" method="post">
                                            <input type="hidden" name="service_title" value="<?php echo $value['service_title']; ?>">
                                            <input type="hidden" name="sp_name" value="<?php echo $value['sp_name']; ?>">
                                            <input type="hidden" name="price" value="<?php echo $value['price']; ?>">
                                            <input type="hidden" name="quantity" value="<?php echo $value['quantity']; ?>">
                                            <input type="hidden" name="total" value="<?php echo $total; ?>">

                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" class="form-control" name="full_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="tel" class="form-control" pattern="^[0-9-+\s()]{10,}$" name="phone" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="address" class="form-control" rows="2" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Pincode</label>
                                                <input type="text" class="form-control" pattern="\d{6}" name="pincode" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Service Date</label>
                                                <input type="datetime-local" class="form-control due_date" name="due_date" required>
                                                <small class="text-secondary">Select a future date & time</small>
                                                <div class="invalid-feedback">
                                                    <p class="error-message"></p>
                                                </div>
                                            </div>

                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="pay_mode" value="COD" checked>
                                                <label class="form-check-label">Cash on Service (COD)</label>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-block" name="hire">Submit Inquiry</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- JS: Toggle Inquiry Form + Date Validation -->
<script>
document.querySelectorAll('.toggle-inquire-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const form = this.nextElementSibling;

        if (form.style.display === "none" || form.style.display === "") {
            form.style.display = "block";
            this.textContent = "Hide Inquiry Form";
        } else {
            form.style.display = "none";
            this.textContent = "Inquire This Provider";
        }
    });
});

// Date validation
document.querySelectorAll(".due_date").forEach(input => {
    const errorMsg = input.closest(".form-group").querySelector(".error-message");

    input.addEventListener("input", function() {
        const selected = new Date(input.value);
        const now = new Date();
        if (selected < now) {
            errorMsg.textContent = "Please select a future date and time.";
            input.setCustomValidity("Invalid date");
        } else {
            errorMsg.textContent = "";
            input.setCustomValidity("");
        }
    });
});
</script>

<?php include '../includes/footer.php'; ?>
