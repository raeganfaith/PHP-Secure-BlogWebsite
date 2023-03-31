<?php
require 'config/database.php';

//fetch current user from database
if (isset($_SESSION['user-id'])) {
	$id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
	$query = "SELECT username FROM tblAccounts WHERE id=$id";
	$result = mysqli_query($connection, $query);
	$username = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Security-Policy" content="default-src 'self' cdn.jsdelivr.net 'unsafe-inline';">

    	<title>PawTalk</title>

		<link rel="icon" href="./images/white-logo.png">
    	<!-- To automatically reload css on php-->
		<link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
		<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

    	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top px-3">
		<div class="container-fluid">
			<a href="index.php"><img src="images/white-logo.png" alt="" class="nav-logo"></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mx-auto">
					<li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">All</a></li>
					<li class="nav-item"><a class="nav-link" href="acads.php">Academics</a></li>
					<li class="nav-item"><a class="nav-link" href="blockmates.php">Blockmates</a></li>
					<li class="nav-item"><a class="nav-link" href="profs.php">Professors</a></li>
					<li class="nav-item"><a class="nav-link" href="faci.php">Facilities</a></li>
				</ul>
				<?php if (isset($_SESSION['user-id'])) : ?>
					<div class="nav-item dropdown">
						<a class="nav-link p-0 dropdown-toggle text-white" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<?php echo $username['username']; ?>
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="logout.php">Logout</a></li>
						</ul>
					</div>
				<?php else : ?>
					<a href="<?= ROOT_URL ?>signin.php"><button class="btn btn-outline-light px-4">Sign In</button></a>
				<?php endif ?>
			</div>
		</div>
	</nav>
	<header class="masthead">
		<div class="container h-100" id="up">
			<div class="row h-100 align-items-center">
				<div class="col-12 text-center pt-5 mt-5">
					<h1 class="text-white text-uppercase"><strong>Disclaimer</strong></h1>
				</div>
			</div>
		</div>
	</header>
    <section class="py-5">
    <div class = "container pr-lg-5 pl-lg-5">
        <p>Last updated: 2023-01-22</p>
        <p><b>WEBSITE DISCLAIMER</b></p>
        <p>The information provided by <b>PawTalk</b> (“Company”, “we”, “our”, “us”) on <b>pawtalk.com</b> (the “Site”) is for general informational purposes only. All information on the Site is provided in good faith, however we make no representation or warranty of any kind, express or implied, regarding the accuracy, adequacy, validity, reliability, availability, or completeness of any information on the Site.</p>
        <p>UNDER NO CIRCUMSTANCE SHALL WE HAVE ANY LIABILITY TO YOU FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF THE USE OF THE SITE OR RELIANCE ON ANY INFORMATION PROVIDED ON THE SITE. YOUR USE OF THE SITE AND YOUR RELIANCE ON ANY INFORMATION ON THE SITE IS SOLELY AT YOUR OWN RISK.</p>
        <p><b>EXTERNAL LINKS DISCLAIMER</b></p>
        <p>The Site may contain (or you may be sent through the Site) links to other websites or content belonging to or originating from third parties or links to websites and features. Such external links are not investigated, monitored, or checked for accuracy, adequacy, validity, reliability, availability or completeness by us.</p>
        <p>WE DO NOT WARRANT, ENDORSE, GUARANTEE, OR ASSUME RESPONSIBILITY FOR THE ACCURACY OR RELIABILITY OF ANY INFORMATION OFFERED BY THIRD-PARTY WEBSITES LINKED THROUGH THE SITE OR ANY WEBSITE OR FEATURE LINKED IN ANY BANNER OR OTHER ADVERTISING. WE WILL NOT BE A PARTY TO OR IN ANY WAY BE RESPONSIBLE FOR MONITORING ANY TRANSACTION BETWEEN YOU AND THIRD-PARTY PROVIDERS OF PRODUCTS OR SERVICES.</p>
        <p><b>PROFESSIONAL DISCLAIMER</b></p><p>The Site can not and does not contain legal advice. The information is provided for general informational and educational purposes only and is not a substitute for professional legal advice. Accordingly, before taking any actions based upon such information, we encourage you to consult with the appropriate professionals. We do not provide any kind of legal advice.</p> <p>Content published on pawtalk.com is intended to be used and must be used for informational purposes only. It is very important to do your own analysis before making any decision based on your own personal circumstances. You should take independent legal advice from a professional or independently research and verify any information that you find on our Website and wish to rely upon. </p><p>THE USE OR RELIANCE OF ANY INFORMATION CONTAINED ON THIS SITE IS SOLELY AT YOUR OWN RISK.</p>
        
        <p><b>TESTIMONIALS DISCLAIMER</b></p><p>The Site may contain testimonials by users of our products and/or services. These testimonials reflect the real-life experiences and opinions of such users. However, the experiences are personal to those particular users, and may not necessarily be representative of all users of our products and/or services. We do not claim, and you should not assume that all users will have the same experiences.</p> <p>YOUR INDIVIDUAL RESULTS MAY VARY.</p> <p>The testimonials on the Site are submitted in various forms such as text, audio and/or video, and are reviewed by us before being posted. They appear on the Site verbatim as given by the users, except for the correction of grammar or typing errors. Some testimonials may have been shortened for the sake of brevity, where the full testimonial contained extraneous information not relevant to the general public.</p> <p>The views and opinions contained in the testimonials belong solely to the individual user and do not reflect our views and opinions.</p>
        <p><b>ERRORS AND OMISSIONS DISCLAIMER</b></p>
        <p>While we have made every attempt to ensure that the information contained in this site has been obtained from reliable sources, PawTalk is not responsible for any errors or omissions or for the results obtained from the use of this information. All information in this site is provided “as is”, with no guarantee of completeness, accuracy, timeliness or of the results obtained from the use of this information, and without warranty of any kind, express or implied, including, but not limited to warranties of performance, merchantability, and fitness for a particular purpose.</p> <p>In no event will PawTalk, its related partnerships or corporations, or the partners, agents or employees thereof be liable to you or anyone else for any decision made or action taken in reliance on the information in this Site or for any consequential, special or similar damages, even if advised of the possibility of such damages.</p>
        
        <p><b>LOGOS AND TRADEMARKS DISCLAIMER</b></p>
        <p>All logos and trademarks of third parties referenced on pawtalk.com are the trademarks and logos of their respective owners. Any inclusion of such trademarks or logos does not imply or constitute any approval, endorsement or sponsorship of PawTalk by such owners.</p>
        <p><b>CONTACT US</b></p>
        <p>Should you have any feedback, comments, requests for technical support or other inquiries, please contact us by email: <b>support@pawtalk.com</b>.</p>
    </div>
    </section>
    </body> 
	<footer id="footer" class="footer mt-5">
		<div class="footer-top">
			<div class="container">
				<div class="row g-6 pb-5">
					<div class="col-lg-12">
					<div class = "row pt-4">
						<div class="up-icon-container">
            				<a href="#up">
            				  <img class="up-icon" src="images/up-btn.png" style="height: 60px; width: 60px; float:right;">
            				</a>
          				</div>		
					</div>
					<div class="row  pt-5">
					<div class="col-lg-4 col-md-12 text-center text-md-start footer-info">
						<a routerLink="/home" style="text-decoration: none;">
							<li class="d-flex align-items-center justify-content-center justify-content-lg-start mb-4">
								<img src="images/white-logo.png" alt="PawTalk logo" class="footer-logo mb-4">
							</li>
						</a>
						<p>A safe outlet where Nationalians can freely express their concerns, opinions, and problems regarding academics, blockmates, professors, and the university.</p>
					</div>
					<div class="col-lg-3 footer-links text-center text-lg-start offset-1">
						<h5 class="text-uppercase fw-bold mb-3">Quick Links</h5>
						<ul class="list-unstyled">
							<li><a class="quick-l" href="index.php">All</a></li>
							<li><a class="quick-l" href="acads.php">Academics</a></li>
							<li><a class="quick-l" href="blockmates.php">Blockmates</a></li>
							<li><a class="quick-l" href="profs.php">Professors</a></li>
							<li><a class="quick-l" href="faci.php">Facilities</a></li>
						</ul>
					</div>
					<div class="col-lg-3 footer-links text-center text-lg-start">
						<h5 class="text-uppercase fw-bold mb-3">Policies</h5>
						<ul class="list-unstyled">
							<li><a class="quick-l" href="terms-condition.php">Terms & Conditions</a></li>
							<li><a class="quick-l" href="privacy-policies.php">Privacy Policies</a></li>
							<li><a class="quick-l" href="disclaimer.php">Disclaimer</a></li>
						</ul>
					</div>
				
					</div>

					</div>
				</div>
			</div>
		</div>
		<div class="foot-extend d-flex justify-content-between align-items-center">
			<p class="m-2">PawTalk Copyright 2023 ©</p>
		</div>
	</footer>
	
	
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  

</html>
