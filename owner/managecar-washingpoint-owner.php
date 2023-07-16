<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    //Code for Deletion
    if ($_GET['did']) {
        $id = $_GET['did'];
        $sql = "DELETE FROM tblusers  where id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('User Deleted');</script>";
        echo "<script>window.location.href ='managecar-washingpoint-owner.php'</script>";
    }

    //Code for dissable
    if ($_GET['rid']) {
        $id = $_GET['rid'];
        $sql = "UPDATE tblusers set is_active=0 where id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('User Disabled');</script>";
        echo "<script>window.location.href ='managecar-washingpoint-owner.php'</script>";
    }
    //Code for restore
    if ($_GET['restid']) {
        $id = $_GET['restid'];
        $sql = "UPDATE tblusers set is_active=1 where id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('User Restored');</script>";
        echo "<script>window.location.href ='managecar-washingpoint-owner.php'</script>";
    }

?>
    <!DOCTYPE HTML>
    <html>

    <head>
        <title>CWMS | Manage Car Wash Point Owners</title>
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
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <!-- Custom CSS -->
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <link rel="stylesheet" href="css/morris.css" type="text/css" />
        <!-- Graph CSS -->
        <link href="css/font-awesome.css" rel="stylesheet">
        <!-- jQuery -->
        <script src="js/jquery-2.1.4.min.js"></script>
        <!-- //jQuery -->
        <!-- tables -->
        <link rel="stylesheet" type="text/css" href="css/table-style.css" />
        <link rel="stylesheet" type="text/css" href="css/basictable.css" />
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
        <!-- //tables -->
        <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
        <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <!-- lined-icons -->
        <link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
        <!-- //lined-icons -->
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
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Manage Car Washing Point Owners</li>
                </ol>
                <!-- ==================================== active users ========================= -->
                <div class="agile-grids">
                    <!-- tables -->

                    <div class="agile-tables">
                        <div class="w3l-table-info">
                            <h2>Active Users</h2>
                            <table id="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Owners Names</th>
                                        <th>Email</th>
                                        <th>Washing Point Name</th>
                                        <th>Creation Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sql = "SELECT * from tblusers where is_active=1";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {                ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($result->names); ?></td>
                                                <td><?php echo htmlentities($result->email); ?></td>
                                                <?php
                                                $cwsql = "SELECT * from tblwashingpoints where id='$result->carwash' and is_active=1";
                                                $cwquery = $dbh->prepare($cwsql);
                                                $cwquery->execute();
                                                $cwresults = $cwquery->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($cwquery->rowCount() > 0) {
                                                    foreach ($cwresults as $cwresult) {                ?>
                                                        <td><?php echo htmlentities($cwresult->washingPointName); ?></td>
                                                <?php
                                                    }
                                                } ?>
                                                <td><?php echo htmlentities($result->created_on); ?></td>
                                                <td>
                                                    <a href="edit-owner.php?wpid=<?php echo htmlentities($result->id); ?>">Edit</a> | <a href="managecar-washingpoint-owner.php?rid=<?php echo htmlentities($result->id); ?>" style="color:red;" onClick="return confirm('Do you really want to dissable this user ?');">Disable</a>
                                                </td>
                                            </tr>
                                    <?php $cnt = $cnt + 1;
                                        }
                                    } ?>
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

                    <!--COPY rights end here-->
                </div>
                <!-- ===================================== disabled users =================================== -->
                <div class="agile-grids">
                    <!-- tables -->

                    <div class="agile-tables">
                        <div class="w3l-table-info">
                            <h2>Disabled Users</h2>
                            <table id="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Owners Names</th>
                                        <th>Email</th>
                                        <th>Washing Point Name</th>
                                        <th>Creation Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sql = "SELECT * from tblusers where is_active=0";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {                ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($result->names); ?></td>
                                                <td><?php echo htmlentities($result->email); ?></td>
                                                <?php
                                                $cwsql = "SELECT * from tblwashingpoints where id='$result->carwash'";
                                                $cwquery = $dbh->prepare($cwsql);
                                                $cwquery->execute();
                                                $cwresults = $cwquery->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($cwquery->rowCount() > 0) {
                                                    foreach ($cwresults as $cwresult) {                ?>
                                                        <td><?php echo htmlentities($cwresult->washingPointName); ?></td>
                                                <?php
                                                    }
                                                } ?>
                                                <td><?php echo htmlentities($result->created_on); ?></td>
                                                <td>
                                                    <a href="managecar-washingpoint-owner.php?restid=<?php echo htmlentities($result->id); ?>" style="color:green;" onClick="return confirm('Do you really want to restore this user ?');">Restore</a>
                                                    |<a href="managecar-washingpoint-owner.php?did=<?php echo htmlentities($result->id); ?>" style="color:red;" onClick="return confirm('Do you really want to delete this user ?');">Delete</a>
                                                </td>
                                            </tr>
                                    <?php $cnt = $cnt + 1;
                                        }
                                    } ?>
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

    </body>

    </html>
<?php } ?>