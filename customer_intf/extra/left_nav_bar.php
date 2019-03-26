	<?php

	include '../html/constants.php';
	echo '
		<aside class="main-sidebar">
			<section class="sidebar">
				<ul class="sidebar-menu">
					<li id="li_dashboard" class="treeview">
						<a href="'.$GLOBALS['dashboard'].'">
							<i class="fa fa-dashboard"></i><span>Dashboard</span>
							<span class="pull-right-container"></span>
						</a>
					</li>

					<li id="li_rfq" class="treeview">
						<a href="">
							<i class="fa fa-list"></i><span> Request Details </span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li id="li_add_rfq"><a href="'.$GLOBALS['add_rfq_html'].'"><i class="fa fa-plus"></i>Request Quote</a></li>
							<li id="li_rfq_report"><a href="'.$GLOBALS['report_rfq'].'"><i class="fa fa-list-alt"></i>Request Report</a></li>
							</ul>
					</li>

					<li id="li_reports" class="treeview">
						<a href="">
							<i class="fa fa-list"></i><span>Reports</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li id="li_order_report"><a href="'.$GLOBALS['report_order'].'"><i class="fa fa-list-alt"></i> Order Report</a></li>
							</ul>
					</li>

					<li id="li_project" class="treeview">
						<a href="">
							<i class="fa fa-list"></i><span>Project Details</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li id="li_add_project"><a href="'.$GLOBALS['add_project_html'].'"><i class="fa fa-plus"></i> Add Project</a></li>
							<li id="li_project_report"><a href="'.$GLOBALS['report_project'].'"><i class="fa fa-list-alt"></i> Project Report</a></li>
						</ul>
					</li>


					<li id="li_users" class="treeview">
						<a href="">
							<i class="fa fa-list"></i><span>Profile</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li id="li_add_user"><a href="'.$GLOBALS['add_user_html'].'"><i class="fa fa-user-plus"></i>Create User</a></li>
							<li id="li_user_report"><a href="'.$GLOBALS['report_user'].'"><i class="fa fa-list-alt"></i>Users Report</a></li>
							</ul>
					</li>

			</section>
		</aside>' ;
	?>
