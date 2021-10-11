<?php session_start(); ?>
<?php require('./header.php'); ?>

<?php

include './config/connection.php';

// Error messages
$nameEmptyErr = "";
$emailEmptyErr = "";
$phoneEmptyErr = "";
$subjectEmptyErr = "";
// $messageEmptyErr = "";
$fileEmptyErr = "";
$nameErr = "";
$emailErr = "";
$phoneErr = "";
$subjectErr = "";

if (isset($_POST['save'])) {
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$subject = mysqli_real_escape_string($conn, $_POST['subject']);
	$message = mysqli_real_escape_string($conn, $_POST['message']);

	// Set form variables
	$name           = checkInput($_POST["name"]);
	$email          = checkInput($_POST["email"]);
	$phone          = checkInput($_POST["phone"]);
	$subject         = checkInput($_POST["subject"]);
	$file         = checkInput($_POST["document"]);

	// $comment        = checkInput($_POST["comment"]);

	// Name validation
	if (empty($name)) {
		$nameEmptyErr = '<div class="error">
                Name can not be left blank.
            </div>';
	} // Allow letters and white space 
	else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
		$nameErr = '<div class="error">
                Only letters and white space allowed.
            </div>';
	} else {
		echo $name . '<br>';
	}

	// Email validation
	if (empty($email)) {
		$emailEmptyErr = '<div class="error">
                Email can not be left blank.
            </div>';
	} // E-mail format validation
	else if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
		$emailErr = '<div class="error">
                    Email format is not valid.
            </div>';
	} else {
		echo $email . '<br>';
	}


	// phone validation
	if (empty($phone)) {
		$phoneEmptyErr = '<div class="error">
                Enter phone no.
            </div>';
	} else if (!preg_match("/^[0-9][6-9]{9}$/", $phone)) {
		$phoneErr = '<div class="error">
                    phone no is not valid.
            </div>';
	} else {
		echo $phone . '<br>';
	}


	// subject validation
	if (empty($subject)) {
		$subjectEmptyErr = '<div class="error">
                Enter your subject.
            </div>';
	} else {
		echo $subject . '<br>';
	}
	// file validation
	if (empty($file)) {
		$fileEmptyErr = '<div class="error">
                Choose PDF file.
            </div>';
	} else {
		echo $file . '<br>';
	}


	// // Checkbox validation
	// if (!empty($hoby)) {
	// 	foreach ($_POST['hoby'] as $val) {
	// 		echo $val . '<br>';
	// 	}
	// } else {
	// 	$hobyEmptyErr = '<div class="error">
	//             What are your hobbies.
	//         </div>';
	// }

	// Text-area validation
	// if (empty($comment)) {
	// 	$commentEmptyErr = '<div class="error">
	//             This field is required.
	//         </div>';
	// } else {
	// 	echo $comment . '<br>';
	// }




	if (isset($_FILES["document"]["name"])) {
		$filename = $_FILES["document"]["name"];
		$ext = explode(".", $filename);
		$cn = count($ext);
		if ($ext[$cn - 1] == 'pdf') {

			$tmpname = $_FILES["document"]["tmp_name"];
			move_uploaded_file($tmpname, "uploads/" . $filename);

			mysqli_query($conn, "insert into users(name,email,phone,subject,message,document) values ('$name','$email','$phone','$subject','$message','$filename')");

			// session_start();
			$_SESSION['status_text'] = "Good job!";
			$_SESSION['status'] = "File Uploaded Successfully.";
			$_SESSION['status_code'] = "success";
			header("Location: assignment.php");
			exit();
		} else {
			// session_start();
			$_SESSION['status_text'] = "Error";
			$_SESSION['status'] = "Allowed Only PDF File.";
			$_SESSION['status_code'] = "error";
			// header("Location: assignment.php");

			// echo "Allowed only PDF file";
		}
	}
	//Start the session if already not started.
	// session_start();
	// $_SESSION['success_message'] = "File Uploaded Successfully.";
	// header("Location: assignment.php");
	// exit();

} else {
	// echo "Server problem, Try after sometime.";
	// $_SESSION['status'] = "Server problem, Try after sometime.";
	// $_SESSION['status_code'] = "warning";
	// header("Location: assignment.php");
}

function checkInput($input)
{
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);
	return $input;
}
?>


<header id="head" class="secondary">
	<div class="container">
		<h1>Upload Assignment File</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing eliras scele!</p>
	</div>
</header>


<!-- container -->
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h3 class="section-title"></h3>
			<!-- <p>
				Lorem Ipsum is inting and typesetting in simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the is dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
			</p> -->

			<!-- <?php if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) { ?>
				<div class="success-message" style="margin-bottom: 20px;font-size: 20px;color: green;"><?php echo $_SESSION['success_message']; ?></div>
			<?php
						unset($_SESSION['success_message']);
					}
			?> -->

			<form class="form-light mt-20" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
				<div class="form-group">
					<label>Name</label><span class="error">*</span>
					<input type="text" name="name" class="form-control" placeholder="Your name" value="<?php if (isset($_POST['name'])) {
																											echo htmlentities($_POST['name']);
																										} ?>">
					<span class="error"><?php echo $nameEmptyErr; ?>
						<?php echo $nameErr; ?></span>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Email</label><span class="error">*</span>
							<input type="email" name="email" class="form-control" placeholder="Email address" required value="<?php if (isset($_POST['email'])) {
																																	echo htmlentities($_POST['email']);
																																} ?>">
							<span class="error"><?php echo $emailEmptyErr; ?>
								<?php echo $emailErr; ?></span>
						</div>
					</div>
					<div class="col-md-6">
						<!-- <div class="form-group">
							<label>Phone</label>
							<input type="text" value="+91" class="form-control" placeholder="Phone number">
						</div> -->

						<label>Phone</label><span class="error">*</span>
						<div class="input-group" style="margin-bottom: 15px;">
							<span class="input-group-addon">+91</span>
							<input type="text" name="phone" class="form-control" placeholder="Phone number" required value="<?php if (isset($_POST['phone'])) {
																																echo htmlentities($_POST['phone']);
																															} ?>">
							<span class="error"></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label>Subject</label><span class="error">*</span>
					<input type="text" name="subject" class="form-control" placeholder="Subject" required value="<?php if (isset($_POST['subject'])) {
																														echo htmlentities($_POST['subject']);
																													} ?>">
					<span class="error"></span>
				</div>
				<div class="form-group">
					<label>Upload File (Only PDF File)</label><span class="error">*</span>
					<input type="file" name="document" class="form-control" placeholder="Upload Assignment File" required>
					<span class="error"></span>
				</div>
				<div class="form-group">
					<label>Message</label>
					<textarea class="form-control" name="message" id="message" placeholder="Write you message here..." style="height:100px;"></textarea>
					<span class="error"></span>
				</div>
				<input type="submit" name="save" value="submit" class="btn btn-block btn-two"></input>
				<p><br /></p>
			</form>
		</div>
		<br>
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<h3 class="section-title">Anything problem please contact us!</h3>
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


<script src="./assets/js/sweetalert.min.js"></script>

<?php if (isset($_SESSION['status']) && !empty($_SESSION['status'])) { ?>

	<script>
		swal({
			title: "<?php echo $_SESSION['status_text']; ?>",
			text: "<?php echo $_SESSION['status']; ?>",
			icon: "<?php echo $_SESSION['status_code']; ?>",
			button: "Okay Done!",
		});
	</script>

<?php
	unset($_SESSION['status']);
}
?>

<?php require('./footer.php'); ?>