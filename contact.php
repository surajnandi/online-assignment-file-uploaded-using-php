<?php
$title = "WebEdu | Contact Us";
require('./header.php');
?>

<header id="head" class="secondary">
	<div class="container">
		<h1>Contact Us</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing eliras scele!</p>
	</div>
</header>


<!-- container -->
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h3 class="section-title">Your Message</h3>
			<p>
				Lorem Ipsum is inting and typesetting in simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the is dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
			</p>

			<form class="form-light mt-20" role="form">
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" placeholder="Your name">
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" placeholder="Email address">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Phone</label>
							<input type="text" class="form-control" placeholder="Phone number">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Subject</label>
					<input type="text" class="form-control" placeholder="Subject">
				</div>
				<div class="form-group">
					<label>Message</label>
					<textarea class="form-control" id="message" placeholder="Write you message here..." style="height:100px;"></textarea>
				</div>
				<button type="submit" class="btn btn-two">Send message</button>
				<p><br /></p>
			</form>
		</div>
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-6">
					<h3 class="section-title">Office Address</h3>
					<div class="contact-info">
						<h5>Address</h5>
						<p>5th Street, Carl View - United States</p>

						<h5>Email</h5>
						<p>info@webthemez.com</p>

						<h5>Phone</h5>
						<p>+09 123 1234 123</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /container -->

<?php require('./footer.php'); ?>