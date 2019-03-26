	<?php
	if($user_result['location']=="Bangalore")
	{
		if($user_result['role']=="Admin")
		{
		echo '
			<aside class="main-sidebar">
				<section class="sidebar">
					<ul class="sidebar-menu">
						<li id="li_dashboard" class="treeview">
							<a href="../html/dashboard.php">
								<i class="fa fa-dashboard"></i><span> Dashboard</span>
								<span class="pull-right-container"></span>
							</a>
						</li>
						<li id="li_daily_operations" class="treeview">
							<a>
								<i class="fa fa-cogs"></i><span> Daily Operations</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_daily_log"><a href="../html/add_daily_log_html.php"><i class="fa fa-plus"></i> Add Daily Log</a></li>
								<li id="li_daily_log_report"><a href="../reports/daily_log_report_html.php"><i class="fa fa-list-alt"></i> Daily Log Report</a></li>
								<li id="li_add_meeting"><a href="../html/add_meeting_html.php"><i class="fa fa-plus"></i> New Meeting</a></li>
								<li id="li_meeting_report"><a href="../reports/meeting_report_html.php"><i class="fa fa-list-alt"></i> Meeting Report</a></li>
							</ul>
						</li>

						<li id="li_enquiry" class="treeview">
							<a>
								<i class="fa fa-list"></i><span> Enquiry</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_sales_lead"><a href="../html/add_sales_lead_html.php"><i class="fa fa-plus"></i> Add Sales Lead</a></li>
								<li id="li_sales_lead_report"><a href="../reports/sales_lead_report_html.php"><i class="fa fa-list-alt"></i> Sales Lead Report</a></li>
								<li id="li_new_enquiry"><a href="../html/add_enquiry_html.php"><i class="fa fa-plus"></i> New Enquiry</a></li>
								<li id="li_enquiry_report"><a href="../reports/enquiry_report_html.php"><i class="fa fa-list-alt"></i> Enquiry Report</a></li>
							</ul>
						</li>
						<li id="li_enquiry_manage" class="treeview">
							<a>
								<i class="fa fa-archive"></i><span> Customer Request</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_user_enquiry_report"><a href="../reports/report_rfq_enquiry_html.php"><i class="fa fa-list-alt"></i>Customer Request Report</a></li>
							</ul>
						</li>
						<li id="li_order" class="treeview">
							<a>
								<i class="fa fa-file-text"></i> <span> Sales Order</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_new_order"><a href="../html/add_order_html.php"><i class="fa fa-plus"></i> New Order</a></li>
								<li id="li_order_report"><a href="../reports/all_order_report_html.php"><i class="fa fa-list-alt"></i> Order Report</a></li>
								<li id="li_ordered_product_report"><a href="../reports/order_report_accounts.php"><i class="fa fa-list-alt"></i> Order report accounts</a></li>
								<li id="li_ordered_product_report"><a href="../reports/ordered_product_report_html.php"><i class="fa fa-list-alt"></i> Ordered Products Report</a></li>
							</ul>
						</li>

						<li id="li_customer" class="treeview">
							<a>
								<i class="fa fa-user"></i> <span> Customer</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_customers"><a href="../html/add_customer.php"><i class="fa fa-user-plus"></i>  Add Customer</a></li>
								<li id="li_customer_report"><a href="../reports/customer_report_html.php"><i class="fa fa-list-alt"></i> Customer Report</a></li>
								<li id="li_add_project"><a href="../html/add_project_html.php"><i class="fa fa-plus"></i> Add Project</a></li>
								<li id="li_project_report"><a href="../reports/project_report_html.php"><i class="fa fa-list-alt"></i> Project Report</a></li>
							</ul>
						</li>

						<li id="li_product" class="treeview">
							<a>
								<i class="fa fa-product-hunt"></i> <span> Product</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_product_set"><a href="../html/add_product_set_html.php"><i class="fa fa-plus"></i> Add Product Set</a></li>
								<li id="li_product_set_report"><a href="../reports/product_set_report_html.php"><i class="fa fa-list-alt"></i> Product Set Report</a></li>
								<li id="li_add_product"><a href="../html/add_product_html.php"><i class="fa fa-plus"></i> Add Product</a></li>
								<li id="li_product_report"><a href="../reports/product_report_html.php"><i class="fa fa-list-alt"></i> Product Report</a></li>
								<li id="li_add_category"><a href="../html/add_category_html.php"><i class="fa fa-plus"></i> Add Category</a></li>
								<li id="li_category_report"><a href="../reports/category_report_html.php"><i class="fa fa-list-alt"></i> Category Report</a></li>
								<li id="li_add_sub_category"><a href="../html/add_sub_category_html.php"><i class="fa fa-plus"></i> Add Sub Category</a></li>
								<li id="li_sub_category_report"><a href="../reports/sub_category_report_html.php"><i class="fa fa-list-alt"></i> Sub Category Report</a></li>
								<li id="li_add_brand"><a href="../html/add_brand_html.php"><i class="fa fa-plus"></i> Add Brand</a></li>
								<li id="li_brand_report"><a href="../reports/brand_report_html.php"><i class="fa fa-list-alt"></i> Brand Report</a></li>
								<li id="li_add_brand"><a href="../html/add_quick_product_html.php"><i class="fa fa-plus"></i> Add Quick Product</a></li>
								<li id="li_brand_report"><a href="../reports/quick_product_report_html.php"><i class="fa fa-list-alt"></i> Quick Product Report</a></li>
							</ul>
						</li>

						<li id="li_vendor" class="treeview">
							<a>
								<i class="fa fa-users"></i><span> Vendor</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_vendor"><a href="../html/add_vendor_html.php"><i class="fa fa-user-plus"></i> Add Vendor</a></li>
								<li id="li_vendor_report"><a href="../reports/vendor_report_html.php"><i class="fa fa-list-alt"></i> Vendor Report</a></li>
							</ul>
						</li>

						<li id="li_task" class="treeview">
							<a>
								<i class="fa fa-tasks"></i><span> Task</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_task"> <a href="../html/add_task_html.php"><i class="fa fa-plus"></i> Add Task</a></li>
								<li id="li_task_report"><a href="../reports/task_report_html.php"><i class="fa fa-list-alt"></i> Task Report</a></li>
							</ul>
						</li>

						<li id="li_payment" class="treeview">
							<a>
								<i class="fa fa-inr"></i><span> Payment</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_payment"><a href="../html/add_payment_html.php"><i class="fa fa-plus"></i> New Payment</a></li>
								<li id="li_payment_report"><a href="../reports/payment_report_html.php"><i class="fa fa-list-alt"></i> Payment Report</a></li>
							</ul>
						</li>

						<li id="li_transport" class="treeview">
							<a>
								<i class="fa fa-truck"></i><span> Transport</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_transport_team"><a href="../html/add_transport_team_html.php"><i class="fa fa-plus"></i> Add Transport Team</a></li>
								<li id="li_transport_team_report"><a href="../reports/transport_team_report_html.php"><i class="fa fa-list-alt"></i> Transport Team Report</a></li>
							</ul>
						</li>


						<li id="li_sample_management" class="treeview">
							<a>
								<i class="fa fa-book"></i><span> Sample Management</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_sample_log"><a href="../html/sample_log_html.php"><i class="fa fa-plus"></i> Sample Log</a></li>
								<li id="li_sample_log_report"><a href="../reports/sample_report_html.php"><i class="fa fa-list-alt"></i> Sample Report</a></li>
								<li id="li_add_sample_data"><a href="../html/sample_data_html.php"><i class="fa fa-plus"></i>Add Sample Data</a></li>
								<li id="li_sample_data_report"><a href="../reports/sample_data_report_html.php"><i class="fa fa-list-alt"></i> Sample Data Report</a></li>
							</ul>
						</li>

						<li id="li_misc" class="treeview">
							<a>
								<i class="fa fa-archive"></i><span> Misc</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_length_convertor"><a href="../html/length_convertor.php"><i class="fa fa-calculator"></i> Length Convertor</a></li>
								<li id="li_add_key_value"><a href="../html/add_key_value_html.php"><i class="fa fa-list-ul"></i> Add Key Value</a></li>
								<li id="li_key_value_report"><a href="../reports/key_value_report_html.php"><i class="fa fa-list-alt"></i> Key Value Report</a></li>
								<li id="li_add_servicers_installers"><a href="../html/add_servicers_installers.php"><i class="fa fa-list-ul"></i> Add Services & Installers</a></li>
								<li id="li_servicers_installers_report"><a href="../reports/servicers_installers_report_html.php"><i class="fa fa-list-alt"></i> Services & Installers Report</a></li>
							</ul>
						</li>
					</ul>
				</section>
			</aside>';
		}
		else if($user_result['role']=="Operations")
		{
			echo '<aside class="main-sidebar">
				<section class="sidebar">
					<ul class="sidebar-menu">
						<li id="li_dashboard" class="treeview">
							<a href="../html/dashboard.php">
								<i class="fa fa-dashboard"></i><span> Dashboard</span>
								<span class="pull-right-container"></span>
							</a>
						</li>


						<li id="li_daily_operations" class="treeview">
							<a>
								<i class="fa fa-cogs"></i><span> Daily Operations</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_daily_log"><a href="../html/add_daily_log_html.php"><i class="fa fa-plus"></i> Add Daily Log</a></li>
								<li id="li_daily_log_report"><a href="../reports/daily_log_report_html.php"><i class="fa fa-list-alt"></i> Daily Log Report</a></li>
								<li id="li_add_meeting"><a href="../html/add_meeting_html.php"><i class="fa fa-plus"></i> New Meeting</a></li>
								<li id="li_meeting_report"><a href="../reports/meeting_report_html.php"><i class="fa fa-list-alt"></i> Meeting Report</a></li>
							</ul>
						</li>

						<li id="li_enquiry" class="treeview">
							<a>
								<i class="fa fa-list"></i><span> Enquiry</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_sales_lead"><a href="../html/add_sales_lead_html.php"><i class="fa fa-plus"></i> Add Sales Lead</a></li>
								<li id="li_sales_lead_report"><a href="../reports/sales_lead_report_html.php"><i class="fa fa-list-alt"></i> Sales Lead Report</a></li>
								<li id="li_new_enquiry"><a href="../html/add_enquiry_html.php"><i class="fa fa-plus"></i> New Enquiry</a></li>
								<li id="li_enquiry_report"><a href="../reports/enquiry_report_html.php"><i class="fa fa-list-alt"></i> Enquiry Report</a></li>
							</ul>
						</li>
						<li id="li_enquiry_manage" class="treeview">
							<a>
								<i class="fa fa-archive"></i><span> RFQ Enquiry</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_user_enquiry_report"><a href="../reports/report_rfq_enquiry_html.php"><i class="fa fa-list-alt"></i> View RFQ Enquiry</a></li>
							</ul>
						</li>
						<li id="li_order" class="treeview">
							<a>
								<i class="fa fa-file-text"></i> <span> Sales Order</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_new_order"><a href="../html/add_order_html.php"><i class="fa fa-plus"></i> New Order</a></li>
								<li id="li_order_report"><a href="../reports/all_order_report_html.php"><i class="fa fa-list-alt"></i> Order Report</a></li>
								<li id="li_ordered_product_report"><a href="../reports/ordered_product_report_html.php"><i class="fa fa-list-alt"></i> Ordered Products Report</a></li>
							</ul>
						</li>

						<li id="li_customer" class="treeview">
							<a>
								<i class="fa fa-user"></i> <span> Customer</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_customer"><a href="../html/add_customer_html.php"><i class="fa fa-user-plus"></i> Add Customer</a></li>
								<li id="li_customer_report"><a href="../reports/customer_report_html.php"><i class="fa fa-list-alt"></i> Customer Report</a></li>
								<li id="li_add_project"><a href="../html/add_project_html.php"><i class="fa fa-plus"></i> Add Project</a></li>
								<li id="li_project_report"><a href="../reports/project_report_html.php"><i class="fa fa-list-alt"></i> Project Report</a></li>
							</ul>
						</li>

						<li id="li_product" class="treeview">
							<a>
								<i class="fa fa-product-hunt"></i> <span> Product</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_product_set_report"><a href="../reports/product_set_report_html.php"><i class="fa fa-list-alt"></i> Product Set Report</a></li>
								<li id="li_add_product"><a href="../html/add_product_html.php"><i class="fa fa-plus"></i> Add Product</a></li>
								<li id="li_product_report"><a href="../reports/product_report_html.php"><i class="fa fa-list-alt"></i> Product Report</a></li>
								<li id="li_category_report"><a href="../reports/category_report_html.php"><i class="fa fa-list-alt"></i> Category Report</a></li>
								<li id="li_sub_category_report"><a href="../reports/sub_category_report_html.php"><i class="fa fa-list-alt"></i> Sub Category Report</a></li>
								<li id="li_add_brand"><a href="../html/add_brand_html.php"><i class="fa fa-plus"></i> Add Brand</a></li>
								<li id="li_brand_report"><a href="../reports/brand_report_html.php"><i class="fa fa-list-alt"></i> Brand Report</a></li>
								<li id="li_add_brand"><a href="../html/add_quick_product_html.php"><i class="fa fa-plus"></i> Add Quick Product</a></li>
								<li id="li_brand_report"><a href="../reports/quick_product_report_html.php"><i class="fa fa-list-alt"></i> Quick Product Report</a></li>
							</ul>
						</li>

						<li id="li_vendor" class="treeview">
							<a>
								<i class="fa fa-users"></i><span> Vendor</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_vendor"><a href="../html/add_vendor_html.php"><i class="fa fa-user-plus"></i> Add Vendor</a></li>
								<li id="li_vendor_report"><a href="../reports/vendor_report_html.php"><i class="fa fa-list-alt"></i> Vendor Report</a></li>
							</ul>
						</li>

						<li id="li_task" class="treeview">
							<a>
								<i class="fa fa-tasks"></i><span> Task</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_task"> <a href="../html/add_task_html.php"><i class="fa fa-plus"></i> Add Task</a></li>
								<li id="li_task_report"><a href="../reports/task_report_html.php"><i class="fa fa-list-alt"></i> Task Report</a></li>
							</ul>
						</li>

						<li id="li_payment" class="treeview">
							<a>
								<i class="fa fa-inr"></i><span> Payment</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_payment"><a href="../html/add_payment_html.php"><i class="fa fa-plus"></i> New Payment</a></li>
								<li id="li_payment_report"><a href="../reports/payment_report_html.php"><i class="fa fa-list-alt"></i> Payment Report</a></li>
							</ul>
						</li>

						<li id="li_transport" class="treeview">
							<a>
								<i class="fa fa-truck"></i><span> Transport</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_transport_team"><a href="../html/add_transport_team_html.php"><i class="fa fa-plus"></i> Add Transport Team</a></li>
								<li id="li_transport_team_report"><a href="../reports/transport_team_report_html.php"><i class="fa fa-list-alt"></i> Transport Team Report</a></li>
							</ul>
						</li>


						<li id="li_sample_management" class="treeview">
							<a>
								<i class="fa fa-book"></i><span> Sample Management</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_sample_log"><a href="../html/sample_log_html.php"><i class="fa fa-plus"></i> Sample Log</a></li>
								<li id="li_sample_log_report"><a href="../reports/sample_report_html.php"><i class="fa fa-list-alt"></i> Sample Report</a></li>
								<li id="li_add_sample_data"><a href="../html/sample_data_html.php"><i class="fa fa-plus"></i>Add Sample Data</a></li>
								<li id="li_sample_data_report"><a href="../reports/sample_data_report_html.php"><i class="fa fa-list-alt"></i> Sample Data Report</a></li>
							</ul>
						</li>

						<li id="li_misc" class="treeview">
							<a>
								<i class="fa fa-archive"></i><span> Misc</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_length_convertor"><a href="../html/length_convertor.php"><i class="fa fa-calculator"></i> Length Convertor</a></li>
								<li id="li_key_value_report"><a href="../reports/key_value_report_html.php"><i class="fa fa-list-alt"></i> Key Value Report</a></li>
								<li id="li_add_servicers_installers"><a href="../html/add_servicers_installers.php"><i class="fa fa-list-ul"></i> Add Services & Installers</a></li>
								<li id="li_servicers_installers_report"><a href="../reports/servicers_installers_report_html.php"><i class="fa fa-list-alt"></i> Services & Installers Report</a></li>
							</ul>
						</li>
						<li id="li_ledger" class="treeview">
							<a>
								<i class="fa fa-archive"></i><span> Ledger</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_length_convertor"><a href="../html/add_ledger_html.php"><i class="fa fa-plus"></i> Add Ledger</a></li>
								<li id="li_add_key_value"><a href="../html/ledger_report_html.php"><i class="fa fa-list-alt"></i> Ledger Report</a></li>
							</ul>
						</li>
						<li id="li_inventory" class="treeview">
							<a>
								<i class="fa fa-archive"></i><span> Inventory</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_length_convertor"><a href="../html/add_inventory_html.php"><i class="fa fa-plus"></i> Add Inventory</a></li>
								<li id="li_add_key_value"><a href="../html/inventory_report_html.php"><i class="fa fa-list-alt"></i> Ledger Report</a></li>
							</ul>
						</li>
					</ul>
				</section>
			</aside>';
		}
			else if($user_result['role']=="Intern")
		{
			echo '<aside class="main-sidebar">
				<section class="sidebar">
					<ul class="sidebar-menu">

						<li id="li_product" class="treeview">
							<a>
								<i class="fa fa-product-hunt"></i> <span> Product</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_product_set_report"><a href="../reports/product_set_report_html.php"><i class="fa fa-list-alt"></i> Product Set Report</a></li>
								<li id="li_add_product"><a href="../html/add_product_html.php"><i class="fa fa-plus"></i> Add Product</a></li>
								<li id="li_product_report"><a href="../reports/product_report_html.php"><i class="fa fa-list-alt"></i> Product Report</a></li>
								<li id="li_category_report"><a href="../reports/category_report_html.php"><i class="fa fa-list-alt"></i> Category Report</a></li>
								<li id="li_sub_category_report"><a href="../reports/sub_category_report_html.php"><i class="fa fa-list-alt"></i> Sub Category Report</a></li>
								<li id="li_add_brand"><a href="../html/add_brand_html.php"><i class="fa fa-plus"></i> Add Brand</a></li>
								<li id="li_brand_report"><a href="../reports/brand_report_html.php"><i class="fa fa-list-alt"></i> Brand Report</a></li>
							</ul>
						</li>
					</ul>
				</section>
			</aside>';
		}
		else
		{
			echo '
			<aside class="main-sidebar">
				<section class="sidebar">
					<ul class="sidebar-menu">
						<li id="li_dashboard" class="treeview">
							<a href="../html/dashboard.php">
								<i class="fa fa-dashboard"></i><span> Dashboard</span>
								<span class="pull-right-container"></span>
							</a>
						</li>

						<li id="li_daily_operations" class="treeview">
							<a>
								<i class="fa fa-cogs"></i><span> Daily Operations</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_daily_log"><a href="../html/add_daily_log_html.php"><i class="fa fa-plus"></i> Add Daily Log</a></li>
								<li id="li_daily_log_report"><a href="../reports/daily_log_report_html.php"><i class="fa fa-list-alt"></i> Daily Log Report</a></li>
								<li id="li_add_meeting"><a href="../html/add_meeting_html.php"><i class="fa fa-plus"></i> New Meeting</a></li>
								<li id="li_meeting_report"><a href="../reports/meeting_report_html.php"><i class="fa fa-list-alt"></i> Meeting Report</a></li>
							</ul>
						</li>

						<li id="li_enquiry" class="treeview">
							<a>
								<i class="fa fa-list"></i><span> Enquiry</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_sales_lead"><a href="../html/add_sales_lead_html.php"><i class="fa fa-plus"></i> Add Sales Lead</a></li>
								<li id="li_sales_lead_report"><a href="../reports/sales_lead_report_html.php"><i class="fa fa-list-alt"></i> Sales Lead Report</a></li>
								<li id="li_new_enquiry"><a href="../html/add_enquiry_html.php"><i class="fa fa-plus"></i> New Enquiry</a></li>
								<li id="li_enquiry_report"><a href="../reports/enquiry_report_html.php"><i class="fa fa-list-alt"></i> Enquiry Report</a></li>
							</ul>
						</li>

						<li id="li_order" class="treeview">
							<a>
								<i class="fa fa-file-text"></i> <span> Sales Order</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_new_order"><a href="../html/add_order_html.php"><i class="fa fa-plus"></i> New Order</a></li>
								<li id="li_order_report"><a href="../reports/all_order_report_html.php"><i class="fa fa-list-alt"></i> Order Report</a></li>
								<li id="li_ordered_product_report"><a href="../reports/order_report_accounts.php"><i class="fa fa-list-alt"></i> Order report accounts</a></li>
								<li id="li_ordered_product_report"><a href="../reports/ordered_product_report_html.php"><i class="fa fa-list-alt"></i> Ordered Products Report</a></li>
							</ul>
						</li>

						<li id="li_customer" class="treeview">
							<a>
								<i class="fa fa-user"></i> <span> Customer</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_customer"><a href="../html/add_customer_html.php"><i class="fa fa-user-plus"></i> Add Customer</a></li>
								<li id="li_customer_report"><a href="../reports/customer_report_html.php"><i class="fa fa-list-alt"></i> Customer Report</a></li>
								<li id="li_add_project"><a href="../html/add_project_html.php"><i class="fa fa-plus"></i> Add Project</a></li>
								<li id="li_project_report"><a href="../reports/project_report_html.php"><i class="fa fa-list-alt"></i> Project Report</a></li>
							</ul>
						</li>

						<li id="li_product" class="treeview">
							<a>
								<i class="fa fa-product-hunt"></i> <span> Product</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_product_set_report"><a href="../reports/product_set_report_html.php"><i class="fa fa-list-alt"></i> Product Set Report</a></li>
								<li id="li_add_product"><a href="../html/add_product_html.php"><i class="fa fa-plus"></i> Add Product</a></li>
								<li id="li_product_report"><a href="../reports/product_report_html.php"><i class="fa fa-list-alt"></i> Product Report</a></li>
								<li id="li_category_report"><a href="../reports/category_report_html.php"><i class="fa fa-list-alt"></i> Category Report</a></li>
								<li id="li_sub_category_report"><a href="../reports/sub_category_report_html.php"><i class="fa fa-list-alt"></i> Sub Category Report</a></li>
								<li id="li_add_brand"><a href="../html/add_brand_html.php"><i class="fa fa-plus"></i> Add Brand</a></li>
								<li id="li_brand_report"><a href="../reports/brand_report_html.php"><i class="fa fa-list-alt"></i> Brand Report</a></li>
							</ul>
						</li>

						<li id="li_vendor" class="treeview">
							<a>
								<i class="fa fa-users"></i><span> Vendor</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_vendor"><a href="../html/add_vendor_html.php"><i class="fa fa-user-plus"></i> Add Vendor</a></li>
								<li id="li_vendor_report"><a href="../reports/vendor_report_html.php"><i class="fa fa-list-alt"></i> Vendor Report</a></li>
							</ul>
						</li>

						<li id="li_task" class="treeview">
							<a>
								<i class="fa fa-tasks"></i><span> Task</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_task"> <a href="../html/add_task_html.php"><i class="fa fa-plus"></i> Add Task</a></li>
								<li id="li_task_report"><a href="../reports/task_report_html.php"><i class="fa fa-list-alt"></i> Task Report</a></li>
							</ul>
						</li>

						<li id="li_payment" class="treeview">
							<a>
								<i class="fa fa-inr"></i><span> Payment</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_payment"><a href="../html/add_payment_html.php"><i class="fa fa-plus"></i> New Payment</a></li>
								<li id="li_payment_report"><a href="../reports/payment_report_html.php"><i class="fa fa-list-alt"></i> Payment Report</a></li>
							</ul>
						</li>

						<li id="li_transport" class="treeview">
							<a>
								<i class="fa fa-truck"></i><span> Transport</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_add_transport_team"><a href="../html/add_transport_team_html.php"><i class="fa fa-plus"></i> Add Transport Team</a></li>
								<li id="li_transport_team_report"><a href="../reports/transport_team_report_html.php"><i class="fa fa-list-alt"></i> Transport Team Report</a></li>
							</ul>
						</li>


						<li id="li_sample_management" class="treeview">
							<a>
								<i class="fa fa-book"></i><span> Sample Management</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li id="li_sample_log"><a href="../html/sample_log_html.php"><i class="fa fa-plus"></i> Sample Log</a></li>
								<li id="li_sample_log_report"><a href="../reports/sample_report_html.php"><i class="fa fa-list-alt"></i> Sample Report</a></li>
								<li id="li_add_sample_data"><a href="../html/sample_data_html.php"><i class="fa fa-plus"></i>Add Sample Data</a></li>
								<li id="li_sample_data_report"><a href="../reports/sample_data_report_html.php"><i class="fa fa-list-alt"></i> Sample Data Report</a></li>
							</ul>
						</li>

						<li id="li_misc" class="treeview">
							<a>
								<i class="fa fa-archive"></i><span> Misc</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
							<li id="li_length_convertor"><a href="../html/length_convertor.php"><i class="fa fa-calculator"></i> Length Convertor</a></li>

								<li id="li_key_value_report"><a href="../reports/key_value_report_html.php"><i class="fa fa-list-alt"></i> Key Value Report</a></li>
								<li id="li_add_servicers_installers"><a href="../html/add_servicers_installers.php"><i class="fa fa-list-ul"></i> Add Services & Installers</a></li>
								<li id="li_servicers_installers_report"><a href="../reports/servicers_installers_report_html.php"><i class="fa fa-list-alt"></i> Services & Installers Report</a></li>
							</ul>
						</li>
					</ul>
				</section>
			</aside>';
			}
	}
else
{
	echo '
	<aside class="main-sidebar">
			<section class="sidebar">
				<ul class="sidebar-menu">
							<li id="li_order_report"><a href="../reports/all_order_sales_report.php"><i class="fa fa-list-alt"></i> Order Report</a></li>
		</ul>
			</section>
		</aside>';
}

		?>
