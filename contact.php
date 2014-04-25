<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');

	$title = "Contact CenterPointe Wealth Management. Wichita, KS";
	$description = "Please contact CenterPointe Wealth Management with any questions you may have about your financial plans and needs.";
	$specificKeywords = "Contact, email";
?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->

<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
 
 
	<?php include"./inc/inc.metaData.php"?>
	
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
	
<!--==========================================================
====================// STYLE SHEETS //========================
===========================================================-->

	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<link rel="stylesheet" href="css/layout.css">
	<!-- TypeKit -->
	<script type="text/javascript" src="//use.typekit.net/vyk8tmp.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<script src="js/analytics.js"></script></head>
<body>
	

	
		
		<header>
			<div id="masthead">
				<?php include("./inc/inc.mainNav.php");?>
			</div>
		</header>
	
		<div role="main" id="main" class="container">
			<div class="sixteen columns">
				<div class="nine columns offset-by-one alpha">
					<h1>CONTACT</h1>
					<hr/>				
				
					<form name="CPWMform" id="CPWMform" method="post" action="./inc/inc.mailProcess.php">
						<label for="fname">*First Name:</label>
							<input type="text" name="fname" id="fname">
						<label for="lname">*Last Name:</label>
							<input type="text" name="lname" id="lname">
						<label for="userPhone">*Phone Number:</label>
							<input type="tel" name="userPhone" id="userPhone">
						<label for="userEmail">*Email Address:</label>
							<input type="email" name="userEmail" id="userEmail">
	
						<label for="services">*What Advisory Services can we assist you with:</label>
						<small>(check all that apply)</small><br/>
						<div id="checks">
							<input type="checkbox" name="Investment Services" id="investment" class="services" value="Investment Services">Investment Services</br>
							<input type="checkbox" name="Retirement Services" id="retirement" class="services" value="Retirement Services">Retirement Services</br>
							<input type="checkbox" name="Estate Planning" id="estate" class="services" value="Estate Planning">Estate Planning</br><br/>
						</div>
						<label for="contactTime">*When is it best to contact you?</label>
							<select name="contactTime" id="contactTime">
								<option value="Anytime">Anytime</option>
								<option value="Week days between 8am - 12pm">Week days between 8am - 12pm</option>
								<option value="Week days between 12pm - 5pm">Week days between 12pm - 5pm</option>
								<option value="Week days between 5pm - 7pm">Week days between 5pm - 7pm</option>
								<option value="Weekends">Weekends</option>
							</select>
							<input type="submit" name="CPWMsubmit" id="CPWMsubmit" value="Send To CenterPointe">						
					</form>
					
				</div>
				<aside class="five columns offset-by-one omega">
					<?php include("./inc/inc.aside.php")?>
				</aside>
			</div>
		</div>
		
		<div id="fullPgBanner" class="container">
			<div class="sixteen columns">
			</div>
		</div>
		
		<footer class="container">
			<?php include("./inc/inc.footer.php");?>
		</footer>
	
	
	
	<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>
	<script src="./js/libs/jquery.validate.js"></script>
	<script src="http://malsup.github.com/jquery.form.js"></script>
	
	<script src="js/plugins.js"></script>
	<script src="js/script.js"></script>
		
	<script>
	$(document).ready(function(){
		var contactData = {};
		var services = {};
		
		
		$("#CPWMform").validate(
				
				{
  				debug:true,
  				rules:{
  							fname:"required",
							lname:"required",
							userPhone:"required",
							userEmail:"required",
							services:"required",
							contactTime:"required",
					email:
						{
							required:true,
							email:true
						},
						
							
						
					messages: 
						{	
							fname: "Please enter your first name.",
							lname: "Please enter your last name.",
							userEmail: 
								{
									required: "Please enter your email",
									email: "Email format: name@emailprovider.com."
								 },
							userPhone: "Please enter your phone number.",
							services: "What services are you interested in?",
							contactTime: "Let us know when you get in touch with you."
						}
					},
  				submitHandler: function(form) 
  					{			
  							
  							// Cycles through all checkboxes in #checks //
  							// & determined if it is checked.           // 
  							$("#checks input:checkbox").each(function(){
  								var num = 1;	
  								if ($(this).is(':checked')) {
  									var value = $(this).val();
 									var id = $(this).attr("id");
 									services[id] = value;
 									
 								} 
  							});
  							console.log(services);
							contactData.jsData = true;
							contactData.fname = $("#fname").val();
							contactData.lname = $("#lname").val();
							contactData.email = $("#userEmail").val();
							contactData.phone = $("#userPhone").val();
							contactData["services"] = services;
							contactData.contactTime = $("#contactTime").val();  						
	   						//$("#CPWMform").ajaxSubmit(validateOptions);
   							$.ajax({
   									type:"POST",
									url:"process.php",
   									data: {
   											contactData:contactData,
   											services:services
   											},
   									success:function(data){
											//console.log(contactData.fname+" "+contactData.fname);
											console.log(data);	
											},
									error: function(data){console.log("you suck");}
							});
   							console.log("clicked");
   							//console.log(contactData);
  					}
  			
				
		});
				
				
				
			

	});
	</script>
	
</body>
</html>