<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {






?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<title>Completed Bookings</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="application/x-javascript">
			addEventListener("load", function() {
				setTimeout(hideURLbar, 0);
			}, false);

			function hideURLbar() {
				window.scrollTo(0, 1);
			}
		</script>
		<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="css/morris.css" type="text/css" />
		<link href="css/font-awesome.css" rel="stylesheet">
		<script src="js/jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/table-style.css" />
		<link rel="stylesheet" type="text/css" href="css/basictable.css" />

		<!-- DataTables -->
		<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
		<link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


		<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#table').basictable();

				$('#table-breakpoint').basictable({
					breakpoint: 768
				});

				$('#table-swap-axis').basictable({
					swapAxis: true
				});

				$('#table-force-off').basictable({
					forceResponsive: false
				});

				$('#table-no-resize').basictable({
					noResize: true
				});

				$('#table-two-axis').basictable();

				$('#table-max-height').basictable({
					tableWrapper: true
				});
			});
		</script>
		<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
		<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #dd3d36;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #5cb85c;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
		</style>
	</head>

	<body>
		<div class="page-container">
			<!--/content-inner-->
			<div class="left-content">
				<div class="mother-grid-inner">
					<!--header start here-->
					<?php include('includes/header.php'); ?>
					<div class="clearfix"> </div>
				</div>
				<!--heder end here-->
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Manage Completed Bookings</li>
				</ol>
				<div class="agile-grids">
					<!-- tables -->

					<div class="agile-tables">
						<div class="w3l-table-info">
							<h2>Completed Bookings</h2>
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="color:black;">Booking No.</th>
										<th style="color:black;">Name</th>
										<th style="color:black;" width="200">Pacakge Type</th>
										<th style="color:black;">Washing Point </th>
										<th style="color:black;">Washing Date/Time </th>
										<th style="color:black;" width="200">Posting date </th>
										<th style="color:black;">Action </th>

									</tr>
								</thead>
								<tbody>
									<?php $sql = "SELECT *,tblcarwashbooking.id as bid from tblcarwashbooking
									join tblwashingpoints on tblwashingpoints.id=tblcarwashbooking.carWashPoint
									 where status='Completed' and paymentStatus='not payed' and  tblcarwashbooking.carWashPoint='$_SESSION[carwash]'";
									$query = $dbh->prepare($sql);
									$query->execute();
									$results = $query->fetchAll(PDO::FETCH_OBJ);

									if ($query->rowCount() > 0) {
										foreach ($results as $result) {				?>
											<tr>
												<td style="color:black;"><?php echo htmlentities($result->bookingId); ?></td>
												<td style="color:black;"><?php echo htmlentities($result->fullName); ?></td>
												<td style="color:black;" width="50">
													<?php
													$ptype = $result->packageType;

													$sql1 = "SELECT * from tblprice where id='$ptype'";
													$query1 = $dbh->prepare($sql1);
													$query1->execute();
													$results1 = $query1->fetchAll(PDO::FETCH_OBJ);

													foreach ($results1 as $result1) { ?>
														<?= $result1->service; ?> (<?= $result1->cost; ?>)

													<?php }


													?></td>


												<td style="color:black;"><?php echo htmlentities($result->washingPointName); ?><br />
													<?php echo htmlentities($result->washingPointAddress); ?></td>
												<td style="color:black;"><?php echo htmlentities($result->washDate . "/" . $result->washTime); ?></td>

												<td style="color:black;"><?php echo htmlentities($result->postingDate); ?></td>


												<td style="color:black;"><a href="booking-details.php?bid=<?php echo htmlentities($result->bid); ?>&&bookingid=<?php echo htmlentities($result->bookingId); ?>">View</a>
												</td>
											<?php } ?>
											</tr>
										<?php } else { ?>
											<tr>
												<td colspan="6" style="color:red;">No Record found</td>

											</tr>
										<?php } ?>
								</tbody>
							</table>
						</div>
						</table>


					</div>
					<!-- script-for sticky-nav -->
					<script>
						$(document).ready(function() {
							var navoffeset = $(".header-main").offset().top;
							$(window).scroll(function() {
								var scrollpos = $(window).scrollTop();
								if (scrollpos >= navoffeset) {
									$(".header-main").addClass("fixed");
								} else {
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
					<?php include('includes/footer.php'); ?>
					<!--COPY rights end here-->
				</div>
			</div>
			<!--//content-inner-->
			<!--/sidebar-menu-->
			<?php include('includes/sidebarmenu.php'); ?>
			<div class="clearfix"></div>
		</div>
		<script>
			var toggle = true;

			$(".sidebar-icon").click(function() {
				if (toggle) {
					$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
					$("#menu span").css({
						"position": "absolute"
					});
				} else {
					$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
					setTimeout(function() {
						$("#menu span").css({
							"position": "relative"
						});
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

		<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
		<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
		<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
		<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
		<script src="../plugins/jszip/jszip.min.js"></script>
		<script src="../plugins/pdfmake/pdfmake.min.js"></script>
		<script src="../plugins/pdfmake/vfs_fonts.js"></script>
		<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
		<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
		<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

	</body>

	</html>
<?php } ?>

<script>
	$(function() {
		$("#example1").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": false,
			"buttons": ["print"]
		}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
	});
</script>