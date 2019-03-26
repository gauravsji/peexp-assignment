<html>
	<!--Including Login Session-->
	<?php include "../extra/session.php";?>
	<!--Including Login Session-->
	
	<head>
		<!--Including Bootstrap CSS links-->
		<?php include "../extra/header.html";?>
		<!--Including Bootstrap CSS links-->
	</head>

	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<!--Including Topbar-->
			<?php include "../extra/topbar.php";?>
			<!--Including Topbar-->
			
			
		<!--Including Left Nav Bar-->
		<?php include "../extra/left_nav_bar.php";?>
		<!--Including Left Nav Bar-->
		
		
		
			<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
		<div class="container">
				<!-- Main content -->
    <section class="content">
      <div class="error-page">
        
        <div class="content">
		<h1 class="headline text-red">Development In Progress, Sorry for the inconvenience</h1>
			<!--Additional Info-->
			<div class="form-group col-md-12">
				<textarea class="form-control" rows="5" id="error" name="error" ><?php echo $_SESSION['error']; ?></textarea>
			</div>
			<?php unset($_SESSION['errMsg']); ?>
			<!--Additional Info-->
          <h3><i class="fa fa-warning text-red"></i>&nbsp;The problem with troubleshooting is that trouble shoots back.</h3>
          <p>
            We will work on fixing that right away.
            Meanwhile, you may <a href="../html/dashboard.php">return to dashboard</a> 
          </p>

        </div>
      </div>
      <!-- /.error-page -->

    </section>
			</div>
		
		</div>
		<!-- /.content-wrapper -->
			
		</div>
	</body>

	<!--Including Bootstrap and other scripts-->
	<?php include "footer.html";?>
	<!--Including Bootstrap and other scripts-->
</html>