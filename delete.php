<?php
include ('config.php');

//$query='SELECT * FROM news';
//$responce=mysqli_query($connection, $query)

$checkSQL=mysqli_query($connection, "SELECT id, title, news FROM `news`"); 


if(!empty ($_GET['id'])) {
	//запрос на удоление
	$id = $_GET['id'];
	$delete_sql  = "DELETE FROM news WHERE id='$id'";
	$delete_value = mysqli_query($connection, $delete_sql);
	if($delete_value){
		echo "Строка удалена!";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$_SERVER['PHP_SELF'].'">';
	} else {
		echo "Ошибка при удалении!";
	}
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Удоление новостей</title>
</head>
<body>
<h1>Удоление новостей</h1>
<?php
  while($str=mysqli_fetch_array($checkSQL))
  {
     echo '<div>
              <p><strong>ID </strong>'.$str['id'].'</p>
              <p><strong>Title </strong>'.$str['title'].'</p>
              <p><strong>News </strong>'.$str['news'].'</p>
              <a href="'.$_SERVER['PHP_SELF'].'?id='.$str['id'].'"></i>delete</a>            
            </div>
            <hr>';
  }
?>
</body>
</html>