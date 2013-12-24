<?php include_once 'header.php'; include_once 'mysql.php'; ?>
                <div class="span9" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="#">Dashboard</a> <span class="divider">/</span>	
	                                    </li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>

        <div class="block">
        	<div class="navbar navbar-inner block-header">
        		<div class="muted pull-left"><?php echo $_SESSION['fname']." ".$_SESSION['lname']."'s Absence Days Left"; ?></div>
        		<div class="pull-right">
        			<span class="badge badge-warning">View Absence Detail</span>
        		</div>
        	</div>
        		<?php
        			$staffid = $_SESSION['id'];
        			$positionid = $_SESSION['positiontemplateid'];
                                // sql for staff member's absences
                                $sqlstaffvaca = "SELECT * FROM `staff_absences` WHERE `staffid` = '$staffid' AND `type` = 'vacation'";
                                $sqlstaffemerg = "SELECT * FROM `staff_absences` WHERE `staffid` = '$staffid' AND `type` = 'emergency'";
                                $sqlstaffother = "SELECT * FROM `staff_absences` WHERE `staffid` = '$staffid' AND `type` = 'other'";
                                $sqlstaffprof = "SELECT * FROM `staff_absences` WHERE `staffid` = '$staffid' AND `type` = 'professional'";
                                $sqlstaffsick = "SELECT * FROM `staff_absences` WHERE `staffid` = '$staffid' AND `type` = 'sick'";
        			// get staff member's count of absences
        			$getnumstaffvacation = mysqli_num_rows(mysqli_query($mysqli, $sqlstaffvaca));
        			$getnumstaffemerg = mysqli_num_rows(mysqli_query($mysqli, $sqlstaffemerg));
        			$getnumstaffother = mysqli_num_rows(mysqli_query($mysqli, $sqlstaffother));
        			$getnumstaffprof = mysqli_num_rows(mysqli_query($mysqli, $sqlstaffprof));
        			$getnumstaffsick = mysqli_num_rows(mysqli_query($mysqli, $sqlstaffsick));
        			// set the sql querys to find default leave days
                                $sqlposition = mysqli_query($mysqli, "SELECT * FROM `position_settings` WHERE `positionid` = '$positionid'");
                                //print $sqlposition;
                                // get the number of vacation days for the person's position
        			$getnumposition = mysqli_fetch_array($sqlposition);
                                // get percentage from the values we got from the database
                                $getpercentvacation = $getnumstaffvacation % $getnumposition['vacadefault'];
        			$getpercentemerg = $getnumstaffemerg % $getnumposition['emergdefault'];
        			$getpercentother = $getnumstaffother % $getnumposition['otherdefault'];
        			$getpercentprof = $getnumstaffprof % $getnumposition['profdefault'];
        			$getpercentsick = $getnumstaffsick % $getnumposition['sickdefault'];
        		?>
        		<div class="block-content collapse in">
                            <div class="span1"></div>
                                <div class="span2"><!--Start chart space-->
        				<div class="chart easyPieChart" data-percent=<?php echo "\"".$getpercentsick."\""; ?> style="width: 110px; height 110px; line-height: 110px; ">
        					<?php echo $getnumstaffsick."/".$getnumposition['sickdefault']; ?>
        					<canvas width="110" height="110">
        				</div>
        				<div class="chart-bottom-heading">
        					<span class="label label-info">Sick Days</span>
        				</div>
        			</div><!--/chart-->
        			<div class="span2"><!--Start chart space-->
        				<div class="chart easyPieChart" data-percent=<?php echo "\"".$getpercentvacation."\""; ?> style="width: 110px; height 110px; line-height: 110px; ">
        					<?php echo $getnumstaffvacation."/".$getnumposition['vacadefault']; ?>
        					<canvas width="110" height="110">
        				</div>
        				<div class="chart-bottom-heading">
        					<span class="label label-info">Vacation Days</span>
        				</div>
        			</div><!--/chart-->
        			<div class="span2"><!--Start chart space-->
        				<div class="chart easyPieChart" data-percent=<?php echo "\"".$getpercentemerg."\""; ?> style="width: 110px; height 110px; line-height: 110px; ">
        					<?php echo $getnumstaffemerg."/".$getnumposition['emergdefault']; ?>
        					<canvas width="110" height="110">
        				</div>
        				<div class="chart-bottom-heading">
        					<span class="label label-info">Emergency Leave</span>
        				</div>
        			</div><!--/chart-->
        			<div class="span2"><!--Start chart space-->
        				<div class="chart easyPieChart" data-percent=<?php echo "\"".$getpercentother."\""; ?> style="width: 110px; height 110px; line-height: 110px; ">
        					<?php echo $getnumstaffother."/".$getnumposition['otherdefault']; ?>
        					<canvas width="110" height="110">
        				</div>
        				<div class="chart-bottom-heading">
        					<span class="label label-info">Other Leave</span>
        				</div>
        			</div><!--/chart-->
        			<div class="span2"><!--Start chart space-->
        				<div class="chart easyPieChart" data-percent=<?php echo "\"".$getpercentprof."\""; ?> style="width: 110px; height 110px; line-height: 110px; ">
        					<?php echo $getnumstaffprof."/".$getnumposition['profdefault']; ?>
        					<canvas width="110" height="110">
        				</div>
        				<div class="chart-bottom-heading">
        					<span class="label label-info">Professional Leave</span>
        				</div>
        			</div><!--/chart-->
                                <div class="span1"></div>
                        </div>
                </div>
                <div class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">My Licensure</div>
                            <div class="pull-right"><span class="badge badge-info"><?php echo $countlicensure; ?></span>

                                    </div>
                                </div>
                    
                    <div class="block-content collapse in">
                        <div class="span12">
                        <?php if(isset($countlicensure)) { 
                            echo "<table class=\"table\">";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>License Number</th>";
                            echo "<th>Subject Area</th>";
                            echo "<th>Expiration Date</th>";
                            echo "</tr>";
                            echo "</thead>";
                            
                        } else {
                            echo "<div class=\"alert alert-info alert-block\">";
                            echo "You do not currently have any licensure issued by the State of Ohio.";
                            echo "</div>";
                        }
                        ?>
                        </div>
                    </div>
<?php include_once 'footer.php';?>