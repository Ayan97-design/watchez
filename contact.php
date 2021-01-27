<?php
 require('config/config.php');

$errors = array();

if(isset($_POST['submit'])){
    $NAME = mysqli_real_escape_string($conn,$_POST['name']);
    $SUBJECT = mysqli_real_escape_string($conn,$_POST['subject']);
    $EMAIL = mysqli_real_escape_string($conn,$_POST['email']);
    $PHONE = mysqli_real_escape_string($conn,$_POST['phone']);
    $MESSAGE = mysqli_real_escape_string($conn,$_POST['message']);
   // contact 
    if(count($errors)==0){
        $query= "INSERT INTO contact(Name,subject,email,phone,message) VALUES ('$NAME','$SUBJECT','$EMAIL','$PHONE','$MESSAGE')";
        mysqli_query($conn, $query);
        echo '<script>alert("thank you for contacting")</script>';
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
    <title>Contact Us |TimelineZ </title>
  </head>
  <body>
  <?php
     include_once 'includes/nav.php';
    ?>

    <!-- Section A: Contact Form -->
    <section id="contact-a" class="text-center py-3">
      <div class="container">
        <h2 class="section-title">Contact us</h2>
        <div class="bottom-line"></div>
        <p class="lead">Here is how you can reach us</p>
        <form method="post" action="contact.php">
          <div class="text-fields">
            <input
              type="text"
              class="text-input name-input"
              placeholder="Name"
              name="name"
            />
            <input
              type="text"
              class="text-input subject-input"
              placeholder="Subject"
              name="subject"
            />
            <input
              type="email"
              class="text-input email-input"
              placeholder="Email Address"
              name="email"
            />
            <input
              type="text"
              class="text-input phone-input"
              placeholder="Phone Number"
              name="phone"
            />
            <textarea
              class="text-input message-input"
              placeholder="Enter Message"
              name="message"
            ></textarea>
           
          </div>
          <button type="submit" class="btn-dark" name="submit">Submit</button>
        </form>
      </div>
    </section>

    <!-- Section B: Contact Info -->
    <section id="contact-b" class="py-3 bg-dark">
      <div class="container">
        <div class="contact-info">
          <div>
            <i class="fas fa-envelope fa-2x"></i>
            <h3>Email</h3>
            <p>TimelineZ@gmail.com</p>
          </div>
          <div>
            <i class="fas fa-phone fa-2x"></i>
            <h3>Phone</h3>
            <p>(999) 555-5555</p>
          </div>
          <div>
            <i class="fas fa-address-card fa-2x"></i>
            <h3>Address</h3>
            <p>Death Valley, Delhi</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Section C: Tagline -->
    <section id="contact-c" class="bg-main py-4">
      <div class="container">
        <h1>Get Your favourite Watch Now</h1>
      </div>
    </section>

 <!-- Footer -->
 <?php
     include_once 'includes/footer.php';
?>
  </body>
</html>
