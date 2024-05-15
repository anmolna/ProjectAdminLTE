<?php
include ('config/dbcon.php');
session_start();
if (isset($_POST['addEvent'])) {

    $e_title = $_POST['title'];
    // $e_image=$_POST['image'];
    $e_venue = $_POST['venue'];
    // $e_video=$_POST['video'];
    $e_date = $_POST['date'];
    $e_time = $_POST['time'];
    $e_desc = $_POST['description'];
    echo "hello";
    // image information
    if (isset($_FILES['image'])) {
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $image_error = $_FILES['image']['error'];


        echo "it is working";

        if ($image_error === 0) {

            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_img_exs = array("jpg", "jpeg", "png");


            if (in_array($img_ex_lc, $allowed_img_exs)) {


                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'UploadedImage/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
                // Now let's Insert the video path into database
                $sql = "INSERT INTO event(Title, Image,  Description, Venue, Date, Time) 
                   VALUES('$e_title', '$new_img_name',  '$e_desc', '$e_venue', '$e_date', '$e_time')";
                $sql_result = mysqli_query($conn, $sql);
                if ($sql_result) {
                    $_SESSION['status'] = "Event Added Successfully";
                    header("Location: event.php");
                } else {
                    $_SESSION['status'] = "Event Not Added";
                    header("Location: event.php");
                }
            }
        }
    } else {
        echo "not working ji";
    }
}
if (isset($_POST['UpdateEvent'])) {
    $event_id = $_POST['event_id'];
    $title = $_POST['name'];
    $image = $_POST['email'];
    $description = $_POST['phone'];
    $venue = $_POST['venue'];
    $date = $_POST['date'];
    $time = $_POST['time'];


    $sql = "UPDATE event set title='$title',image='$image', description='$description',venue='$venue',date='$date',time='$time' WHERE id='$event_id'";

    $sql_result = mysqli_query($conn, $sql);
    if ($sql_result) {
        $_SESSION['status'] = "Event Updated Successfully";
        header("Location: event.php");
    } else {
        $_SESSION['status'] = "Event Updation Failed";
        header("Location: event.php");
    }

}
if (isset($_POST['DeleteEvent'])) {
    $event_id = $_POST['event_id'];

    $sql = "DELETE FROM event WHERE id='$event_id'";
    $sql2 = "UPDATE event
    SET id = id - 1
    WHERE id > $event_id";

    $sql_result = mysqli_query($conn, $sql);
    $sql_result2 = mysqli_query($conn, $sql2);

    if ($sql_result && $sql_result2) {
        $_SESSION['status'] = "Event Deleted Successfully";
        header("Location: event.php");
    } else {
        $_SESSION['status'] = "Event Deleation Failed";
        header("Location: event.php");
    }

}
?>