<?php
if(isset($_SESSION['user_id']))
{
    header("Location:test/index.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <!--Including Login Session-->
    <?php include "php/session.php";?>
    <!--Including Login Session-->
    <?php include 'dbconnect/dbconnect.php';?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Venue - Responsive Web Template</title>
        
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="img/icon.jpg"/>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/fontAwesome.css">
        <link rel="stylesheet" href="css/hero-slider.css">
        <link rel="stylesheet" href="css/owl-carousel.css">
        <link rel="stylesheet" href="css/datepicker.css">
        <link rel="stylesheet" href="css/templatemo-style.css">

        <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
        <style type="text/css">
            .hidden{
                display: none;
            }
        </style>
<!--    
	Venue Template
	http://www.templatemo.com/tm-522-venue
    --> <?php
            $sql = "SELECT * FROM users where user_id=".$_SESSION['user_id'];
            $result = mysqli_query($conn, $sql);
            $user_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
        ?>
    </head>
<body>
    
     <section class="banner" id="top">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="index.php">
                        <div class="logo">
                            <img src="img/new_logo.png" alt="Venue Logo">
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <ul class="dropdown menu">
                        <li class='active'><a href="#">Home</a></li>
                        <li><a href="#">My Area</a></li>
                        <li><a href="#">knowledge Base</a></li>
                        <li><a href="php/user_logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-right-4">
                    <div class="banner-caption" style="padding: 20px 0px;">
                        <input type="text" class="form-control" placeholder="Search articles">
                        <span>My Area / Submit a Ticket</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
     <section id="blog" class="featured-places">
        <div class="container" id="white_bg">
                <div class="row" >
                    <div class="col-md-12">
                       <form action="upload.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <h3><b>Submit a ticket</b></h3>
                            </div>
                            <div class="form-group">
                                <h3>Ticket Information</h3>
                            </div>
                            <div class="form-group">
                                <label>Department</label>
                            </div>
                            <div class="form-group">
                               <select class="form-control" name="user_department" id="user_department" required>
                                   <option value="pwslab" selected>PWSLab DevOps Support</option>
                                   <option value="isupport">iSupport</option>
                                   <option value="naveena">Naveena</option>
                                   <option value="omjit">omjit</option>
                               </select>
                            </div>
                            <div id="div_hid" class="">
                                <div class="form-group">
                                    <label>Category</label>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" required>
                                         <option value="None" selected>-None-</option>
                                       <option value="pwslab">NEW Project CI/CD Pipeline Setup</option>
                                       <option value="isupport">Update CI/CD Pipeline Configuration</option>
                                       <option value="naveena">DevSecOps Pipeline Setup</option>
                                       <option value="ci/cd_pipline_failure">CI/CD pipeline failure</option>
                                       <option value="automated_deployment_failure">Automated Deployment failure</option>
                                       <option value="docker_and_containers">Docker and Containers</option>
                                       <option value="kubernetes_deployments">Kubernetes Deployments (like EKS/GCP)</option>
                                       <option value="git_source_control">Git Source control</option>
                                       <option value="pwslab_server_not_responding">PWSLab server not responding (502/503 errors)</option>
                                       <option value="pwslab_runner_not_working">PWSLab Runner not working (jobs not running)</option>
                                       <option value="user_managemnet_and_project_access">User management and Project access</option>
                                       <option value="cloud_integration_consultation">Cloud Integration Consultation - AWS/GCP/Azure</option>
                                       <option value="Others">Others</option>
                                   </select>
                                </div>  
                                <div class="form-group">
                                    <label>PWSLab Project URL</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="pwslab_project_url" id="pwslab_project_url" required>
                                </div>
                                <div class="form-group">
                                    <label>Subject</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="pwslab_subject" id="pwslab_subject" required>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                </div>
                                <div class="form-group">
                                   <textarea id="pwslab_description" name="pwslab_description"></textarea>
                                </div> 
                                <div class="form-group">
                                    <h3><b>Contact Details</b></h3>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label>Contact Name</label>
                            </div> 
                            <div class="form-group">
                                <input type="text" class="form-control" name="user_contact_name" id="user_contact_name" value="<?php echo $user_result['user_name'];?>" required>
                            </div> 
                            <div class="form-group">
                                <label>Email</label>
                            </div> 
                            <div class="form-group">
                                <input type="Email" class="form-control" name="user_contact_email" id="user_contact_email" value="<?php echo $user_result['user_email'];?>" required>
                            </div> 
                            <div class="form-group">
                                <label>Phone</label>
                            </div> 
                            <div class="form-group">
                                <input type="number" class="form-control" name="user_contact_number" id="user_contact_number" value="<?php echo $user_result['user_mobile'];?>" required>
                            </div> 
                            <div class="form-group">
                                <h3><b>Additional Information</b></h3>
                            </div> 
                            <div class="form-group">
                                <label>Priority</label>
                            </div>
                            <div class="form-group">
                                <select class="form-control" required>
                                   <option value="none" selected>-None-</option>
                                   <option value="high">High - Production System Down</option>
                                   <option value="medium">Medium - System Impaired</option>
                                   <option value="low">Low - General Guidance</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>   
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>  
                        </form>
                    </div>
                </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="about-veno">
                        <div class="logo">
                            <img src="img/new_logo.png" alt="Venue Logo">
                        </div>
                        <p>Mauris sit amet quam congue, pulvinar urna et, congue diam. Suspendisse eu lorem massa. Integer sit amet posuere tellus, id efficitur leo. In hac habitasse platea dictumst.</p>
                        <ul class="social-icons">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-rss"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="useful-links">
                        <div class="footer-heading">
                            <h4>Useful Links</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li><a href="#"><i class="fa fa-stop"></i>Help FAQs</a></li>
                                    <li><a href="#"><i class="fa fa-stop"></i>Register</a></li>
                                    <li><a href="#"><i class="fa fa-stop"></i>Login</a></li>
                                    <li><a href="#"><i class="fa fa-stop"></i>My Profile</a></li>
                                    <li><a href="#"><i class="fa fa-stop"></i>How It Works?</a></li>
                                    <li><a href="#"><i class="fa fa-stop"></i>More About Us</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li><a href="#"><i class="fa fa-stop"></i>Our Clients</a></li>
                                    <li><a href="#"><i class="fa fa-stop"></i>Partnerships</a></li>
                                    <li><a href="#"><i class="fa fa-stop"></i>Blog Entries</a></li>
                                    <li><a href="#"><i class="fa fa-stop"></i>Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contact-info">
                        <div class="footer-heading">
                            <h4>Contact Information</h4>
                        </div>
                        <p>Praesent iaculis gravida elementum. Proin fermentum neque facilisis semper pharetra. Sed vestibulum vehicula tincidunt.</p>
                        <ul>
                            <li><span>Phone:</span><a href="#">010-050-0550</a></li>
                            <li><span>Email:</span><a href="#">hi@peerxp.com</a></li>
                            <li><span>Address:</span><a href="#">peerxp.cp</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="sub-footer">
        <p>Copyright &copy; 2018 Company Name 
    
    	- Design: <a rel="nofollow" href="#">Gaurav Sharma</a></p>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="js/vendor/bootstrap.min.js"></script>
    
    <script src="js/datepicker.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
     <script>
        CKEDITOR.replace( 'pwslab_description' );
       $('#user_department').on('change', function(){
            var txt = $(this).val();
            if(txt=='pwslab'){
                $('#div_hid').removeClass('hidden');
            }
            else if(txt=='isupport'){
                $('#div_hid').addClass('hidden');
            }
            else if(txt=='naveena'){
                $('#div_hid').addClass('hidden');
            }
            else if(txt=='omjit'){
                $('#div_hid').addClass('hidden');
            }
            else{
                $('#div_hid').addClass('hidden');
            }
           
        });
    </script>
</body>
</html>