<?php
    //the user cliked log in button 
    if(isset($_POST["updateEmail"]))
    {

    }

?>
<div class = "container mt-5">
    <!--change names for and type, remove some things-->
    <form method= 'post' class = "shadow rounded bg-light">
        <h4 class = "m-3">Update Email</h4>
        <div class= "m-3">
            <div class = "form-group">
                <label for="email">New Email address: </label>
                <input type="email" class="form-control mb-3" id="email" placeholder="Enter Email" name="email" required>

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

            <button type="submit" class="btn btn-dark mb-3" name = "updateEmail">Update</button>

        </div>

    </form>  
</div>