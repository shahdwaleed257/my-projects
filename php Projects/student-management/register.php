<?php require_once "Connect.php";
session_start()?>
<?php include 'navpar.php'; ?>

    
    <div class="container mt-5">
        
        <h1>Welcom To Register</h1>

        <?php
            if(isset($_SESSION["User_Name"]) ) 
                {?>
                <div class="alert alert-danger" role="alert">
                
        you are registered already  
        </div>
<form method="get" action="register.php">
    <button type="submit" name="logout" value="1" class="btn btn-danger">Logout</button>
</form>    <?php
    if (isset($_GET["logout"]) && $_GET["logout"] == true)
    {
            session_unset();
            session_destroy();
            header("location:register.php");
    }
                }
                else{
                    
                
        ?>
        <?php
        ?>
        <form method="post">
        <div class="form-group">
            <label for="exampleInputEmail1" class="form-label">User Name</label>
            <input type="text" class="form-control" name="User_Name">
            <!-- <small class="form-text text-muted">Type your Name</small> -->
        </div>
          <div class="form-group">
            <label for="exampleInputEmail1" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <br>
        </form>
        <?php
                }
                ?>
    </div>
    <div>
        <?php
        $smt = false;
            if(isset($_POST["User_Name"])){
                $connect = new Connect;
                $smt =$connect->insert($_POST,"users");

            }
            if($smt)
            { 
                $_SESSION["User_Name"] = $_POST["User_Name"];
                ?>
            <div class="alert alert-success" role="alert">
                
            User Is Added!
            </div>
            <?php
             header("location:home3.php?add=1");
            }
            else
            { ?>
            <!-- <div class="alert alert-danger" role="alert">
                
        Unable to add user
        </div> -->
            <?php
            // header("location:register.php?add=0");
            }

        ?>
    </div>



        <?php include 'footers.php'; ?>