<!DOCTYPE html>
<html>
    <head>
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
<!--
	Venue Template
	http://www.templatemo.com/tm-522-venue
-->
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
                        <li><a class="scrollTo" data-scrollTo="blog" href="#">My Area</a></li>
                        <li><a class="scrollTo" data-scrollTo="services" href="#">knowledge Base</a></li>
                        <li><a class="scrollTo" data-scrollTo="contact" href="#">Sign In</a></li>
                        <li><a class="scrollTo" data-scrollTo="contact" href="#">Sign Up</a></li>
                        <li><a class="scrollTo" data-scrollTo="contact" href="#">A+</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row banner-caption">
                <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="Search articles">
                </div>
                <div class="col-md-3">
                    <div class="blue-button">
                        <a class="scrollTo" data-scrollTo="popular" href="#">Add Ticket</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="blog" class="featured-places">
        <div class="container" id="white_bg">
            <div class="row" >
                <div class="col-md-6">
                    <form action="php/user_login.php" method="POST" accept-charset="utf-8">
                        <div class="form-group">
                            <label>Already a member?</label>    
                        </div>
                        <div class="form-group">
                            <span>Sign In</span> 
                        </div>
                        <div class="form-group">
                            <input class="inputBox form-control" type="text" name="login_user_email" id="login_user_email" placeholder="Email Address" autofocus="">
                        </div>
                        <div class="form-group">
                            <input class="inputBox form-control" type="password" name="login_user_password" id="login_user_password" placeholder="Password">
                        </div>  
                        <div class="form-group">
                            <dd class="checkBox">
                                <label class="rememberMe">
                                    <input type="checkbox" name="sremember" value="true"> Remember me
                                </label>
                            </dd>
                        </div>
                           <div class="form-group">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>  
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <img src="img/avatar.png" style="float:left;width:42px;height:42px;">
                        <h5>New User? <a href="sign_up.php">Sign Up</a></h5>
                        <span>Create an account to submit tickets, read articles and engage in our community.</span>
                    </div>  
                     <div class="form-group">
                         <img src="img/lock.png" style="float:left;width:42px;height:42px;">
                         <h5>Forgot Password? <a href="forget_password.php">Reset</a></h5>
                        <span>We will send a password reset link to your email address.</span>
                    </div>  
                     <div class="form-group">
                         <img src="img/agent.png" style="float:left;width:42px;height:42px;">
                         <h5>Are you an Agent? <a href="https://support.peerxp.com/support/peerxp/ShowHomePage.do">Log in here</a></h5>
                        <span>You will be taken to the agent interface.</span>
                    </div>  
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
</body>
</html>