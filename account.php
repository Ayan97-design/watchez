<?php
    session_start();
?>
<?php
 require('config/config.php');
 
 if(isset($_POST['submit'])){
    $EMAIL = $_POST['email'];
    $PASSWORD =$_POST['password'];

    $check_query ="SELECT * FROM users WHERE email = '$EMAIL' && password = '$PASSWORD'"
              or die("failed to query database".mysqli_error());
    $results = mysqli_query($conn,$check_query);
    $row = mysqli_fetch_assoc($results);
    $_SESSION['username'] = $row['email'];
    if ($row["email"] === $EMAIL && $row["password"] === $PASSWORD){
        header('location:cart.php') ;
    }else{
        echo '<script>alert("INCORRECT EMAIL OR PASSWORD")</script>'; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
      integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
      crossorigin="anonymous"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Dosis"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/main.css" />
    <title>TimelineZ | Account </title>
  </head>
  <body>
         <!-- Header -->
  <header id="header-inner">
      <div class="container">
        <nav id="main-nav">
          <img src="img/logo.png" alt="My Portfolio" id="logo" />
          <ul>
            <li><a href="index.php" class="current">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="Products.php">Products</a></li>
            <li><a href="contact.php" >Contact</a></li>
            <li><a href="account.php">Account</a>  <i class="fa fa-user" aria-hidden="true"></i></li>
            <li><a href="account.php">Cart</a>    <i class="fa fa-shopping-cart" aria-hidden="true"></i></li>
          </ul>
        </nav>
      </div>
    </header>

    <div id="login-body">
    <div class="login-container">
        <form id="form-1"method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h2 id="form-h1">LOGIN </H2>

            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Enter your email" name="email" required>
            </div>

            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Password" name="password" required>
            </div>


             <button class="btn" type="submit"  name="submit">Log In</button>

           
        </form>

        <div class="sign-body">
        <form method="post" action="config/signup.php" id="form" onSubmit = "return checkPassword(this)">
        <h2 id="form-h1">SIGN UP</H2>
        <div class="form-control">
                <label for="Name">Name</label>
                <input type="text" id="name" placeholder="Enter your name" name="name" required>
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Enter your email" name="email" required>
            </div>

            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" id="password1" placeholder="Password" name="password" required>
            </div>
            <div class="form-control">
                <label for="password2">Password</label>
                <input type="password" id="password2" placeholder="Enter Password again"  name="password2"required>
            </div>
            <div class="form-control">
                <label for="Address">Address</label>
                <input type="text" id="Address" placeholder="Enter your Address"  name="address" required >
            </div>
            <button class="btn"  type="submit"  name="submit">Sign up</button>
    
    </form>
    </div>
</div>
</div>

     <!-- Footer -->
 <?php
     include_once 'includes/footer.php';
?>

<script src="js/script.js"></script>
  </body>
</html>