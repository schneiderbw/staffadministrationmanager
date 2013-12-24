<?php include_once 'config.php'; include_once 'mysql.php'; ?>
<?php
$phpsessionid = session_id();
session_start();
if(empty($_SESSION['id'])) {
    header("Location: /login.php");
    exit;
}

$currentuser = $_SESSION['fname']." ".$_SESSION['lname'];
?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $pagetitle; ?></title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">SAM/IPDP System</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> <?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?> <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">Profile</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="login.php?action=logout">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="active">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">SAM <i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">Staff Member Search</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Create Staff Member</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="#">Attendance Dashboard</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">View Daily Absence</a>
                                    </li>

                                    <li>
                                        <a tabindex="-1" href="#">Attendance Quick Enter</a>
                                    </li>
                                </ul>
                            </li>
                            <?php if(in_array("ipdp-app_create" || "ipdp-act_create" || "building_admin" || "ipdp-app_adminsign" || "district_admin", $_SESSION['permname'])) : ?>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">IPDP <i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <?php if(in_array("ipdp-app_create", $_SESSION['permname'])) : ?>
                                    <li>
                                        <a tabindex="-1" href="#">Create a New IPDP Appliction</a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(in_array("ipdp-act_create", $_SESSION['permname'])) : ?>
                                    <li>
                                        <a tabindex="-1" href="#">Add CEU Activity</a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(in_array("ipdp-app_create", $_SESSION['permname'])) : ?>
                                    <li>
                                        <a tabindex="-1" href="#">Review Other's IPDP</a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(in_array(("building_admin" && "ipdp-app_adminsign") || "district_admin", $_SESSION['permname'])) : ?>
                                    <li class="divider"></li>
                                    <?php endif; ?>
                                    <?php if(in_array("building_admin" && "ipdp-app_adminsign", $_SESSION['permname'])): ?>
                                    <li>
                                        <a tabindex="-1" href="#">Review/Sign My Building's IPDPs</a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(in_array("district_admin", $_SESSION['permname'])): ?>
                                    <li>
                                        <a tabindex="-1" href="#">Review All IPDPs</a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <?php endif; ?>

                            <?php if(in_array("building_admin" || "district_admin", $_SESSION['permname'])): ?>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Admin <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">User List</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Search</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Permissions</a>
                                    </li>
                                </ul>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li <?php if(basename($_SERVER['PHP_SELF'])==="index.php"){ echo "class=\"active\""; } ?> >
                            <a href="index.php"><i class="icon-chevron-right"></i> My Dashboard</a>
                        </li>
                        <li <?php if(basename($_SERVER['PHP_SELF'])==="myinfo.php"){ echo "class=\"active\""; } ?> >
                            <a href="myinfo.php"><i class="icon-chevron-right"></i> My Info &amp; Licensure</a>
                        </li>
                        <li <?php if(basename($_SERVER['PHP_SELF'])==="samdash.php"){ echo "class=\"active\""; } ?> >
                            <a href="samdash.php"><i class="icon-chevron-right"></i> SAM Dashboard</a>
                        </li>
                        <li <?php if(basename($_SERVER['PHP_SELF'])==="ipdpdash.php"){ echo "class=\"active\""; } ?> >
                            <a href="ipdpdash.php"><i class="icon-chevron-right"></i> IPDP Dashboard</a>
                        </li>

                    </ul>
                </div>
                
                <!--/span-->
