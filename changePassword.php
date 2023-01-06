<?php
    session_start();
    $user = $_SESSION['user'];
    include_once 'database/db.php';
    $conn = OpenCon();
    include_once 'database/dbFunctions.php';

    if(isset($_POST['changePassword']))
    {
        $oldPass = check_input($_POST['oldPassword']);
        $newPass = check_input($_POST['newPassword']);
        $cPass = check_input($_POST['cNewPassword']);

        if(!(preg_match('/[A-Z]+/', $newPass) && preg_match('/[a-z]+/', $newPass) && preg_match('/[0-9]+/', $newPass) && preg_match('/[\!\@\#\$\%\^\&\*\-]+/', $newPass) && strlen($newPass) >= 12))
        {
            $changePass_error = "Password needs to have at least one number, one uppercase letter, one lowercase letter, and one special
            character and be at least 12 characters long";
        }

        else if($newPass != $cPass){

            $changePass_error = "Confirm password doesn't match the new password";
        }
        else
        {
            $salt = 'xcnik38co2n2o99odscj928m';
            $hashOld = hash_hmac('md5', $oldPass, $salt );

            $statement = $conn->prepare("SELECT password FROM instructor WHERE i_id=?");
            $statement->execute([$user]);
            $pass = $statement->fetchColumn();

            if($pass==$hashOld)
            {
                $hashNew = hash_hmac('md5', $newPass, $salt);
                $statement = $conn->prepare("UPDATE instructor SET password = ? WHERE i_id=?");
                $statement->execute([$hashNew, $user]);

                header('Location: profile.php');
            }
            else
            {
                $changePass_error = "Incorrect password(old)";
            }
        }
    }

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>

<body>
    <header> <?php include 'includes/header.php'; ?> </header>
    <main class='container pb-5 mt-5 d-flex justify-content-center align-content-centre'>
        <div class = "container mt-5">
            <!--change names for and type, remove some things-->
            <form method= 'post' class = "shadow rounded bg-light">
                <h4 class = "m-3">Change Password</h4>
                <div class= "m-3">
                    <div class = "form-group">
                        <?php
                            if(isset($changePass_error))
                            {
                        ?>
                                <p class = "text-danger"> <?php echo $changePass_error; ?> </p>
                        <?php
                            }
                        ?>
                        <label for="email">Old Password: </label>
                        <input type="password" class="form-control mb-3" id="password" placeholder="Enter Password" name="oldPassword" required>                  
                    </div>
                    <div class = "form-group">
                        <label for="password">New Password: </label>
                        <input type="password" class="form-control mb-3" id="password" placeholder="Enter Password" name="newPassword" required>                
                    </div>
                    <div class = "form-group">
                        <label for="password">Confirm New Password: </label>
                        <input type="password" class="form-control mb-3" id="password" placeholder="Enter Password" name="cNewPassword" required>                 
                    </div>

                    <button type="submit" class="btn btn-dark mb-3" name = "changePassword">Change Password</button>

                </div>

            </form>  
        </div>
    </main>
    <footer class="bg-dark text-center text-lg-start fixed-bottom text-light"> <?php include 'includes/footer.php'; ?> </footer>
</body>
</html>