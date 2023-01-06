<?php
    session_start();
    $user = $_SESSION['user'];
    include_once 'database/db.php';
    $conn = OpenCon();
    include_once 'database/dbFunctions.php';

    if(isset($_POST['updateEmail']))
    {
        $newEmail = check_input($_POST['newEmail']);

        if(!(preg_match('/^[A-Za-z0-9\.\-\_]+@[A-Za-z\.]+\.[A-Za-z]{2,5}$/', $newEmail)))
        {
            $update_email_error = "Not a valid email.";
        }
        else
        {
            $statement = $conn->prepare("UPDATE instructor SET email = ? WHERE i_id=?");
            $statement->execute([$newEmail, $user]);

            header('Location: profile.php');
        }
    }

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>

<body>
    <header> <?php include 'includes/header.php'; ?> </header>
    <main class='container pb-5 mt-5 d-flex justify-content-center align-content-centre'>
    <div class = "container mt-5">
        <form method= 'post' class = "shadow rounded bg-light">
            <h4 class = "m-3">Update Email</h4>
            <div class= "m-3">
                <div class = "form-group">
                    <?php
                        if(isset($update_email_error))
                        {
                    ?>
                            <p class = "text-danger"><?php echo $update_email_error; ?></p>
                    <?php    
                        }
                    ?> 
                    <label for="email">New Email address: </label>
                    <input type="email" class="form-control mb-3" id="email" placeholder="Enter Email" name="newEmail" required>
                </div>

                <button type="submit" class="btn btn-dark mb-3" name = "updateEmail">Update</button>
            </div>
        </form>  
    </div>
    </main>
    <footer class="bg-dark text-center text-lg-start fixed-bottom text-light"> <?php include 'includes/footer.php'; ?> </footer>
</body>
</html>
