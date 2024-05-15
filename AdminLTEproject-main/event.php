<?php
session_start();
include ('includes/header.php');
include ('includes/topbar.php');
include ('includes/sidebar.php');
include ('config/dbcon.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Model To add Admin -->
    <div class="modal fade" id="AddUserModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="AddEventCode.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <!-- Now here we will create the modal for our Resgistration process -->
              <div class="form-group">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter Title">
              </div>
              <div class="form-group">
                <label for="">Image</label>
                <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
              </div>
              <div class="form-group">
                <label for="">Description</label>
                <input type="text-area" name="description" class="form-control" placeholder="Enter description">
              </div>
               <div class="form-group">
               <label for="">Venue</label>
                <input type="text" name="venue" class="form-control" placeholder="Enter venue">
              </div>
              <div class="form-group">
               <label for="">Date</label>
                <input type="date" name="date" class="form-control" placeholder="Enter Date">
              </div>
              <div class="form-group">
               <label for="">Time</label>
                <input type="time" name="time" class="form-control" placeholder="Enter Time">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="addEvent">Save changes</button>
            </div>
            </form>
          </div>
      </div>
    </div> 

    <!-- Model to delete User-->
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Event</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="AddEventCode.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="delete_id" class="delete_user_id">
              <p>Are you sure, you want to delete this event entry?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="DeleteEvent">Yes! Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div> 

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
          <?php
          if (isset($_SESSION['status'])) {
            echo "<h4 style=color:green>" . $_SESSION['status'] . "</h4>";
            unset($_SESSION['status']);
          }
          ?>
          <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">DataTable with default features</h3>
                      <a href="#" data-toggle="modal" data-target="#AddUserModel" class="btn btn-primary btn-sm float-right">Add Event</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Id</th>
                          <th>Title</th>
                          <th>Image</th>
                          <th>Description</th>
                          <th>Venue</th>
                          <th>Date</th>
                           <th>Time</th>
                             <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = "SELECT * FROM event";
                          $sql_result = mysqli_query($conn, $sql);
                          if (mysqli_num_rows($sql_result) > 0) {
                            foreach ($sql_result as $row) {
                              $image_path = 'UploadedImage/' . $row['Image'];
                              ?>
                                                                                                                                      <tr>
                                                                                                                                        <td><?php echo $row['Id']; ?></td>
                                                                                                                                        <td><?php echo $row['Title']; ?></td>
                                                                                                                                         <td><img src="<?php echo $image_path; ?>" alt="Event Image" height="50px" width="50px">
                                        </td>
                                                                                                                                        <td><?php echo $row['Description']; ?></td>
                                                                                                                                         <td><?php echo $row['Venue']; ?></td>
                                                                                                                                          <td><?php echo $row['Date']; ?></td>
                                                                                                                                           <td><?php echo $row['Time']; ?></td>
                                                                                                                                        <td>
                                                                                                                                          <a href="event-edit.php?event_id=<?php echo $row['Id']; ?>"  class="btn btn-info btn-sm">Edit</a>
                                                                                                                                          <a href="event-delete.php?event_id=<?php echo $row['Id']; ?>"class="btn btn-danger btn-sm">Delete</a>
                                                                                                                                        </td>
                                                                                                                                      </tr>
                                                                                                                                    <?php
                            }
                          } else {
                            ?>
                                                                                <tr>
                                                                                  <td>No record Found</td>
                                                                                </tr>
                                                                                <?php
                          }

                          ?>
                        
                        </tbody>
                      </table>
                    </div>
          </div>
        </div>
      </div>
    </div>
    <section>
</div>
<?php
include ('includes/script.php');
?>
<?php
include ('includes/footer.php');
?>