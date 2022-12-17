<?php
    include "config.php";                                   ///embed PHP code from another file            
    include "load.php";                                   ///embed PHP code from another file            

    session_start();            //starting session
    //only new user can be registered by admin while admin is loged in
    if(!isset($_SESSION['email'])){
        $_SESSION['error']='Admin Login Requred to Register New User';
        $_SESSION['redirect']='register';
        header("location: login.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){                      //check for the post request which occure after user submit form
        $first_name = trim($_POST["firstName"]);                    //get first name
        $last_name = trim($_POST["lastName"]);                      //get last name
        $email = trim($_POST["email"]);                             //get email
        $password = trim($_POST['password']);                       //get password
        $confirm_password = trim($_POST['confirm_password']);       //get conform password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);//hashing the entered password with PASSWORD_BCRYPT hashing method.... we can also use PASSWORD_DEFAULT which Use the bcrypt algorithm (default as of PHP 5.5.0);
        if(!empty(trim($_POST["email"])) && !empty(trim($_POST["password"])) && !empty(trim($_POST["confirm_password"]))){      //checking if any of the field is empty
            //lets check email is valid or not
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                //lets check if the entered email is already exist in batabase or not
                if(!$adminObj->checkEmail($email)){  //when email is not matched
                    // check if password && conform password is same
                    if($password == $confirm_password){
                        //create user in database with hashed password
                        if($adminObj->createUser($first_name,$last_name,$email,$hashed_password)){//if data is inserted
                            // redired to login.php if every things goes good
                            header("location: login.php");
                        }else{
                            // $error = "Something went Wronh!! Contact Admin";
                            $_SESSION['error']='Something went Wronh!! Contact Admin';
                          }
                          
                        }else{
                          // $error = "Password & Conform Password does not matched";
                          $_SESSION['error']='Password & Conform Password does not matched';
                        }
                      }else{
                        // $error = "Email is already registred";
                        $_SESSION['error']='Email is already registred';
                      }
                    }else{
                      // $error = "Email is not valid";
                      $_SESSION['error']='Email is not valid';
                    }
                  }else{
                    // $error = "All input fields are required";
                    $_SESSION['error']='All input fields are required';
        }
    }
///REQUEST_METHOD Which request method was used to access the page; e.g. 'GET', 'HEAD', 'POST', 'PUT'.
///trim() => remove whitespaces & other chars from beginning & the end
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link rel="stylesheet" href="assets/css/admin/register.css">
    <script src="https://kit.fontawesome.com/e5f4960269.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="form_wrapper">
      <section id="signup_form">
        <header>Register Form</header>
        <form action="<?php $_PHP_SELF ?>" method="post">
          <div class="name-details">
              <div class="field first_name">
                  <label for="firstName">First Name</label>
                  <input type="text" id="firstName" name="firstName" placeholder="First Name">
              </div>
              <div class="field last_name">
                  <label for="lastName">Last Name</label>
                  <input type="text" id="lastName" name="lastName" placeholder="Last Name">
              </div>
          </div>
          <div class="field email">
            <label for="email">Email Address</label>
            <input type="text" id="email" name="email" placeholder="Enter your email Address">
          </div>
          <div class="field password">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter new Password">
            <i class="fas fa-eye"></i>
          </div> 
          <div class="field confirm_password">
            <label for="confirm_password">Conform Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Conform Password">
            <i class="fas fa-eye"></i>
          </div>
          <div class="field button_submit">
            <input type="submit" value="Register">
          </div>
        </form>
        <div class="link">Already signed up? <a href="login.php">Login now!!!</a></div>
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

