<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recipes || Final</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon" />
  <!-- Normalize CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
  <!-- Google Fonts - Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap">
  <!-- Main CSS -->
  <link rel="stylesheet" href="./css/main.css" />
  <style>
    /* Custom Styles */
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f5f5f5;
      color: #333;
      margin: 0;
      padding: 0;
    }
    .navbar {
      background-color: #333;
      color: #fff;
      padding: 15px 0;
      text-align: center;
    }
    .nav-logo {
      display: inline-block;
      text-decoration: none;
      color: #fff;
      font-weight: bold;
      font-size: 1.2rem;
    }
    
    .nav-links {
      margin-top: 10px;
    }
    .nav-link {
      text-decoration: none;
      color: #fff;
      margin: 0 10px;
      font-size: 1rem;
      transition: color 0.3s ease;
    }
    .nav-link:hover {
      color: #ffc107;
    }
    .page {
      margin: 20px auto;
      padding: 0 20px;
      max-width: 1200px;
    }
    .recipes-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      margin-top: 50px;
      margin-left:30px;
    }
    .recipe {
      width: calc(96%);
      background-color: #fff;
      border-radius: 30px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
      transition: transform 0.3s ease;
      margin-bottom: 20px;
    }
    .recipes-list{
      gap: 50px;
    }
    .recipe:hover {
      transform: translateY(-5px);
    }
    .recipe img {
      max-width: 100%;
      border-radius: 10px;
    }
    .recipe h5 {
      margin-top: 15px;
      margin-bottom: 10px;
      font-size: 1.2rem;
      color: #333;
    }
    .recipe p {
      font-size: 1rem;
      color: #666;
      margin-bottom: 8px;
    }
    .pagination {
      margin-top: 30px;
      text-align: center;
    }
    .pagination-link {
      display: inline-block;
      padding: 8px 16px;
      margin: 0 8px;
      color: #333;
      background-color: #ddd;
      border-radius: 4px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }
    .pagination-link:hover {
      background-color: #ffc107;
      color: #fff;
    }
    .page-footer {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 20px 0;
      margin-top: 20px;
    }
    .footer-logo {
      font-weight: bold;
    }
    .footer-link {
      color: #ffc107;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .footer-link:hover {
      color: #fff;
    }
  </style>
</head>
<body>
  <!-- Nav -->
  <nav class="navbar">
    <a href="index.html" class="nav-logo">Simply Recipes</a>
    <div class="nav-links">
      <a href="index.html" class="nav-link">Home</a>
      <a href="about.html" class="nav-link">About</a>
      <a href="tags.html" class="nav-link">Tags</a>
      <a href="events.html" class="nav-link">Events</a>
      <a href="contact.html" class="nav-link">Contact</a>
    </div>
  </nav>
  <!-- Main Content -->
  <main class="page">
   <h2 style="font-weight:bold; color: #333; font-family:Ariel"><center>Upcoming Events</center></h2> 
    <section class="recipes-container">
      <!-- Recipes List -->
      <div class="recipes-list">
        <?php
        // Include database connection
        include '../config/dbcon.php';
        $current_date = date('Y-m-d');
        // Pagination variables
        $results_per_page = 3;
        if (!isset($_GET['page'])) {
          $page = 1;
        } else {
          $page = $_GET['page'];
        }
        $offset = ($page - 1) * $results_per_page;

        // Fetch data from events table with pagination
        $sql = "SELECT * FROM `event`where `Date` >= '$current_date' LIMIT $offset, $results_per_page";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // Output data of each row
          while ($row = $result->fetch_assoc()) {
            echo '<div class="recipe">';
            echo '<a href="eventpage.php" ><img src="../UploadedImage/' . $row["Image"] . '" alt="' . $row["Title"] . '" class="recipe-img" /></a>';
            echo '<h5>' . $row["Title"] . '</h5>';
            echo '<p>' . $row["Description"] . '</p>';
            echo '<p>Venue: ' . $row["Venue"] . '</p>';
            echo '<p>Date: ' . $row["Date"] . '</p>';
            echo '<p>Time: ' . $row["Time"] . '</p>';
            echo '</div>';
          }
        } else {
          echo "<p>No recipes found.</p>";
        }
        ?>
      </div>
    </section>
    <!-- Pagination -->
    <div class="pagination">
      <?php
      $sql = "SELECT COUNT(*) AS total FROM `event`";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $total_pages = ceil($row["total"] / $results_per_page);
      for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='?page=" . $i . "' class='pagination-link'>" . $i . "</a>";
      }
      ?>
    </div>
  </main>
  <main class="page">
   <h2 style="font-weight:bold; color: #333; font-family:Ariel"><center>Past Events</center></h2> 
    <section class="recipes-container">
      <!-- Recipes List -->
      <div class="recipes-list">
        <?php
        // Include database connection
        include '../config/dbcon.php';

        // Pagination variables
        $results_per_page = 3;
        if (!isset($_GET['page'])) {
          $page = 1;
        } else {
          $page = $_GET['page'];
        }
        $offset = ($page - 1) * $results_per_page;

        // Fetch data from events table with pagination
        $sql = "SELECT * FROM `event` where `Date` < '$current_date'  LIMIT $offset, $results_per_page";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // Output data of each row
          while ($row = $result->fetch_assoc()) {
            echo '<div class="recipe">';
            echo '<img src="../UploadedImage/' . $row["Image"] . '" alt="' . $row["Title"] . '" class="recipe-img" />';
            echo '<h5>' . $row["Title"] . '</h5>';
            echo '<p>' . $row["Description"] . '</p>';
            echo '<p>Venue: ' . $row["Venue"] . '</p>';
            echo '<p>Date: ' . $row["Date"] . '</p>';
            echo '<p>Time: ' . $row["Time"] . '</p>';
            echo '</div>';
          }
        } else {
          echo "<p>No Events found.</p>";
        }
        ?>
      </div>
    </section>
    <!-- Pagination -->
    <div class="pagination">
      <?php
      $sql = "SELECT COUNT(*) AS total FROM `event`";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $total_pages = ceil($row["total"] / $results_per_page);
      for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='?page=" . $i . "' class='pagination-link'>" . $i . "</a>";
      }
      ?>
    </div>
  </main>
  <!-- Footer -->
  <footer class="page-footer">
    <!-- Footer content -->
    &copy; <span id="date
