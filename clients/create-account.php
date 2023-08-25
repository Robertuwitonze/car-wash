<?php
include('includes/config.php');
if (isset($_POST['create'])) {
  
    $fname = $_POST['fname'];
    $phone = $_POST['phone'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
  $vsql = "SELECT id from tblclients where phone='$phone'";
										$vquery = $dbh->prepare($vsql);
										$vquery->execute();
										$vresults = $vquery->fetchAll(PDO::FETCH_OBJ);
										$cnt = $vquery->rowCount();

      if($cnt == 0)
      {
        if(strtoupper($pass) == strtoupper($cpass))
        {
          
         $sql = "INSERT INTO tblclients(names,phone,username,password) VALUES(:fname,:phone,:uname,:pass)";
         $query = $dbh->prepare($sql);
         $query->bindParam(':fname', $fname, PDO::PARAM_STR);
         $query->bindParam(':phone', $phone, PDO::PARAM_STR);
         $query->bindParam(':uname', $uname, PDO::PARAM_STR);
         $query->bindParam(':pass', $pass, PDO::PARAM_STR);
         $query->execute();
         $lastInsertId = $dbh->lastInsertId();
         if ($lastInsertId) {
     
             echo '<script>alert("Account created successfully.")</script>';
             echo "<script>window.location.href ='index.php'</script>";
         } else {
             echo "<script>alert('Something went wrong. Please try again.');</script>";
         }
        }
        else
        {
         echo "<script>alert('Passwords Mismatches, Tray agai!!');</script>";
        }
      } 
      else
        {
         echo "<script>alert('Phone number Already used !!');</script>";
        }                                 
  
}
?>


<!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="../lib/flaticon/font/flaticon.css" rel="stylesheet">
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
	 <!-- Template Stylesheet -->
	 <link href="../css/style.css" rel="stylesheet">

<div class="" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Account</h4>
                </div>
                <div class="modal-body">
                    <form method="post">
                     
                        <p><input type="text" name="fname" class="form-control" required placeholder="Full Name"></p>
                        <p><input type="text" pattern="[0-9]{10}" name="phone" class="form-control" required placeholder="pone number ex: 078..."></p>
                        <p><input type="text" name="uname" class="form-control" required placeholder="Username" autocomplete="new-password"></p>
                        <p><input type="password" name="pass" class="form-control" required placeholder="password"  autocomplete="new-password"></p>
                        <p><input type="password" name="cpass" class="form-control" required placeholder="confirm password"  autocomplete="new-password"></p>
                        <p><input type="submit" class="btn btn-custom" name="create" value="Create Account"></p>
                    </form>
                </div>
                <div class="modal-footer">
                <a href="index.php">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Back To Login               
                    </button>
                    </a>
                </div>
            </div>

        </div>
    </div>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/counterup/counterup.min.js"></script>