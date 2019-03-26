<!-- Control Sidebar -->
<aside id="sidebar" class="control-sidebar control-sidebar-dark">
	<!-- Create the tabs -->
	<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
		<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
		<li><a href="#control-sidebar-stats-tab" data-toggle="tab"><i class="fa fa-rss"></i></a></li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<!-- Home tab content -->
		<div class="tab-pane active" id="control-sidebar-home-tab">
			<h3 align="center" class="control-sidebar-heading">Notifications</h3>
		
		
		<ul class="control-sidebar-menu">
				<?php 
					$sql = "SELECT
							a.activity_log_id,a.module_id,a.activity_message,a.activity_by,a.activity_date_time, u.name,
							CASE a.module_name
								WHEN 'Customer' THEN (Select customer_name from customer where customer_id = a.module_id and delete_status<>1)								
								WHEN 'Users' THEN (Select name from users where id = a.module_id)
								WHEN 'Vendor' THEN (Select vendor_name from vendor where vendor_id = a.module_id and delete_status<>1)
								WHEN 'Brand' THEN (Select brand_name from brand where brand_id = a.module_id and delete_status<>1)
								WHEN 'Category' THEN (Select category_name from category where category_id = a.module_id and delete_status<>1)
								WHEN 'Payment' THEN (Select payment_transaction_ref_no from payment where payment_id = a.module_id and delete_status<>1)
								WHEN 'Product' THEN (Select product_name from product where product_id = a.module_id and delete_status<>1)
								WHEN 'Product Set' THEN (Select product_set_product_name from product_set where product_set_id = a.module_id and delete_status<>1)
								WHEN 'Sales Lead' THEN (Select sales_lead_name from sales_lead where sales_lead_id = a.module_id and delete_status<>1)
								WHEN 'Order' THEN (Select order_brief_details from ss_order where order_id = a.module_id and delete_status<>1)
								WHEN 'Task' THEN (Select task_name from task where task_id = a.module_id and delete_status<>1)
								WHEN 'Enquiry' THEN (Select enquiry_name from enquiry where enquiry_id = a.module_id and delete_status<>1)	
							ELSE NULL
							END as 'description',
							CASE a.module_name
								WHEN 'Customer' THEN (Select 'view_customer_html' from dual)							
								WHEN 'Users' THEN (Select 'dashboard' from dual)
								WHEN 'Vendor' THEN (Select 'view_vendor_html' from dual)
								WHEN 'Brand' THEN (Select 'view_brand_html' from dual)
								WHEN 'Category' THEN (Select 'view_category_html' from dual)
								WHEN 'Payment' THEN (Select 'view_payment_html' from dual)
								WHEN 'Product' THEN (Select 'view_product_html' from dual)
								WHEN 'Product Set' THEN (Select 'view_product_set_html' from dual)
								WHEN 'Sales Lead' THEN (Select 'view_sales_lead_html' from dual)
								WHEN 'Order' THEN (Select 'view_order_html' from dual)
								WHEN 'Enquiry' THEN (Select 'view_enquiry_html' from dual)							
								WHEN 'Task' THEN (Select 'view_task_html' from dual)									
							ELSE NULL
							END as 'source'
							FROM
							activity_log a , users u where a.activity_by=u.id order by a.activity_date_time desc LIMIT 250";
							
					$result = mysqli_query($conn,$sql);					
					while ($row = mysqli_fetch_array($result)) 
					{
						
						$db_timestamp=$row["activity_date_time"];
						$db_timestamp = date("d-m-Y", strtotime($db_timestamp));
						
					
						if ($row['source']!='dashboard'  && $row['source']!='view_customer_html' && $row['source']!='view_vendor_html' && $row['source']!='view_brand_html' && $row['source']!='view_category_html' && $row['source']!='view_payment_html' && $row['source']!='view_product_html' && $row['source']!='view_product_set_html' && $row['source']!='view_sales_lead_html' )
						{
						echo '<li>
						<a href="../html/'.$row['source'].'.php?id='. $row['module_id'].'">			
						<div class="menu-info">
						<h5 class="control-sidebar-subheading">';
						echo $row['activity_message']."-".$row['module_id'];
						
						echo '</h5><p>';							
						$date_local=date_create(date("d-m-Y"));
						$date_local =  date_format($date_local,"d-m-Y");		
					
						 						
						 if($db_timestamp < $date_local)
						 {
							 echo "on ".$db_timestamp;
						 }
						 else
						 {
							 echo "Today";
						 }		 		
							echo " by ";
						echo $row['name']." for ".$row['description'];

						echo '</p>
						</div>
						</a>
						</li>';
						}						
					}
				?>				
			</ul>			
		</div>
		<!-- /.tab-pane -->
		<!-- Stats tab content -->
		<div class="tab-pane" id="control-sidebar-stats-tab">
		<h3 align="center" class="control-sidebar-heading">Feed</h3>
		<ul class="control-sidebar-menu">
				<?php 
					$sql = "SELECT
							a.activity_log_id,a.module_id,a.activity_message,a.activity_by,a.activity_date_time, u.name,
							CASE a.module_name
								WHEN 'Customer' THEN (Select customer_name from customer where customer_id = a.module_id and delete_status<>1)								
								WHEN 'Users' THEN (Select name from users where id = a.module_id)
								WHEN 'Vendor' THEN (Select vendor_name from vendor where vendor_id = a.module_id and delete_status<>1)
								WHEN 'Brand' THEN (Select brand_name from brand where brand_id = a.module_id and delete_status<>1)
								WHEN 'Category' THEN (Select category_name from category where category_id = a.module_id and delete_status<>1)
								WHEN 'Payment' THEN (Select payment_transaction_ref_no from payment where payment_id = a.module_id and delete_status<>1)
								WHEN 'Product' THEN (Select product_name from product where product_id = a.module_id and delete_status<>1)
								WHEN 'Product Set' THEN (Select product_set_product_name from product_set where product_set_id = a.module_id and delete_status<>1)
								WHEN 'Sales Lead' THEN (Select sales_lead_name from sales_lead where sales_lead_id = a.module_id and delete_status<>1)
								WHEN 'Order' THEN (Select order_brief_details from ss_order where order_id = a.module_id and delete_status<>1)
								WHEN 'Task' THEN (Select task_name from task where task_id = a.module_id and delete_status<>1)
								WHEN 'Enquiry' THEN (Select enquiry_name from enquiry where enquiry_id = a.module_id and delete_status<>1)					
							ELSE NULL
							END as 'description',
							CASE a.module_name								
								WHEN 'Customer' THEN (Select 'view_customer_html' from dual)							
								WHEN 'Users' THEN (Select 'dashboard' from dual)
								WHEN 'Vendor' THEN (Select 'view_vendor_html' from dual)
								WHEN 'Brand' THEN (Select 'view_brand_html' from dual)
								WHEN 'Category' THEN (Select 'view_category_html' from dual)
								WHEN 'Payment' THEN (Select 'view_payment_html' from dual)
								WHEN 'Product' THEN (Select 'view_product_html' from dual)
								WHEN 'Product Set' THEN (Select 'view_product_set_html' from dual)
								WHEN 'Sales Lead' THEN (Select 'view_sales_lead_html' from dual)
								WHEN 'Order' THEN (Select 'view_order_html' from dual)
								WHEN 'Enquiry' THEN (Select 'view_enquiry_html' from dual)							
								WHEN 'Task' THEN (Select 'view_task_html' from dual)	
							ELSE NULL
							END as 'source'
							FROM
							activity_log a , users u where a.activity_by=u.id order by a.activity_date_time desc LIMIT 250";
							
					$result = mysqli_query($conn,$sql);					
					while ($row = mysqli_fetch_array($result)) 
					{
						
						$db_timestamp=$row["activity_date_time"];
						$db_timestamp = date("d-m-Y", strtotime($db_timestamp));
						
					
						if($row['source']=='dashboard' && $user_result['role']=='Admin')
						{
							echo '<li>
							<a href="#">			
							<div class="menu-info">
							<h5 class="control-sidebar-subheading">';
							echo $row['activity_message'];
							echo "</h5><p> at ".$row["activity_date_time"];
							echo '</p>
						</div>
						</a>
						</li>';
						}
						else if ($row['source']!='dashboard' && $row['source']!='view_enquiry_html' && $row['source']!='view_order_html' && $row['source']!='view_task_html')
						{
						echo '<li>
						<a href="../html/'.$row['source'].'.php?id='. $row['module_id'].'">			
						<div class="menu-info">
						<h5 class="control-sidebar-subheading">';
						echo $row['activity_message']."-".$row['module_id'];
						
						echo '</h5><p>';							
						$date_local=date_create(date("d-m-Y"));
						$date_local =  date_format($date_local,"d-m-Y");		
					
						 						
						 if($db_timestamp < $date_local)
						 {
							 echo "on ".$db_timestamp;
						 }
						 else
						 {
							 echo "Today";
						 }		 		
							echo " by ";
						echo $row['name']." for ".$row['description'];

						echo '</p>
						</div>
						</a>
						</li>';
						}					
					}
				?>			
			</ul>		
		</div>
		<!-- /.tab-pane -->

	</div>
</aside>
<!-- /.control-sidebar -->