<?php
// Retrieve event details from query parameters
$event_title = isset($_GET['title']) ? urldecode($_GET['title']) : '';
$event_venue = isset($_GET['venue']) ? urldecode($_GET['venue']) : '';
$event_date = isset($_GET['date']) ? urldecode($_GET['date']) : '';
$event_time = isset($_GET['time']) ? urldecode($_GET['time']) : '';
$event_description = isset($_GET['description']) ? urldecode($_GET['description']) : '';
$event_image = isset($_GET['image']) ? urldecode($_GET['image']) : '';

// Display the event details
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles.css" />
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title><?php echo $event_title; ?></title>
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
   <!-- <div class="popular__grid">
       
                                        <div class="popular__card" style="margin-top:120px;">
        <img src="../UploadedImage/<?php echo $event_image; ?>" height="200px" alt="Event Image" />
                                          <div class="popular__content">
                                            <div class="popular__card__header">
                                              <h4><?php echo $event_title; ?></h4>
                                              <h4><?php echo $event_venue; ?></h4>
                                            </div>
                                            <p><?php echo $event_description; ?></p>
                                            <p><?php echo $event_date; ?> at <?php echo $event_time; ?></p>
                                          </div>
                                        </div>
 
      </div> -->
      <div class="container">
        <div class="row">
<div class="col-6 popular__card overflow-hidden">
  <div class="card rounded-lg">
    <img class="" src="../UploadedImage/<?php echo $event_image; ?>" alt="Event Image" />
    <div class="card-body">
      <h5 class="card-title">Event Title</h5>
      <p class="card-text">Description of the event goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      <a href="#" class="btn btn-primary">Learn More</a>
    </div>
  </div>
</div>

          <div class="col-6"> <div class="popular__card__header">
                                              <h4><?php echo $event_title; ?></h4>
                                              <h4><?php echo $event_venue; ?></h4>
                                            </div>
                                            <p><?php echo $event_description; ?></p>
                                            <p><?php echo $event_date; ?> at <?php echo $event_time; ?></p>
                                          </div></div>

        </div>

      </div>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
