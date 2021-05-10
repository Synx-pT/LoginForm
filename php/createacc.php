<?php include_once './inc/db.inc.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--Bootstrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">  

  <title>create</title>
</head>
<body>

<div class="container-fluid d-flex justify-content-center mt-3">

<form method="post" action="createacc.php">
  <div class="form-group">
    <label for="exampleInputUsername1">Username</label>
    <input type="text" name="Username" class="form-control" id="exampleInputUsername1" aria-describedby="UsernameHelp">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password1" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword2">Confirm your Password</label>
    <input type="password" name="password2" class="form-control" id="exampleInputPassword2">
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Register</button>
</form>

</div>

<?php
if(isset($_POST['Username']) && isset($_POST['password1']) && isset($_POST['password2'])){
  $username = $_POST['Username'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];
}

if(isset($_POST['submit'])){
  if($password1 === $password2){
    //check username
    $stmt = $con->prepare('SELECT * FROM logins_db WHERE username = :user');
    $stmt->bindParam(":user", $username);
    $stmt->execute();
    $count = $stmt->rowCount();

    if($username == NULL or $password1 == NULL or $password2 == NULL){
      echo 'something went wrong';
    }
    else if($count == 0){
      //user anlegen
      $stmt = $con->prepare("INSERT INTO logins_db (username, password) VALUES (:user, :pw)");
      $stmt->bindParam(":user", $username);
      $hash = password_hash($password1, PASSWORD_BCRYPT);
      $stmt->bindParam(":pw", $hash);
      $stmt->execute();
      session_start();
      $_SESSION["username"] = $username;
      header("Location: ./main.php");
    } else {
      echo "username vergeben";
    }
  
  } else {
    echo 'your passwords aren\'t equal!';
  }  
}
?>

<a class="d-flex justify-content-center mt-5" href="./index.php">already have a account?</a>
  
</body>
</html>