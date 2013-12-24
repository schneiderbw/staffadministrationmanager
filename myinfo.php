<?php include_once 'header.php'; include_once 'mysql.php'; ?>
<?php
	$page_name = "My Info";
?>
                <div class="span9" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="index.php">Dashboard</a> <span class="divider">/</span> <a href="<?php echo($_SERVER['PHP_SELF']); ?>"> <?php echo($page_name); ?></a>
	                                    </li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <div class="row-fluid section">
            <div class="block">
        	<?php if (!isset($_GET['view'])): ?>
		<div class="navbar navbar-inner block-header">
        		<div class="muted pull-left">Demographic Information</div>
			<div class="pull-right">
				<?php echo "<a href=\"".$_SERVER['PHP_SELF']."?view=licensure\">"; ?><span class="badge badge-info">View My Licensure</span></a>
			</div>
        	</div>
        	<div class="block-content collapse in">
        		<div class="span12">
        			<form class="form-horizontal">
        				<fieldset>
        					<legend><?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?></legend>
        					<div class="control-group">
                            	<label class="control-label">First Name</label>
                                <div class="controls">
                                	<span class="input-xlarge uneditable-input"><?php echo $_SESSION['fname']; ?></span>
                                </div>
                            </div>
                            <div class="control-group">
                            	<label class="control-label">Last Name</label>
                            	<div class="controls">
                            		<span class="input-xlarge uneditable-input"><?php echo $_SESSION['lname']; ?></span>
                            	</div>
                            </div>
                        	<div class="control-group">
                        		<label class="control-label">Street Address</label>
                        		<div class="controls">
                        			<span class="input-xlarge uneditable-input"><?php echo $_SESSION['street1']; ?></span><br><br>
                        			<span class="input-xlarge uneditable-input"><?php echo $_SESSION['street2']; ?></span>
                        		</div>
                        	</div>
				<div class="control-group">
					<label class="control-label">City</label>
					<div class="controls">
						<span class="input-xlarge uneditable-input"><?php echo $_SESSION['city']; ?></span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">State</label>
					<div class="controls">
						<span class="controls span4">
							<select id="state" class="chzn-select">
                                                            <option value="AL" <?php if($_SESSION['state']==="AL") { echo "selected"; } ?>>Alabama</option>
                                                            <option value="AK" <?php if($_SESSION['state']==="AK") { echo "selected"; } ?>>Alaska</option>
                                                            <option value="AZ" <?php if($_SESSION['state']==="AZ") { echo "selected"; } ?>>Arizona</option>
                                                            <option value="AR" <?php if($_SESSION['state']==="AR") { echo "selected"; } ?>>Arkansas</option>
                                                            <option value="CA" <?php if($_SESSION['state']==="CA") { echo "selected"; } ?>>California</option>
                                                            <option value="CO" <?php if($_SESSION['state']==="CO") { echo "selected"; } ?>>Colorado</option>
                                                            <option value="CT" <?php if($_SESSION['state']==="CT") { echo "selected"; } ?>>Connecticut</option>
                                                            <option value="DE" <?php if($_SESSION['state']==="DE") { echo "selected"; } ?>>Delaware</option>
                                                            <option value="DC" <?php if($_SESSION['state']==="DC") { echo "selected"; } ?>>Dist of Columbia</option>
                                                            <option value="FL" <?php if($_SESSION['state']==="FL") { echo "selected"; } ?>>Florida</option>
                                                            <option value="GA" <?php if($_SESSION['state']==="GA") { echo "selected"; } ?>>Georgia</option>
                                                            <option value="HI" <?php if($_SESSION['state']==="HI") { echo "selected"; } ?>>Hawaii</option>
                                                            <option value="ID" <?php if($_SESSION['state']==="ID") { echo "selected"; } ?>>Idaho</option>
                                                            <option value="IL" <?php if($_SESSION['state']==="IL") { echo "selected"; } ?>>Illinois</option>
                                                            <option value="IN" <?php if($_SESSION['state']==="IN") { echo "selected"; } ?>>Indiana</option>
                                                            <option value="IA" <?php if($_SESSION['state']==="IA") { echo "selected"; } ?>>Iowa</option>
                                                            <option value="KS" <?php if($_SESSION['state']==="KS") { echo "selected"; } ?>>Kansas</option>
                                                            <option value="KY" <?php if($_SESSION['state']==="KY") { echo "selected"; } ?>>Kentucky</option>
                                                            <option value="LA" <?php if($_SESSION['state']==="LA") { echo "selected"; } ?>>Louisiana</option>
                                                            <option value="ME" <?php if($_SESSION['state']==="ME") { echo "selected"; } ?>>Maine</option>
                                                            <option value="MD" <?php if($_SESSION['state']==="MD") { echo "selected"; } ?>>Maryland</option>
                                                            <option value="MA" <?php if($_SESSION['state']==="MA") { echo "selected"; } ?>>Massachusetts</option>
                                                            <option value="MI" <?php if($_SESSION['state']==="MI") { echo "selected"; } ?>>Michigan</option>
                                                            <option value="MN" <?php if($_SESSION['state']==="MN") { echo "selected"; } ?>>Minnesota</option>
                                                            <option value="MS" <?php if($_SESSION['state']==="MS") { echo "selected"; } ?>>Mississippi</option>
                                                            <option value="MO" <?php if($_SESSION['state']==="MO") { echo "selected"; } ?>>Missouri</option>
                                                            <option value="MT" <?php if($_SESSION['state']==="MT") { echo "selected"; } ?>>Montana</option>
                                                            <option value="NE" <?php if($_SESSION['state']==="NE") { echo "selected"; } ?>>Nebraska</option>
                                                            <option value="NV" <?php if($_SESSION['state']==="NV") { echo "selected"; } ?>>Nevada</option>
                                                            <option value="NH" <?php if($_SESSION['state']==="NH") { echo "selected"; } ?>>New Hampshire</option>
                                                            <option value="NJ" <?php if($_SESSION['state']==="NJ") { echo "selected"; } ?>>New Jersey</option>
                                                            <option value="NM" <?php if($_SESSION['state']==="NM") { echo "selected"; } ?>>New Mexico</option>
                                                            <option value="NY" <?php if($_SESSION['state']==="NY") { echo "selected"; } ?>>New York</option>
                                                            <option value="NC" <?php if($_SESSION['state']==="NC") { echo "selected"; } ?>>North Carolina</option>
                                                            <option value="ND" <?php if($_SESSION['state']==="ND") { echo "selected"; } ?>>North Dakota</option>
                                                            <option value="OH" <?php if($_SESSION['state']==="OH") { echo "selected"; } ?>>Ohio</option>
                                                            <option value="OK" <?php if($_SESSION['state']==="OK") { echo "selected"; } ?>>Oklahoma</option>
                                                            <option value="OR" <?php if($_SESSION['state']==="OR") { echo "selected"; } ?>>Oregon</option>
                                                            <option value="PA" <?php if($_SESSION['state']==="PA") { echo "selected"; } ?>>Pennsylvania</option>
                                                            <option value="RI" <?php if($_SESSION['state']==="RI") { echo "selected"; } ?>>Rhode Island</option>
                                                            <option value="SC" <?php if($_SESSION['state']==="SC") { echo "selected"; } ?>>South Carolina</option>
                                                            <option value="SD" <?php if($_SESSION['state']==="SD") { echo "selected"; } ?>>South Dakota</option>
                                                            <option value="TN" <?php if($_SESSION['state']==="TN") { echo "selected"; } ?>>Tennessee</option>
                                                            <option value="TX" <?php if($_SESSION['state']==="TX") { echo "selected"; } ?>>Texas</option>
                                                            <option value="UT" <?php if($_SESSION['state']==="UT") { echo "selected"; } ?>>Utah</option>
                                                            <option value="VT" <?php if($_SESSION['state']==="VT") { echo "selected"; } ?>>Vermont</option>
                                                            <option value="VA" <?php if($_SESSION['state']==="VA") { echo "selected"; } ?>>Virginia</option>
                                                            <option value="WA" <?php if($_SESSION['state']==="WA") { echo "selected"; } ?>>Washington</option>
                                                            <option value="WV" <?php if($_SESSION['state']==="WV") { echo "selected"; } ?>>West Virginia</option>
                                                            <option value="WI" <?php if($_SESSION['state']==="WI") { echo "selected"; } ?>>Wisconsin</option>
                                                            <option value="WY" <?php if($_SESSION['state']==="WY") { echo "selected"; } ?>>Wyoming</option>
                                                        </select>
						</span>
					</div>
				</div>
                               <div class="control-group">
                                   <label class="control-label">ZIP Code</label>
                                   <div class="controls">
                                       <span class="input-xlarge uneditable-input"><?php echo $_SESSION['zip']; ?></span>
                                   </div>
                               </div>
                            <div class="control-group">
                                <label class="control-label">Home Phone</label>
                                <div class="controls">
                                    <span class="input-xlarge uneditable-input"><?php echo $_SESSION['phonec']; ?></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Cell Phone</label>
                                <div class="controls">
                                    <span class="input-xlarge uneditable-input"><?php echo $_SESSION['phonec']; ?></span>
				</div>
			    </div>
			</div>
		<?php elseif($_GET['view']==="licensure"): ?>
		<div class="navbar navbar-inner block-header">
        		<div class="muted pull-left">Licensure Information</div>
			<div class="pull-right">
				<?php echo "<a href=\"".$_SERVER['PHP_SELF']."\">"; ?><span class="badge badge-info">View Demographic Information</span></a>
			</div>
        	</div>
		<div class="block-content collapse in">
        		<div class="span12">
				<?php //setting our sql variables ?>
				<?php $getlicensure="SELECT * FROM staff_certifications WHERE staffid = ".$_SESSION['id'] ; ?>
			</div>
		</div>
		<?php endif; ?>
		</div>
		</div>
                    
<?php include_once 'footer.php';?>