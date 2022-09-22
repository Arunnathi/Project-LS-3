<?php session_start();

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "trust_media";

$connect = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

/*
// Check connection
if ($mysqli -> connect_error) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}*/
if (isset($_POST["signup"])) {
  $name = $_POST["name"];
  $mobile = $_POST["mobile"];
  $email = $_POST["email"];
  $pwd = $_POST["pwd"];


  $check_query = mysqli_query($connect, "SELECT * FROM signup where email='$email'");
  $rowcount = mysqli_num_rows($check_query);

  if (!empty($email) && !empty($pwd)) {
    if ($rowcount > 0) {
?>
      <script>
        alert("User with email already exists")
      </script>
    <?php
    } else {

      $pwd_enc = password_hash($pwd, PASSWORD_BCRYPT);
      $result = mysqli_query($connect, "INSERT INTO signup values('$name','$mobile','$email','$pwd_enc'); ");
    ?>
      <script>
        alert("inserted successfully")
      </script>
<?php
    }
  }
}
?>