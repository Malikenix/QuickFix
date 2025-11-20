<?php
define('MYSITE', true);
include '../db/dbconnect.php';

$title = 'About Us';
$css_directory = '../css/main.min.css';
$css_directory2 = '../css/main.min.css.map';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<style>

/* Global styles */
body {
  background: #f4f6f8;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  color: #333;
  line-height: 1.6;
}

/* Section titles */
.section-title {
  text-align: center;
  margin-bottom: 1.5rem;
  position: relative;
}

.section-title h2,
.section-title h3 {
  font-weight: 600;
  color: #0a2647;
  margin-bottom: 0.5rem;
}

.section-title::after {
  content: "";
  display: block;
  width: 60px;
  height: 3px;
  background: #0a2647;
  margin: 0.5rem auto 0;
  border-radius: 4px;
}

/* Paragraphs */
.about-section p {
  max-width: 800px;
  margin: auto;
  font-size: 1rem;
  color: #555;
  text-align: center;
  line-height: 1.7;
}

/* Team card container */
.team-card {
  background: #fff;
  border: none;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  transition: transform 0.2s ease, box-shadow 0.2s ease;
  text-align: center;
}

.team-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
}

/* Team member image */
.team-card .card-img-top {
  width: 110px;
  height: 110px;
  border-radius: 50%;
  object-fit: cover;
  margin: 20px auto 10px;
  display: block;
  box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.15);
}

/* Member name */
.card-title {
  font-size: 1rem;
  font-weight: 600;
  color: #0a2647;
  margin-top: 0.5rem;
}

/* Member role */
.text-primary {
  color: #144272 !important;
  font-size: 0.9rem;
  font-weight: 500;
  margin-bottom: 0.3rem;
}

/* Description */
.card-text {
  color: #555;
  font-size: 0.88rem;
  line-height: 1.4;
  margin: 0 auto 10px;
  padding: 0 10px;
}

/* Responsive layout */
@media (max-width: 768px) {
  .about-section p {
    padding: 0 15px;
  }

  .team-card {
    margin: 0 auto;
    max-width: 280px;
  }
}

</style>

<div class="container my-5 about-section">
    <div class="section-title">
        <h2>About Us</h2>
    </div>
    <p>
        Welcome to our website! We are a dedicated team providing top-quality home services to our customers.
        Our mission is to offer reliable solutions tailored to meet your needs while ensuring customer satisfaction.
    </p>

    <div class="section-title mt-5">
        <h3>Our Vision</h3>
    </div>
    <p>
        We aim to be the leading service provider in our industry — consistently innovating and improving to help clients achieve their goals with ease.
    </p>

    <div class="section-title mt-5">
        <h3>Meet Our Team</h3>
    </div>

    <div class="row justify-content-center">
        <!-- Team Member -->
        <?php
        $team = [
            ["img"=>"oropesa.jpg", "name"=>"Jhea Claire Oropesa", "role"=>"Founder", "desc"=>"Jhea is the visionary behind our company."],
            ["img"=>"martinez.jpg", "name"=>"Mark Andrew Martinez", "role"=>"Marketing Director", "desc"=>"Andrew brings our brand to life through creative marketing."],
            ["img"=>"arancillo.jpg", "name"=>"John Ramon Arancillo", "role"=>"Lead Developer", "desc"=>"John creates innovative solutions to meet client needs."],
            ["img"=>"romero.jpg", "name"=>"Carry Romero", "role"=>"Product Manager", "desc"=>"Carry oversees strategy and smooth development."],
            ["img"=>"ponce.jpg", "name"=>"Mark Joseph Ponce", "role"=>"Designer", "desc"=>"Mark turns ideas into visually stunning designs."]
        ];

        foreach ($team as $member) {
            echo '
            <div class="col-md-4 col-lg-3 mb-4 d-flex align-items-stretch">
                <div class="card team-card w-100">
                    <img src="img/'.$member["img"].'" class="card-img-top" alt="'.$member["name"].'">
                    <div class="card-body text-center">
                        <h5 class="card-title">'.$member["name"].'</h5>
                        <p class="text-primary mb-1">'.$member["role"].'</p>
                        <p class="card-text">'.$member["desc"].'</p>
                    </div>
                </div>
            </div>';
        }
        ?>
    </div>
</div>

<?php
include 'includes/footer.php';
include 'includes/navfooter.php';
?>
