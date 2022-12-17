<?php
    session_start();            //starting session
    // check if the user is already logged in
    if(isset($_SESSION['email'])){
        header("location: logout.php");
        exit;
    }

    require_once "config.php";


    if ($_SERVER['REQUEST_METHOD'] == "POST"){          //check for the post request which occure after user submit form
        $email = trim($_POST['email']);                 //get email
        $password = trim($_POST['password']);          //get password
        if(!empty($email) || !empty($password)){        //check if any of the email or password field are empty
            //cleck entered email & password match to database
            $sql = "SELECT * FROM users WHERE email='{$email}'";
            $query = mysqli_query($conn,$sql);
            if(mysqli_num_rows($query)>0){              //check if user credentials matched
                $row = mysqli_fetch_assoc($query);
                if(password_verify($password,$row['password'])){    //check if the entered password & password in database is same
                    //assigingig session variables
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['loggedin'] = true;

                    if(isset($_SESSION['redirect'])){
                      $_SESSION['error']='Now You Can Register New User';
                      $redirectPage = $_SESSION['redirect'];
                      unset($_SESSION['redirect']);
                      header("location: {$redirectPage}.php");
                    }else{
                      //Redirect user to welcome page
                      header("location: admin.php");
                    }
                }else{
                    // $error = "Password is not valid";
                    $_SESSION['error']='Password is not valid';
                }
            }else{
                // $error = "User is not registred. <a href=\"register.php\">SignUp</a>";
                $_SESSION['error']='User is not registred. <a href=\"register.php\">SignUp</a>';
            }
        }else{
            // $error = "All input fields are required";
            $_SESSION['error']='All input fields are required';
        }
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>LogIn</title>
    <link rel="stylesheet" href="assets/css/admin/register.css">
    <script src="https://kit.fontawesome.com/e5f4960269.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="form_wrapper">
      <section id="signup_form">
        <header>LogIn Form</header>
        <form action="<?php $_PHP_SELF?>" method="post">
          <div class="field email">
            <label for="email">Email Address</label>
            <input type="text" id="email" name="email" placeholder="Enter email Address">
          </div>
          <div class="field password">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" placeholder="Enter Password">
              <i class="fas fa-eye"></i>
          </div> 
          <div class="field button_submit">
            <input type="submit" value="Log In">
          </div>
        </form>
        <div class="link">Not a Admin!!!  <a href="home.php">Click to Redirect to Homepage !!!</a></div>
        <?php 
            if(isset($_SESSION["error"])){ 
              $errorData = $_SESSION['error'];
              unset($_SESSION['error']);
              echo "<div class='error-txt'> $errorData </div>";
            }
        ?>
      </section>
    </div>
    <script src="assets/js/eye_show_hide.js"></script>
  </body>
</html>
