<?php
define('MYSITE', true);
$title = 'Contact Us';
include '../db/dbconnect.php';

// Initialize message variables
$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert into database
    $query = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

    if (mysqli_query($conn, $query)) {
        $success_message = "✅ Your message has been sent successfully!";
    } else {
        $error_message = "❌ There was an error sending your message. Please try again.";
    }
}

$css_directory = '../css/main.min.css';
$css_directory2 = '../css/main.min.css.map';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<style>
body {
  background: #f4f6f8;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  color: #333;
}

/* Section title */
.contact-title {
  text-align: center;
  margin-bottom: 2rem;
}

.contact-title h2 {
  font-weight: 600;
  color: #0a2647;
  margin-bottom: 0.5rem;
}

.contact-title p {
  color: #555;
  font-size: 1rem;
  max-width: 600px;
  margin: 0 auto;
}

/* Alert messages */
.alert {
  padding: 15px;
  border-radius: 8px;
  margin-bottom: 1.5rem;
  font-weight: 500;
  text-align: center;
}

.alert-success {
  background-color: #d4edda;
  color: #155724;
  border: 1px solid #c3e6cb;
}

.alert-error {
  background-color: #f8d7da;
  color: #721c24;
  border: 1px solid #f5c6cb;
}

/* Contact section container */
.contact-section {
  padding: 60px 0;
}

/* Contact form */
.contact-form {
  background: #fff;
  padding: 25px 30px;
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
}

.contact-form .form-label {
  font-weight: 500;
  color: #0a2647;
}

.form-control {
  border-radius: 8px;
  font-size: 0.95rem;
  padding: 10px 12px;
  border: 1px solid #ddd;
  transition: border 0.2s ease;
}

.form-control:focus {
  outline: none;
  border-color: #0a2647;
  box-shadow: 0 0 0 3px rgba(10, 38, 71, 0.15);
}

/* Button */
.btn-send {
  background: #0a2647;
  color: #fff;
  border-radius: 8px;
  padding: 10px 0;
  font-weight: 500;
  transition: background 0.3s ease;
  border: none;
}

.btn-send:hover {
  background: #144272;
}

/* Google Map */
iframe {
  width: 100%;
  height: 350px;
  border: 0;
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
}

/* Responsive layout */
@media (max-width: 768px) {
  .contact-section {
    padding: 40px 0;
  }

  .contact-form {
    margin-bottom: 20px;
  }
}
</style>

<div class="container contact-section">
    <div class="contact-title">
        <h2>Contact Us</h2>
        <p>We’d love to hear from you. Send us a message below.</p>

        <!-- Display success or error messages -->
        <?php if ($success_message): ?>
            <div class="alert alert-success"><?= $success_message; ?></div>
        <?php elseif ($error_message): ?>
            <div class="alert alert-error"><?= $error_message; ?></div>
        <?php endif; ?>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="contact-form">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Your Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Your Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-send w-100">Send Message</button>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3931.085777327987!2d123.89314397491491!3d10.31569968985198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a9992c6d4d7c6b%3A0xe9a7be73f7c13c5!2sCebu%20City!5e0!3m2!1sen!2sph!4v1694407165981!5m2!1sen!2sph" 
                allowfullscreen>
            </iframe>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
include 'includes/navfooter.php';
?>
