<?php
include ('config.php');
if(empty($_GET['id'])) {
    die ('Цель не была выброна');
} else {
    $id= $_GET['id'];
//запрос на чтение
    $sql="SELECT * FROM news WHERE id='$id'";
    $output=mysqli_query($connection, $sql);
    $str=mysqli_fetch_assoc($output);
    }
//запрос на изменения
if (!empty($_POST['title'])) {
    $title=($_POST['title']);
    $edit="UPDATE news
      SET title='".$title."',
      news='$news'
      WHERE id='$id'
      ";
$edit_db = mysqli_query($connection, $edit);
  if($edit_db) {
    echo "успешно отредактировано, перенаправление <a
    href=\"news.php\"> назад </a>";
    echo '<META HTTP-EQUIV="Refresh" Content="2;
    URL=news.php">';
    die();
  } else {
      echo "какая-то ерунда";
  }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Редактирование новостей</title>
</head>
<body>
  <h1>Редактирование новостей</h1>
    <form method="post">
      <div>
        <label>Title</label>
        table {
        
        <input type="text" name="title" value=" <?php echo $str ['title'] ;?>" required><p></p>
      </div>
      <div>
        <label>News</label>
        <input type="text" name="news" value="<?php echo $str['news']; ?>" required>
      </div><p></p>
      <button type="submit" value="edit">Edit</button>
    </form>

</body>
</html>