<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        $carwash = $_POST['washingpointname'];
        $names = $_POST['names'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordconf = $_POST['passwordconf'];
        $email = $_POST['email'];

        if ($password == $passwordconf) {
            $sql = "INSERT INTO tblusers(names,username,password,email,carwash) VALUES(:names,:username,:password,:email,:carwash)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':names', $names, PDO::PARAM_STR);
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':carwash', $carwash, PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            if ($lastInsertId) {
                echo "<script>alert('User added successfully');</script>";
                echo "<script>window.location.href ='addcar-washingpoint-owner.php'</script>";
            } else {
                echo "<script>alert('Something went wrong. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Passwords mismatch. Please try again.');</script>";
        }
    }

?>
    <!DOCTYPE HTML>
    <html>

    <head>
        <title>CWMS | Add Washing Point</title>

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
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Add Washing Point Owner</li>
                </ol>
                <!--grid-->
                <div class="grid-form">

                    <!---->
                    <div class="grid-form1">
                        <h3>Add Washing Point owner</h3>

                        <div class="tab-content">
                            <div class="tab-pane active" id="horizontal-form">
                                <form class="form-horizontal" name="washingpoint" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-2 control-label">Car Wash Point Name</label>
                                        <div class="col-sm-8">

                                            <select class="form-control" name="washingpointname" id="washingpointname" required>
                                                <option>Washing Point Name</option>
                                                <?php
                                                $sql = "SELECT * from tblwashingpoints where is_active=1 and id not in(SELECT carwash from tblusers where is_active=1)";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                foreach ($results as $result) {
                                                ?>
                                                    <option value="<?= $result->id ?>"><?= $result->washingPointName ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-2 control-label">Owner Names</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="names" id="names" placeholder="Owner Names" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="username" id="username" placeholder="username" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="password" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-2 control-label">Confirm Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" name="passwordconf" id="passwordconf" placeholder="confirm password" required>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-2 control-label">email</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                        </div>
                                    </div>









                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button type="submit" name="submit" class="btn-primary btn">Add</button>

                                            <button type="reset" class="btn-inverse btn">Reset</button>
                                        </div>
                                    </div>





                            </div>

                            </form>





                            <div class="panel-footer">

                            </div>
                            </form>
                        </div>
                    </div>
                    <!--//grid-->

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