<?php
session_start();
error_reporting();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	// strtoupper() 
	// substr('abcdef', 0, 4); 
	// Code for Booking
if(isset($_POST['complete']))
{
	$transactionId = $_POST['codes'];
	$tId = $_GET['trans'];
	$bookingid = $_GET['bookingid'];

	$validator = 3;
	$validatingCode = substr($tId, 13, 5); 

	for($validator = 3; $validator >0; $validator --)
	  {
			if(strtoupper($transactionId) == strtoupper($validatingCode))
			{
				
					$sql = "UPDATE  tblcarwashbooking set paymentStatus='payed' where bookingId=:bookingid";
					$query = $dbh->prepare($sql);
					$query->bindParam(':bookingid', $bookingid, PDO::PARAM_STR);
					$query->execute();

					$lastInsertId = $dbh->lastInsertId();
					if($query->execute())
					{
					
					echo '<script>alert("Your booking done successfully. Booking number is "+"'.$bookingid.'")</script>';
					echo "<script>window.location.href ='all-bookings.php'</script>";
					break;
					}
					else 
					{
					echo "<script>alert('Something went wrong. Please try again.');</script>";
						//sleep(10);
				     echo "<script>window.location='complete-booking.php?trans=$tId&bookingid=$bookingid';</script>";

					}

			}
			else
			{
				$vald = $validator - 1;
				echo "<script>alert('Invalid Code you have $vald  times left!!');</script>";
				// echo('validatingCode'.$validatingCode. '    '.'enteredcode' .$transactionId);
				// echo();
				//sleep(10);
				echo "<script>window.location='complete-booking.php?trans=$tId&bookingid=$bookingid';</script>";
				
			}
			
	  }


}

	?>
<!DOCTYPE HTML>
<html>
<head>
<title>CWMS | Complete Booking</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>

</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
              <!--header start here-->
<?php include('includes/header.php');?>
							
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
	<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Complete Booking </li>
            </ol>

            <div class="" id="myPayModal" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Enter First 5 charcters of External Transaction id provided in your payment confirmation message </h4>
									<h3 class="modal-title">You have only 3 times for wrong code </h3>
								</div>
								<div class="modal-body">
									<form method="post">
										
										<p><input type="text"  class="form-control" name="codes" placeholder="..." required></p>
										<p><input type="submit" class="btn btn-custom" name="complete" value="Send "></p>
									<!-- </form> -->
								</div>
								<div class="modal-footer">
									<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
								</div>
							</div>


						</div>
					</div>
    </form>
  </div>
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
<?php include('includes/footer.php');?>
<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
					<?php include('includes/sidebarmenu.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   

</body>
</html>
<?php } ?>


<!-- pay model  -->


