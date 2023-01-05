<?php
    //connecting this page to database
    include_once 'database/db.php';
    $conn = OpenCon();
    include_once 'database/dbFunctions.php';
    
    //the user cliked log in button 
    if(isset($_POST["login"])){

        //get the email and password the user input
        $email = check_input($_POST['email']);
        $password = check_input($_POST['password']);

        $salt = 'xcnik38co2n2o99odscj928m';
        $hash = hash_hmac('md5', $password, $salt );

        //if they are empty set the errors for each input
        if(empty($email))
        {
            $email_error = "Please enter user name";
        }
        if(empty($password))
        {
            $password_error = "Please enter password";
        }

        //if everything looks good, no error
        if(!isset($email_error) && !isset($password_error))
        {
            //used https://phpdelusions.net/pdo_examples/count to see how to find the number of rows returned by select query 

            //find the username and password in the database using the select query that counts row returned
            $statement = $conn->prepare("SELECT COUNT(*) FROM instructor WHERE email=? and password=?");
            $statement->execute([$email,$hash]);

            //code to get number of rows
            $count = $statement->fetchColumn();

            //the number of rows is greater than 0, so there atleast one correct user registered, then start session
            //set session user with the email entered and redirect the user to profile page
            if($count>0)
            {
                session_start();
                $statement = $conn->prepare("SELECT i_id FROM instructor WHERE email=? and password=?");
                $statement->execute([$email,$hash]);
                $id = $statement->fetchColumn();
                $_SESSION['user'] = $id;
                header("Location: main.php");
            }
            //if the username and password don't exist then set the log in error
            else
            {
                $login_error = "Incorrect email or password";
            }

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <!--add bootstrap-->
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    </head>
    <body class = 'bg-light justify-content-center align-content-center'>
        <header> <?php include 'includes/header.php'; ?> </header>
        <main class = "bg-light justify-content-center align-content-center">
            
            <div class = "container mt-5">
                <!--change names for and type, remove some things-->
                <form method= 'post' class = "shadow rounded bg-light">
                    <h4 class = "m-3">Log in</h4>
                    <div class= "m-3">
                        <div class = "form-group">

                        <!-- if login error is set then echo it to tell the user that email or password was incorrect -->
                        <?php
                            if(isset($login_error))
                            {
                        ?>
                                <p class = "text-danger"><?php echo $login_error; ?></p>
                        <?php
                            }
                        ?>  
                            <label for="email">Email address: </label>
                            <input type="email" class="form-control mb-3" id="email" placeholder="Enter Email" name="email">

                            <!-- if the error is set then echo it to the user, same for other error -->
                            <?php
                                if(isset($email_error))
                                {
                            ?>
                                    <p class = "text-danger"><?php echo $email_error; ?></p>
                            <?php    
                                }
                            ?>                        
                        </div>
                        <div class = "form-group">
                            <label for="password">Password: </label>
                            <input type="password" class="form-control mb-3" id="password" placeholder="Enter Password" name="password">
                            <?php
                                if(isset($password_error))
                                {
                            ?>
                                    <p class = "text-danger"><?php echo $password_error; ?></p>
                            <?php
                                }
                            ?>                        
                        </div>

                        <button type="submit" class="btn btn-dark mb-3" name = "login">Log in</button>

                    </div>

                </form>  
            </div>
              
        </main>
    </body>
</html>