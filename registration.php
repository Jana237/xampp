<?php
include('config.php');

if (!empty($_POST['login']) && !empty($_POST['pass']) && !empty($_POST['fname']) && !empty($_POST['sname']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['addres'])) {
	$login = htmlspecialchars(trim($_POST['login']));
	$pass = htmlspecialchars(trim($_POST['pass']));
	$pass2 = htmlspecialchars(trim($_POST['pass2']));
	$fname = htmlspecialchars(trim($_POST['fname']));
	$sname = htmlspecialchars(trim($_POST['sname']));
	$phone = htmlspecialchars(trim($_POST['phone']));
	$email = htmlspecialchars(trim($_POST['email']));
	$addres = htmlspecialchars(trim($_POST['addres']));

	if (strlen($pass) < 6) {
		echo "Пароль должен быть не менее 6 символов";
	} else {
		if ($pass != $pass2) {
			echo "Пароли не совпадают";
		} else {
			$salt = 'taiestisuvalinetekst';
			$kryp = crypt ($pass, $salt);
			$output = mysqli_query ($connection, "SELECT * FROM user WHERE login = '{$login}'");
			if (mysqli_num_rows($output) > 0) {
				echo "такой логин уже есть";
			} else {
				$paring = "insert into user set login='$login', pass='$kryp', fname='$fname', sname='$sname', phone='$phone', email='$email', addres='$addres'";
				$output = mysqli_query ($connection, $paring);
				if (mysqli_affected_rows($connection)==1) {
					header('Location: login.php?msg=ok');
				} else {
					echo "неправильный логин или пароль";
				}
			}
		}
	}
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

    	<!-- Bootstrap CSS -->
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
		<title>Регистрация</title>

	</head>
	<body>
		<div class="container-fluid">
			<h3 class="text-left">Форма регистрации</h3>
			<div class="p-3 border bg-light col-3">
				<form method="post" class="g-5 ">
  					<div class="mb-2">
    					<label class="form-label">Login</label>
    					<input type="text" name="login" class="form-control" required>	
  					</div>
					<div class="mb-2">
						<label class="form-label">Password</label>
						<input type="password" class="form-control" name="pass" required>
					</div>
					<div class="mb-2">
						<label class="form-label">Repeat Password</label>
						<input type="text"  class="form-control" name="pass2" required>
					</div>
					<div class="mb-2">
						<label class="form-label">Name</label>
						<input type="text"  name="fname" class="form-control" required>
					</div>
					<div class="mb-2">
						<label class="form-label">Surname</label>
                  		<input type="text" name="sname" class="form-control" required>
              		</div>
              		<div class="mb-2">
                  		<label class="form-label">Phone</label>
                  		<input type="tel" name="phone" class="form-control" required>
              		</div>
              		<div class="mb-2">
                  		<label class="form-label">Email</label>
                  		<input type="email" name="email" class="form-control" required>
              		</div>
              		<div class="mb-2">
                  		<label class="form-label">Addres</label>
                  		<input type="text" name="addres" class="form-control" required>
             		 </div>
              		<button type="submit" class="btn btn-primary">Регистрация</button>
        		</form>
        	</div>
	</body>
</html>