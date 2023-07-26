<?php


    session_start();
    require("database.php");




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST["username"];
    $password = $_POST["pass"];
    $confirm_password = $_POST["confirm_password"];

 
    if ($password != $confirm_password) {
        echo "Passwords do not match. Please try again.";
        exit;
    }

    
    

    
    $query = $db->prepare('SELECT * FROM users WHERE username = :username');
    $query->execute([':username' => $username]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "This username has been taken. Please try another username.";
        exit;
    }

    
    $query = $db->prepare('INSERT INTO users (username, pass) VALUES (:username, :pass)');
    $result = $query->execute([
        ':username' => $username,
        ':pass' => $password
    ]);

    if ($result) {
        echo "The user has been successfully registered.";

    } else {
        echo "Something went wrong.";
    }
}
?>





<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Singup</title>
    <link rel="shortcut icon" href="assets/img/icon/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
  <div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignin">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header p-5 pb-4 border-bottom-0">
        <h1 class="fw-bold mb-0 fs-2">Singup</h1>
        <a href="index.php"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>

      </div>

      <div class="modal-body p-5 pt-0">
        <form class="" method="post"> 
          <div class="form-floating mb-3">
            <input name="username" type="text" class="form-control rounded-3" id="floatingInput" required>
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input name="pass" type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
          </div><div class="form-floating mb-3">
            <input name="confirm_password" type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password" required>
            <label for="floatingPassword">Repead Password</label>
          </div>
          <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Sing Up</button>   
         
       
        </form>
      </div>
    </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>