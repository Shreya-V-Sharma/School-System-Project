<?php
    session_start();
    include_once 'database/db.php';
    $conn = OpenCon();
    include_once 'database/dbFunctions.php';

    $cid = $_GET['c_id'];

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Grades</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>

<body>
    <header><?php include 'includes/header.php'; ?></header>
    <main class='container pb-5'>
        <h3 class = "text-dark fw-bold m-3"> Grades </h3>
    </main>
    <footer class="bg-dark text-center text-lg-start fixed-bottom text-light"><?php include 'includes/footer.php'; ?></footer>
</body>
</html>