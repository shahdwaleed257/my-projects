<?php include 'navpar.php'; ?>
        <div class="container mt-5">
            <form method="POST">
                <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">User Name</label>
                <input type="email" name="User_Name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp"  class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name = "Password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-info">Submit</button>
        </form>


    </div>



    <div>
        <script src="assest/bootstrap-5.3.7-dist/js/popper.js"></script>
        <script src="assest/bootstrap-5.3.7-dist/js/bootstrap.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    </div>
</body>
</html>


<?php
require_once "Connect.php";
    $connect = new Connect();

print_r($_POST);
if(isset($_POST['User_Name']) ){

    
    echo'Inside if condition';
    
    $row = $connect->FindUser($_POST["User_Name"], $_POST["Password"]);
    
    // Check if the array is not empty
    if(count($row)>0){
        echo "Yes";
    }
    else{
        echo "No";
    }

    setcookie("name","[User_Name]", time()+(86400*7),"/");


}
?>
<?php include 'footers.php'; ?>