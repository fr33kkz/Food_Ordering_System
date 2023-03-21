<?php
	session_start();

	$RollNo = "";
	$email    = "";
	$errors = array();
	$_SESSION['success'] = "";

	$db = mysqli_connect('localhost', 'root', '', 'registration');

	if (isset($_POST['reg_user'])) {
		$RollNo = mysqli_real_escape_string($db, $_POST['RollNo']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		$mob_num = mysqli_real_escape_string($db, $_POST['mob_num']);

		if (empty($RollNo)) { array_push($errors, "RollNo is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }
		if (empty($mob_num)) { array_push($errors, "Mobile Number is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		if (count($errors) == 0) {
			$password = md5($password_1);
			$query = "INSERT INTO users (RollNo, email, password, mobile)
					  VALUES('$RollNo', '$email', '$password','$mob_num')";
			mysqli_query($db, $query);

			$_SESSION['RollNo'] = $RollNo;
			$_SESSION['success'] = "You are now logged in";
			header('location: index2.php');
		}

	}

	if (isset($_POST['login_user'])) {
		$RollNo = mysqli_real_escape_string($db, $_POST['RollNo']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($RollNo)) {
			array_push($errors, "RollNo is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE RollNo='$RollNo' AND Password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['RollNo'] = $RollNo;
				$_SESSION['success'] = "You are now logged in";
				header('location: index2.php');
			}else {
				array_push($errors, "Wrong RollNo/password combination");
			}
		}
	}

?>
