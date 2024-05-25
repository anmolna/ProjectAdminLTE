<?php
include '../config/dbcon.php';

// Fetch data from events table with pagination
$sql = "SELECT * FROM `event`LIMIT 6";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Output data of each row

  while ($row = $result->fetch_assoc()) {
    $event_image = $row['Image'];
    $events[] = $row;
    $anmol = "anmol";
    $event_title = $row['Title'];
    $event_desc = $row['Description'];
    $event_time = $row['Time'];
    $event_date = $row['Date'];
    $event_venue = $row['Venue'];
  }
} else {
  echo "<p>No recipes found.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles.css" />
    <style>
      .header__image__container{
        background-image:url("https://img.freepik.com/free-vector/global-volunteer-solidarity-hands-up-banner-with-earth-map-vector_1017-48268.jpg?size=626&ext=jpg&ga=GA1.1.2076181659.1716187917&semt=sph")
      }
      .heading_event{
        color:#333333!important;
      }
      .para_heading{
        color:#333333 !important;
        z-index: 10 !important;
        font-family:poppins;
      }
    </style>
    <title>Web Design Mastery | WDM&Co</title>
  </head>
  <body>
    <nav>
      <div class="nav__logo">WDM&Co</div>
      <ul class="nav__links">
        <li class="link"><a href="#">Home</a></li>
        <li class="link"><a href="#">Book</a></li>
        <li class="link"><a href="#">Blog</a></li>
        <li class="link"><a href="#">Contact Us</a></li>
      </ul>
    </nav>
    <header class="section__container header__container">
      <div class="header__image__container">
        <div class="header__content">
          <h1 class="heading_event">Upcoming Events</h1>
          <p class="para_heading">Discover and engage in impactful events with the NGO Events App! Find opportunities aligned with your passions, from local clean-up drives to global campaigns. Stay informed and make a difference. Download now!</p>
        </div>
      </div>
    </header>

    <section class="section__container popular__container">
      <div class="popular__grid">
        <?php
        // Fetch data from events table with pagination
        $sql = "SELECT * FROM `event` LIMIT 6";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // Output data of each row
          while ($row = $result->fetch_assoc()) {
            $event_image = $row['Image'];
            $events[] = $row;
            ?>
            <div class="popular__card">
              <a href="eventpage.php?title=<?php echo urlencode($row['Title']); ?>&venue=<?php echo urlencode($row['Venue']); ?>&date=<?php echo urlencode($row['Date']); ?>&time=<?php echo urlencode($row['Time']); ?>&description=<?php echo urlencode($row['Description']); ?>&image=<?php echo urlencode($row['Image']); ?>">
                <img src="../UploadedImage/<?php echo $row['Image']; ?>" height="200px" alt="Event Image" />
              </a>
              <div class="popular__content">
                <div class="popular__card__header">
                  <h4><?php echo $row['Title']; ?></h4>
                  <h4><?php echo $row['Venue']; ?></h4>
                </div>
                <p><?php echo $row['Description']; ?></p>
                <p><?php echo $row['Date']; ?> at <?php echo $row['Time']; ?></p>
              </div>
            </div>
            <?php
          }
        } else {
          echo "<p>No events found.</p>";
        }
        ?>
      </div>
    </section>

    <section class="client">
      <div class="section__container client__container">
        <h2 class="section__header">What our client say</h2>
        <div class="client__grid">
          <div class="client__card">
            <img src="assets/client-1.jpg" alt="client" />
            <p>
              The booking process was seamless, and the confirmation was
              instant. I highly recommend WDM&Co for hassle-free hotel bookings.
            </p>
          </div>
          <div class="client__card">
            <img src="assets/client-2.jpg" alt="client" />
            <p>
              The website provided detailed information about hotel, including
              amenities, photos, which helped me make an informed decision.
            </p>
          </div>
          <div class="client__card">
            <img src="assets/client-3.jpg" alt="client" />
            <p>
              I was able to book a room within minutes, and the hotel exceeded
              my expectations. I appreciate WDM&Co's efficiency and reliability.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="section__container">
      <div class="reward__container">
        <p>100+ discount codes</p>
        <h4>Join rewards and discover amazing discounts on your booking</h4>
        <button class="reward__btn">Join Rewards</button>
      </div>
    </section>

    <footer class="footer">
      <div class="section__container footer__container">
        <div class="footer__col">
          <h3>WDM&Co</h3>
          <p>
            WDM&Co is a premier hotel booking website that offers a seamless and
            convenient way to find and book accommodations worldwide.
          </p>
          <p>
            With a user-friendly interface and a vast selection of hotels,
            WDM&Co aims to provide a stress-free experience for travelers
            seeking the perfect stay.
          </p>
        </div>
        <div class="footer__col">
          <h4>Company</h4>
          <p>About Us</p>
          <p>Our Team</p>
          <p>Blog</p>
          <p>Book</p>
          <p>Contact Us</p>
        </div>
        <div class="footer__col">
          <h4>Legal</h4>
          <p>FAQs</p>
          <p>Terms & Conditions</p>
          <p>Privacy Policy</p>
        </div>
        <div class="footer__col">
          <h4>Resources</h4>
          <p>Social Media</p>
          <p>Help Center</p>
          <p>Partnerships</p>
        </div>
      </div>
      <div class="footer__bar">
        Copyright © 2023 Web Design Mastery. All rights reserved.
      </div>
    </footer>
  </body>
</html>
