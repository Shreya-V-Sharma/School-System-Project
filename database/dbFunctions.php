<?php
    include_once "database.php";
    function allCourses($instructor){
        $conn = OpenCon();
        $statement = $conn->prepare("SELECT c_id, c_name, stu_enrolled FROM course WHERE i_id = ?");
        $statement->execute([$instructor]);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $statement->fetchAll();
    
        $numcourse=0;
        foreach($rows as $r){
            $numcourse+=1;
            if($numcourse%3==1)
            {
              $startRow = '<div class="row mt-4">';
            }
            else{
              $startRow = '';
            }
            if($numcourse%3==0)
            {
              $endRow = '</div>';
            }
            else{
              $endRow = '';
            }
            $statement = $conn->prepare("SELECT COUNT(*) FROM course JOIN assignment USING (c_id) WHERE c_id = ?");
            $statement->execute([$r['c_id']]);
            $count = $statement->fetchColumn();
            echo $startRow . '
            <div class="col-4">
              <div class="card m-4 bg-secondary" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title "><a href="course.php?c_id='.$r['c_id'].'" class="stretched-link text-decoration-none text-white">'.$r['c_name'].'</a></h5>
                  <p class="card-text text-white"><br>Number of students enrolled: '.$r['stu_enrolled'].'<br>Number of assignment: '.$count.'</p>
                </div>
              </div>
            </div>' . $endRow;
        }
        $conn = null;
    }
?>