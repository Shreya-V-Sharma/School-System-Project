<nav class="navbar navbar-expand-lg navbar-light bg-dark">

  <a class="navbar-brand text-light fw-bold m-3 fs-2" href="#">School System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <?php if (isset($_SESSION['user'])){?>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-light" href="main.php">Home</a>
      </li>
      <li class="nav-item">
        <div class="dropdown">
        <button class="btn dropdown-toggle text-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Courses
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <?php
            $user = $_SESSION['user'];
            $statement = $conn->prepare("SELECT c_id, c_name FROM course WHERE i_id = ?");
            $statement->execute([$user]);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $rows = $statement->fetchAll();
        
            foreach($rows as $r){
                echo '<li><a class="dropdown-item" href="course.php?c_id='. $r['c_id'] .'">'.$r['c_name'].'</a></li>';
            }
        ?>
        </ul>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ms-auto">
        <?php
            $user = $_SESSION['user'];
            $statement = $conn->prepare("SELECT f_name, l_name FROM instructor WHERE i_id = ?");
            $statement->execute([$user]);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $rows = $statement->fetchAll();
        
            foreach($rows as $r){
                $fname = $r['f_name'];
                $lname = $r['l_name'];
            }
        ?>

        <li class="nav-item">
            <div class="dropdown">
            <button class="btn dropdown-toggle text-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
                <?php echo "  ".$fname." ".$lname ?>
            </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                    <li><a class="dropdown-item" href="includes/logout.php">Logout</a></li>
                </ul>
            </div>
        </li>
    </ul>
  </div>

  <?php } else {?>
    <ul class="navbar-nav ms-auto m-2">
        <li class="nav-item">
          <a href = "index.php" class = "text-decoration-none text-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
          </svg>
          Log In </a> 
        </li>
    </ul>
  <?php }?>
  
</nav>