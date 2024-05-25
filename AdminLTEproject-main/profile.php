<?php
session_start();
include ('includes/header.php');
include ('includes/topbar.php');
include ('includes/sidebar.php');
include ('config/dbcon.php');

// Check if the email session variable is set
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Debugging statement


    // Fetch the user details from the database
    $sql = "SELECT * FROM admindetail WHERE email='$email' LIMIT 1";
    $query_result = mysqli_query($conn, $sql);

    if (!$query_result) {
        die("SQL query failed: " . mysqli_error($conn));
    }

    // Check if a record was found
    if (mysqli_num_rows($query_result) > 0) {
        $row = mysqli_fetch_assoc($query_result);
    } else {
        $row = null;
    }
} else {
    // Redirect to login page if session email is not set
    header('Location: login.php');
    exit();
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Profile</li>
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
                            <h3 class="card-title">Edit User/Admin Detail</h3>
                            <a href="registered.php" class="btn btn-primary btn-sm float-right">Back</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                    if ($row) {
                                        ?>
                                                    <form action="AddAdminCode.php" method="POST">
                                                        <input type="hidden" name="user_id" value="<?php echo $row['id'] ?>">
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" name="name" class="form-control" 
                                                            value="<?php echo $row['name'] ?>" 
                                                            placeholder="Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email Id</label>
                                                            <input type="email" class="form-control" 
                                                            name="email"
                                                            value="<?php echo $row['email'] ?>"
                                                            placeholder="Email" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone">Phone Number</label>
                                                            <input 
                                                            type="text" name="phone" class="form-control" 
                                                            value="<?php echo $row['phone'] ?>"
                                                            placeholder="Phone Number">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="password">Password</label>
                                                            <input
                                                            type="password" name="password" class="form-control"
                                                            value="<?php echo $row['password'] ?>" 
                                                            placeholder="Password">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="role">Role</label>
                                                            <br>
                                                            <input type="radio" id="admin" name="role" value="admin" <?php if ($row['Role'] == 'admin')
                                                                echo 'checked'; ?>>
                                                            <label for="admin">admin</label>
                                                            <input type="radio" id="user" name="role" value="user" <?php if ($row['Role'] == 'user')
                                                                echo 'checked'; ?>>
                                                            <label for="user">user</label>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-info" name="UpdateAdmin">Update changes</button>
                                                        </div>
                                                    </form>
                                                    <?php
                                    } else {
                                        echo "<h4>No record Found.</h4>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include ('includes/script.php');
include ('includes/footer.php');
?>
