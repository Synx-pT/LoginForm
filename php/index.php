<?php include_once './inc/db.inc.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--Bootstrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">  

  <title>register</title>
</head>
<body>

<div class="container-fluid d-flex justify-content-center mt-3">

<form method="post" action="index.php">
  <div class="form-group">
    <label for="exampleInputUsername1">Username</label>
    <input type="text" name="Username" class="form-control" id="exampleInputUsername1" aria-describedby="UsernameHelp">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Login</button>
</form>

<?php

if(isset($_POST['Username']) && isset($_POST['password'])){
  $username = $_POST['Username'];
  $password = $_POST['password'];
}

if(isset($_POST['submit'])){
  //check username
  $stmt = $con->prepare('SELECT * FROM logins_db WHERE username = :user');
  $stmt->bindParam(":user", $username);
  $stmt->execute();
  $count = $stmt->rowCount();
  if($count == 1){
    //Username ist frei
    $row = $stmt->fetch();
    if(password_verify($password, $row['password'])){
      session_start();
      $_SESSION["username"] = $username;
      header("Location: ./login.php");
    } else {
      echo "Der Login ist fehlgeschlagen";
    }
  } else {
    echo "username vergeben";
  }
}

?>

</div>

<a class="d-flex justify-content-center mt-5" href="./createacc.php">create a account</a>
  
</body>
</html>

