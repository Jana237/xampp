<?php
include ('config.php');

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" 
 rel="stylesheet">  

<title>Поиск</title>
</head>
<body>
<div class="container-fluid">
<form method="get" action="">
	<div class="col-md-6 mt-3">
	<select class="form-select" id="select" name="where">
		<option>name</option>
		<option>email</option>
		<option>addres</option>
		<option>phone</option>
	</select>
    </div>
    </br>
    Поиск <input type="text" name="search">
    <input type="submit" value="search...">
</form>
<?php
if (!empty($_GET['search'])) {
	// пользовательский текст из формы
	$search = $_GET['search'];

	$fields=['name'=>'name', 'email'=>'email', 'addres'=>'addres', 'phone'=>'phone'];
	$field='name';
	if(array_key_exists($_GET['where'],$fields)){
		$field=$fields[$_GET['where']];
	}
	$sql="SELECT * FROM koolitus WHERE {$field} LIKE '%{$search}%'";

	$output = mysqli_query($connection, $sql);
	// количество ответов на запрос
	$results = mysqli_num_rows ($output);

	echo '<div class="pt-3">Поиск по ключевому слову: '.$search.'<br></div>';
	echo 'Ответ: <br>';
	//количество найденых ответов
	if ($results == 0) {
		echo "0 ответов найдено!";
	}
	else {
		echo ' Найдено - '.$results.' ответов'.'<br><hr>';
	}
	//отображение на странице
	while($line = mysqli_fetch_assoc($output)){
		echo '<div class="pt-3"> 
		  <strong>'.$line['name'].'</strong> 
		  <p>'.$line['email'].'</p>
		  <p>'.$line['addres'].'</p> 
		  <p>'.$line['phone'].'</p> 
		 </div>
		 <hr>';
	}
	mysqli_free_result($output);
	mysqli_close($connection);
}
?>
</div>
</body>
</html>