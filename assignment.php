<?php session_start(); ?>
<?php
$title = "WebEdu | Assignment";
require('./header.php');
?>

<?php

include './config/connection.php';

if (isset($_POST['save'])) {
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$subject = mysqli_real_escape_string($conn, $_POST['subject']);
	$message = mysqli_real_escape_string($conn, $_POST['message']);

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
			$_SESSION['status'] = "Record Submitted Successfully.";
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

			<form id="validateForm" class="form-light mt-20" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
				<div class="form-group">
					<label>Name</label><span class="error">*</span>
					<input type="text" name="name" class="form-control" placeholder="Your name" required value="<?php if (isset($_POST['name'])) {
																													echo htmlentities($_POST['name']);
																												} ?>">
					<span class="error"></span>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Email</label><span class="error">*</span>
							<input type="email" name="email" class="form-control" placeholder="Email address" required value="<?php if (isset($_POST['email'])) {
																																	echo htmlentities($_POST['email']);
																																} ?>">
							<span class="error"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Phone</label><span class="error">*</span>
							<input type="text" name="phone" class="form-control" placeholder="Phone number" required value="<?php if (isset($_POST['phone'])) {
																																echo htmlentities($_POST['phone']);
																															} ?>">
							<span class="error"></span>
						</div>

						<!-- <label>Phone</label><span class="error">*</span>
						<div class="input-group" style="margin-bottom: 15px;">
							<span class="input-group-addon">+91</span>
							<input type="text" name="phone" class="form-control" placeholder="Phone number" value="<?php if (isset($_POST['phone'])) {
																														echo htmlentities($_POST['phone']);
																													} ?>">
							<span class="error"></span>
						</div> -->
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

<!-- sweet alert -->
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

<!-- validation form -->
<script>
	$('#validateForm').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},

		fields: {
			name: {
				validators: {
					notEmpty: {
						message: 'Please Enter your Full Name'
					},
					regexp: {
						regexp: /^[a-z ]+$/i,
						message: 'Please enter only Letters'
					},
					stringLength: {
						min: 3,
						max: 20,
						message: 'Please Enter your Full Name with minimum 3 and maximum 20 letters length'
					}
				}
			},
			phone: {
				validators: {
					notEmpty: {
						message: 'Please Enter your Phone Number'
					},
					numeric: {
						message: 'The Phone no must be a Number'
					},
					stringLength: {
						min: 10,
						max: 10,
						message: 'Please Enter your 10 digit Phone Number'
					}
				}
			},
			subject: {
				validators: {
					notEmpty: {
						message: 'Please Enter Subject'
					},
					regexp: {
						regexp: /^[a-z A-Z 0-9 _\.\+\-\()\{}\ ]+$/,
						message: 'Please enter only alphabetical, number, bracket, dot and underscore'
					},
					stringLength: {
						min: 3,
						max: 100,
						message: 'Please enter at least 3 characters and no more than 100'
					}
				}
			},
			message: {
				validators: {
					stringLength: {
						max: 100,
						message: 'Not more than 100 characters'
					}
				}
			},
			email: {
				validators: {
					notEmpty: {
						message: 'Please Enter your Email Address'
					},
					emailAddress: {
						message: 'Please Enter a valid Email Address'
					}
				}
			},
			document: {
				validators: {
					notEmpty: {
						message: 'Upload Only PDF file'
					}
				}
			},
			// confirmPassword: {
			// 	validators: {
			// 		notEmpty: {
			// 			message: 'Enter confirm your profile password'
			// 		},
			// 		identical: {
			// 			field: 'password',
			// 			message: 'Enter the password, what enter in password field'
			// 		}
			// 	}
			// },
			// 'lang_known[]': {
			// 	validators: {
			// 		notEmpty: {
			// 			message: 'The Language Known is required'
			// 		}
			// 	}
			// },
			// role: {
			// 	validators: {
			// 		notEmpty: {
			// 			message: 'Choose your user role'
			// 		}
			// 	}
			// },

		}
	});
</script>

<?php require('./footer.php'); ?>