<?php
$con = mysqli_connect('localhost', 'root', '', 'students');
if(isset($_POST['save_student']))
{
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $phone = mysqli_real_escape_string($con, $_POST['phone']);
  $course = mysqli_real_escape_string($con, $_POST['course']);

  if ($name == NULL || $email == NULL || $phone == NULL || $course == NULL) 
  {
    $res = [
        'status' => 422,
        'message' => 'all fields are required'

    ];
    echo json_encode($res);
    return false;
  }
  $query = "INSERT INTO data (name, email, phone, course) VALUES('$name', '$email', '$phone', '$course')";
  $query_run = mysqli_query($con, $query);
  if ($query_run) {
    $res = [
        'status' => 200,
        'message' => 'Student inserted successfully'

    ];
    echo json_encode($res);
    return false;
  }
 else {
    $res = [
        'status' => 500,
        'message' => 'Student not inserted'

    ];
    echo json_encode($res);
    return false;
 }


}

?>