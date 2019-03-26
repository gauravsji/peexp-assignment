<!-- Main Header -->
  <header class="main-header">
  <?php
	$sql = "SELECT * FROM task where task_assignee='" .  $user_result['id']."' and task_status='Ongoing' and delete_status<>1 and (task_start_date BETWEEN NOW() - INTERVAL 14 DAY AND NOW())";
	$resul = mysqli_query($conn, $sql);		
	$rowss=mysqli_num_rows($resul);		
	
	$sql_task = "SELECT * FROM task where task_assignee='".$user_result['id']."' and (task_start_date BETWEEN NOW() - INTERVAL 14 DAY AND NOW()) and task_status='Ongoing' and delete_status<>1";
	$result_task_dropdown = mysqli_query($conn, $sql_task);		
	$rowsstt=mysqli_num_rows($result_task_dropdown);

	$meeting_sql = "SELECT * FROM meeting where meeting_assignee='" .  $user_result['id']."' and meeting_status<>'Completed' and meeting_status<>'Cancelled'";
	$result_meeting = mysqli_query($conn, $meeting_sql);		
	$row_meeting=mysqli_num_rows($result_meeting);
	$meeting_rows=mysqli_num_rows($result_meeting);	

	$birthday_sql = "SELECT * FROM users WHERE DATE_FORMAT(date_of_birth,'%m-%d') = DATE_FORMAT(NOW(),'%m-%d') and authenticate<>0 and id<>".$user_result['id'];
	$result_birthday = mysqli_query($conn, $birthday_sql);	 
	$birthday_rows=mysqli_num_rows($result_birthday);

	$order_sql = "SELECT * FROM ss_order so, customer c, project p WHERE p.project_id=so.project_id and c.customer_id=so.customer_id and so.order_assignee='" .  $user_result['id']."' and so.order_status<>'Order Fulfilled' and so.delete_status<>1 and (so.order_date BETWEEN NOW() - INTERVAL 14 DAY AND NOW())";
	$result_order = mysqli_query($conn, $order_sql);	 
	$order_rows=mysqli_num_rows($result_order);	
	
	$enquiry_sql = "SELECT * FROM enquiry e
					LEFT OUTER JOIN sales_lead sl ON e.sales_lead_id=sl.sales_lead_id
					LEFT OUTER JOIN customer c ON e.customer_id=c.customer_id
					LEFT OUTER JOIN project p ON e.project_id = p.project_id
					LEFT OUTER JOIN users u ON u.id = e.enquiry_assignee
					WHERE e.delete_status <> 1 and e.enquiry_assignee='".$user_result['id']."' and (e.enquiry_status!='CLOSED - REJECTED, PRICE TOO HIGH' or e.enquiry_status!='CLOSED - REJECTED, NOT THE RIGHT PRODUCT' or e.enquiry_status!='CLOSED - REJECTED, DELAYED REPONSE' or e.enquiry_status!='CLOSED - CLIENT CHANGED REQUIREMENT' or e.enquiry_status!='CLOSED - VENDOR NOT FOUND' or e.enquiry_status!='CLOSED - CONVERTED TO ORDER') and (e.enquiry_date BETWEEN NOW() - INTERVAL 14 DAY AND NOW())";
	$result_enquiry = mysqli_query($conn, $enquiry_sql);	 
	$enquiry_rows=mysqli_num_rows($result_enquiry);	
  ?>

    <!-- Logo -->
    <a href="../html/dashboard.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>S</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Smartstorey </b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
			
			<li class="dropdown notifications-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-bell-o"></i>
				<?php if($meeting_rows>0&&$birthday_rows==0)	{echo '<span class="label label-success">'; echo $meeting_rows; echo '</span>';}?>
				
				<?php if($birthday_rows>0&&$meeting_rows==0)	{echo '<span class="label label-success">'; echo $birthday_rows; echo '</span>';}?>
				<?php if($birthday_rows>0&&$meeting_rows>0)	{echo '<span class="label label-success">'; echo $birthday_rows+$meeting_rows; echo '</span>';}?>
				
				</a>
				<ul class="dropdown-menu">
					
					<li class="header">	
							<center>
							<?php // set default timezone
								date_default_timezone_set('Asia/Kolkata'); $info = getdate(); $date = $info['mday'];
								$month = $info['mon'];
								$year = $info['year'];
								$hour = $info['hours'];
								$min = $info['minutes'];
								$sec = $info['seconds'];

								$current_date = "$date/$month/$year == $hour:$min:$sec"; 
								if(($hour>=1)&&($hour<=12)) 
								{ 
									echo "Good Morning, ".$user_result['name']; 
								} 
								else if(($hour>=12)&&($hour<=16)) 
								{ 
									echo "Good Afternoon, ".$user_result['name']; 
								} 
								else if(($hour>=16)&&($hour<=19)) 
								{ 
									echo "Good Evening, ".$user_result['name']; 
								} 
								else if(($hour>19)&&($hour<=23)) 
								{ 
									echo "Good Night, ".$user_result['name']; 
								} 
							?>		
					</center>							
					</li>
					
			
					<li>					
						<!-- inner menu: contains the actual data -->
													 <li>
							
								   <?php if($birthday_rows>0){ echo ' <a>
								<center><strong>Birthdays</strong></center>
							</a>';}?>
								
							  </li>
							<?php 
							$birthday_row=0;
							while($birthday_row=mysqli_fetch_array($result_birthday))
							{						 
								echo '<li><a><center>'; echo 'Your friend 
								'.$birthday_row['name'].' has birthday today														
								</center></a></li>';
							}
							?>
											
					</li>
			
					<li>					
						<!-- inner menu: contains the actual data -->
						<ul class="menu">
							 <li>
							 <a>
								<center>
								   <?php if($meeting_rows>0){ echo 'Meetings For You';} else { echo 'No Meetings For You';} ?>
								</center>
								 </a>
							  </li>
							<?php 
							$meeting_row=0;
							while($meeting_row=mysqli_fetch_array($result_meeting))
							{						 
								echo '<li><a href="../html/view_meeting_html.php?id='.$meeting_row['meeting_id'].'"'; echo '>
								'.$meeting_row['meeting_title']."-".$meeting_row['meeting_venue'].' 
								<small class="pull-right">'. date("d-m-Y", strtotime($meeting_row['meeting_date'])).' </small>
								</h3>							
								</a></li>';
							}
							?>
						</ul>
						
					</li>
					<li class="footer"><a href="../reports/meeting_report_html.php">View all Meetings</a></li>				
				</ul>				
			</li>

			<!-- Tasks: style can be found in dropdown.less -->
			<li class="dropdown tasks-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-flag-o"></i>					
					<?php if($rowsstt>0)	{echo '<span class="label label-danger">'; echo $rowsstt; echo '</span>';}?>					
				</a>
				<ul class="dropdown-menu">
					<li class="header">
					<center>
						<?php   
							if($rowss==1) echo "You have $rowss task"; else if($rowss==1) echo "You have $rowss tasks";  else if($rowss==0) echo "No tasks assigned to you";  else  echo "You have $rowss tasks";
						?>
						</center>
					</li>
					<li>
						<!-- inner menu: contains the actual data -->
						<ul class="menu">
							<!-- Task item -->
							<?php 
								$tsk_row=0;
								while($tsk_row=mysqli_fetch_array($resul))
								{											
									echo '<li><a href="../html/view_task_html.php?id='.$tsk_row['task_id'].'">
									<h3> '.$tsk_row['task_name'].' 
									<small class="pull-right">'. date("d-m-Y", strtotime($tsk_row['task_start_date'])).' </small>
									</h3>
									<div class="progress xs">
									<div class="progress-bar progress-bar-aqua" style="width:50%" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
									<span class="sr-only">50% Complete</span>
									</div>
									</div>
									</a></li>';
								}
							?>
							<!-- end task item -->
						</ul>
					</li>
					
					<li class="footer">
					<a href="../reports/own_task_report_html.php">View all Tasks</a>
					</li>
				</ul>
			</li> 			
			
			
			
			
			<!-- Orders -->
			<li class="dropdown tasks-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-shopping-cart"></i>							
					<?php if($order_rows>0)	{echo '<span class="label label-danger">'; echo $order_rows; echo '</span>';}?>					
				</a>
				<ul class="dropdown-menu">
					<li class="header">
					<center>
						<?php   
							if($order_rows==1) echo "You have $order_rows order"; else if($order_rows==1) echo "You have $order_rows order";  else if($order_rows==0) echo "No orders assigned to you";  else  echo "You have $order_rows orders";
						?>
						</center>
					</li>
						<li>
						<!-- inner menu: contains the actual data -->
						<ul class="menu">
							<!-- Order item -->
							<?php 
								$order_row=0;
								while($order_row=mysqli_fetch_array($result_order))
								{											
									echo '<li><a href="../html/view_order_html.php?id='.$order_row['order_id'].'">
									<h3> <marquee behavior="alternate">'.$order_row['customer_name'].'-'.$order_row['project_name'].' </marquee>
									<small class="pull-right">'. date("d-m-Y", strtotime($order_row['order_date'])).' </small>
									</h3>
									</a></li>';
								}
							?>
							<!-- End Order Item -->
						</ul>
					</li>
					
					<li class="footer">
					<a href="../reports/order_report_html.php">View all Orders</a>
					</li>
				</ul>
			</li> 
			
			
			
			
			
			
			
			
			<!-- Enquiry -->
			<li class="dropdown tasks-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="ion-android-list"></i>							
					<?php if($enquiry_rows>0)	{echo '<span class="label label-danger">'; echo $enquiry_rows; echo '</span>';}?>					
				</a>
				<ul class="dropdown-menu">
					<li class="header">
					<center>
						<?php   
							if($enquiry_rows==1) echo "You have $enquiry_rows enquiry"; else if($enquiry_rows==1) echo "You have $enquiry_rows enquiry";  else if($enquiry_rows==0) echo "No enquiries assigned to you";  else  echo "You have $enquiry_rows enquiries";
						?>
						</center>
					</li>
						<li>
						<!-- inner menu: contains the actual data -->
						<ul class="menu">
							<!-- Enquiry item -->
							<?php 
								$enquiry_row=0;
								while($enquiry_row=mysqli_fetch_array($result_enquiry))
								{											
									echo '<li><a href="../html/view_enquiry_html.php?id='.$enquiry_row['enquiry_id'].'">
									<h3>';
									if($enquiry_row['customer_name']<>"")
									{
										echo ''.$enquiry_row['enquiry_name'].'-'.$enquiry_row['customer_name'].'-'.$enquiry_row['project_name'].'';
									}
									else
									{
										echo ''.$enquiry_row['enquiry_name'].'-'.$enquiry_row['sales_lead_name'].'';
									}
									echo '
									<small class="pull-right">'. date("d-m-Y", strtotime($enquiry_row['enquiry_date'])).' </small>
									</h3>
									</a></li>';
								}
							?>
							<!-- End Enquiry Item -->
						</ul>
					</li>
					
					<li class="footer">
					<a href="../reports/enquiry_report_html.php">View all Enquiries</a>
					</li>
				</ul>
			</li> 
			
		  	  
          <!-- Messages: style can be found in dropdown.less-->
  
		  <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="fa fa-user"></i>
			  <!--<img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
              <span class="hidden-xs"><?php echo $_SESSION['name'] ?></a></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <p>
                  Welcome To Smartstorey
                  <small>Member since <?php echo date('d-m-Y',strtotime($user_result['date_of_join']));   ?></small>
                  <small>Email: <?php echo $user_result['email'];   ?></small>
                </p>
              </li>

              <li class="user-footer">
			  <div class="pull-left">
                  <a href="../html/user_profile_html.php" class="btn bg-green btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="../php/register_login/logout.php" class="btn btn-danger btn-flat">Log out</a>
                </div>
              </li>
            </ul>
          </li>

		  <li class="dropdown notifications-menu">
				<a href="../html/all_reports.php" >
					<i class="fa fa-list"></i>
				</a>							
		 </li>	
		  <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" id="open_sidebar" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
		  
        </ul>
      </div>

    </nav>
  </header>