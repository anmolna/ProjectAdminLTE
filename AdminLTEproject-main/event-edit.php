<?php
session_start();
include ('includes/header.php');
include ('includes/topbar.php');
include ('includes/sidebar.php');
include ('config/dbcon.php');
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Register Event</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Register Event</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit-Event Detail</h3>
                            <a href="registered.php" class="btn btn-primary btn-sm float-right">Back</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="AddEventCode.php" method="POST">
                                        <div class="modal-body">
                                        <!-- Now here we will create the modal for our Resgistration process -->
                                        <?php
                                        if (isset($_GET['event_id'])) {
                                            $event_id = $_GET['event_id'];
                                            $sql = "SELECT * FROM event WHERE id='$event_id' LIMIT 1";
                                            $query_result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($query_result) > 0) {
                                                foreach ($query_result as $row) {
                                                    ?>
                                                                                                        <input type="hidden" name="event_id" value="<?php echo $row['Id'] ?>">
                                                                                                         <div class="form-group">
                                                                                                            <label for="">Title</label>
                                                                                                            <input type="text"
                                                                     
                                                                                                            name="title" class="form-control" 
                                                                                                            value="<?php echo $row['Title'] ?> "
                                                                                                            placeholder="title">
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                            <label for="">Image</label>
                                                                                                            <input type="file" 
                                                                      
                                                                                                            class="form-control" 
                                                                                                            name="image"
                                                                                                            value="<?php echo $row['Image'] ?> "
                                                                                                            placeholder="Image">
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                            <label for="">Description</label>
                                                                                                            <input 
                                                                      
                                                                                                            type="text-area" name="description" class="form-control" 
                                                                                                            value="<?php echo $row['Description'] ?> "
                                                                                                            placeholder="Description">
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                            <label for="">Venue</label>
                                                                                                            <input
                                                                      
                                                                                                            type="text" name="venue" class="form-control"
                                                                                                            value="<?php echo $row['Venue'] ?> " 
                                                                                                            placeholder="Venue">
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                            <label for="">Date</label>
                                                                                                            <input                                                                     
                                                                                                            type="date" name="date" class="form-control"
                                                                                                            value="<?php echo $row['Date'] ?> " 
                                                                                                            placeholder="Date">
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                            <label for="">Time</label>
                                                                                                            <input
                                                                                                            type="time" name="time" class="form-control"
                                                                                                            value="<?php echo $row['Time'] ?> " 
                                                                                                            placeholder="Time">
                                                                                                        </div>
                                                                                                    <?php
                                                }
                                            } else {
                                                echo "<h4>No record Found.</h4>";
                                            }
                                        }
                                        ?>

                                        <div class="modal-footer">
                                        <button type="submit" class="btn btn-info" name="UpdateEvent">Update changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include ('includes/script.php');
    ?>
<?php
include ('includes/footer.php');
?>