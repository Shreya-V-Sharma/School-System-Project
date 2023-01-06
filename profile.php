<?php
    session_start();
    include_once 'database/db.php';
    $conn = OpenCon();
    include_once 'database/dbFunctions.php';
    $user = $_SESSION['user'];
    $statement = $conn->prepare("SELECT f_name, l_name, email FROM instructor WHERE i_id = ?");
    $statement->execute([$user]);
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $statement->fetchAll();

    foreach($rows as $r){
        $fname = $r['f_name'];
        $lname = $r['l_name'];
        $email = $r['email'];
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
    <header><?php include 'includes/header.php'; ?></header>
    <main class='pb-5 mt-5 d-flex justify-content-center align-content-centre'>
        <div class = "container">
            <table class="table table-striped table-sm w-50 pb-5 mx-auto">
                <tbody>
                    <tr>
                        <th scope="row">Name</th>
                        <td> <?php echo $fname .' '. $lname ; ?> </td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td> <?php echo $email ; ?> </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <a href='updateEmail.php' class = "mt-2">
                    <button type='button'>Update Email</button>
                </a>
            </div>
            <div class="d-flex justify-content-center">
                <a href='changePassword.php' class = "mt-2">
                    <button type='button'>Change Password</button>
                </a>
            </div>
        </div>
    </main>
    <footer class="bg-dark text-center text-lg-start fixed-bottom text-light"><?php include 'includes/footer.php'; ?></footer>
</body>
</html>
