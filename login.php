<?php
require_once "config.php"; 
require_once "includes/header.php";

if (isset($_SESSION["username"])) {
  header("location: index.php");
}

if (isset($_POST["submit"])) {
  
  if ($_POST["email"]=='' OR $_POST["password"]=='') {
    echo "Some inputs are empty";
  } else {
    $email = $_POST["email"];
    $passwd = $_POST["password"];

    $login = $conn->query("SELECT * FROM users WHERE email='$email'");
    $login->execute();
    $data = $login->fetch(PDO::FETCH_ASSOC);

    if ($login->rowCount()>0) {
      if (password_verify($passwd,$data["passwd"])) {
        $_SESSION["user_id"] = $data["users_id"];
        $_SESSION["username"] = $data["username"];
        $_SESSION["email"] = $data["email"];
        header("location: index.php");
      }else{
        echo "Email or Password is wrong.";
      }
    }else{
      echo "Email or Password is wrong.";
    }

  }
  
}


?>

<main class="form-signin w-50 m-auto">
  <form method="post" action="login.php">
    <!-- <img class="mb-4 text-center" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
    <h1 class="h3 mt-5 fw-normal text-center">Please log in</h1>

    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
<!--     <div class="form-floating">
      <input name="username"  type="text" class="form-control" id="floatingInput" placeholder="user.name">
      <label for="floatingInput">Username</label>
    </div> -->
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <h6 class="mt-3">Don't have an account  <a href="register.php">Create your account</a></h6>
  </form>
</main>
<?php require "includes/footer.php"; ?>
