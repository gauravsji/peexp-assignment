<!--
Description: This page helps user using this system.
Date: 04/07/2017
-->
<!DOCTYPE html>
<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";?>
	<!--Including Login Session-->

	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap CSS links-->
	</head>

	<body data-spy="scroll" class="hold-transition skin-blue fixed sidebar-mini">
		<div class="wrapper">
			<!--Including Topbar-->
			<?php include "../extra/topbar.php";?>
			<!--Including Topbar-->

			<!-- Left Side Panel Which Contains Navigation Menu -->
			<?php include "../extra/left_nav_bar.php";?>
			<!-- Left Side Panel Which Contains Navigation Menu -->

			<div class="content-wrapper">
				<section class="content-header">
					<h1>
						<center>
							Smartstorey Internal Operation Management Documentation
							<small>Dated 01/07/2017</small>
						</center>
					</h1>
				</section>

				<section class="content body">
					<div class="row">
						<div class="col-md-12">
							<div class="">
								<div class="box-body pad">
									<section id="introduction">
										<h2 class="page-header"><a href="#introduction">Introduction</a></h2>
										<p class="lead">
											<b>Smartstorey Internal Operation Management</b> is a webapp developed using AdminLTE Template. Developed using HTML5, PHP5, jQuery, Javascript and MySQLi (Relational Database).
											It is a responsive HTML template that is based on the CSS framework Bootstrap 3.
											It utilizes all of the Bootstrap components in its design and re-styles many
											commonly used plugins to create a consistent design that can be used as a user
											interface for backend applications. It is based on a modular design, which
											allows it to be easily customized and built upon.
										</p>				
									</section>
									
									<section id="advice">
										<h2 class="page-header" align="center"><a href="#advice">Modules</a></h2>
										<h4>
											<b>DASHBOARD:</b> 
											Dashboard a user interface that, organizes and presents information in a way that is easy to read. It displays the brief details of the order status, tasks, vendors available, customer information etc. 
										</h4> 
										<hr>
										<h4>
											<b>DAILY OPERATIONS:</b> 
											Daily Operations is a module used to add data which is important in any way to the company, which also helps in recollecting the memories and is useful in passing the information to other users using the system.
										</h4> 
										<hr>
										<h4>
											<b>ENQUIRY:</b> 
											Enquiry module has 2 sub-modules namely Sales Lead and Enquiry Management, Sales Lead is one who has enquired some material with Smartstorey and might be a possible customer in future, until the person places some order he is so-called Sales Lead, once he orders some material with Smartstorey he is called Customer. The other sub-module Enquiry management manages enquiry information to the system so that it can be worked upon efficiently to find the material required at best price and best profit.It is also useful in sending Estimation of Material price to the Vendors.
										</h4> 
										<hr> 
										<h4>
											<b>ORDER:</b> 
											Order module manages the confirmed order details from the customer to the system, it helps Smartstorey manage the orders in a better way and is useful in tracking the data of the materials sold. It is also useful in sending Purchase orders to the Vendors.
										</h4> 
										<hr>

										<h4>
											<b>CUSTOMER:</b> 
											Customer module is used to capture customer related information such as contact information, projects, payments etc
										</h4> 
										<hr>

										<h4>
											<b>PRODUCT:</b> 
											Product module contains many sub-modules such as category, sub-category, product set, product, brand. These modules are used to manage the description of the products, what attributes a particular product holds, etc. Category is a class or division of items sold from our company regarded as having particular shared characteristics, Ex: Flooring. Then there is sub-category which contains the next subsection under a particular category Ex: Wooden Flooring. Now coming to Product set it is a module in which we can describe or give meaning to a particular product Ex: Laminated Wooden Flooring, Now the main part the product. Product is the highest form of data. Here we select the attributes defined in product set and get a particular product with particular brand or Unbranded option.
										</h4> 
										<hr>
										<h4>
											<b>VENDOR:</b> 
											Vendor module is used to capture vendor related information such as contact information, product pricing, payments etc.
										</h4> 
										<hr>
										<h4>
											<b>TASK:</b> 
											Task module is used to assign some particular task to a other user or to ourselves in order to make a reminder so that the user isn't in an Oblivion. 
										</h4> 
										<hr>
										<h4>
											<b>PAYMENT:</b> 
											Payment module is used to track the payments recieved from customers and payments made to the vendors. 
										</h4> 
										<hr>
										<h4>
											<b>TRANSPORT:</b> 
											Transport module is used to manage the information of logistics and the people involved. 
										</h4> 
										<hr>
										<h4>
											<b>SAMPLE MANAGEMENT:</b> 
											Sample Management is used to manage information concerning to the samples and catalogues recieved from the vendors, the samples or catalogues given to customers for the material selection. 
										</h4> 
										<hr>
										<h4>
											<b>MISC:</b> 
											Misc contains form to add key values such as tax, attributes, unit of measurement to the system, it also has a length convertor and a calculator for day to day use. Also there is a form used to add information pertaining to service providers and installers 
										</h4> 
										<hr>
									</section>
									
									<section id="download">
										<h2 class="page-header"><a href="#download">Download Original Template</a></h2>
										<p class="lead">
										The Original Template used for development can be downloaded in two different versions, each appealing to different skill levels and use case.
										</p>
										<div class="row">
											<div class="col-sm-6">
												<div class="box box-primary">
													<div class="box-header with-border">
														<h3 class="box-title">Ready</h3>
														<span class="label label-primary pull-right"><i class="fa fa-html5"></i></span>
													</div><!-- /.box-header -->
													<div class="box-body">
														<p>Compiled and ready to use in production. Download this version if you don't want to customize</p>
														<a href="http://almsaeedstudio.com/download/AdminLTE-dist" class="btn btn-primary"><i class="fa fa-download"></i> Download</a>
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="box box-danger">
													<div class="box-header with-border">
														<h3 class="box-title">Source Code</h3>
														<span class="label label-danger pull-right"><i class="fa fa-database"></i></span>
													</div>
													<div class="box-body">
														<p>All files including the compiled CSS. Download this version if you plan on customizing the template.</p>
														<a href="http://almsaeedstudio.com/download/AdminLTE" class="btn btn-danger"><i class="fa fa-download"></i> Download</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

			<!-- Main Footer -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs"></div>				
			</footer>
			<!-- Main Footer -->

			<!--Including right slide panel-->
			<?php include "../extra/aside.php";?>
			<!--Including right slide panel-->

			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>

		<!--Including Bootstrap and other scripts-->
		<?php include "../extra/footer.html";?>
		<!--Including Bootstrap and other scripts-->
	</body>	
</html>