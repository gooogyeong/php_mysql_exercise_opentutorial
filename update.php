<?php
  require('config.php');
  $conn = mysqli_connect($host, $user, $password, $db);
  $sql = "SELECT * FROM topic LIMIT 100";
  $result = mysqli_query($conn, $sql);
  $title_list = '';
  while ($row = mysqli_fetch_array($result)) {
    $escaped_title = htmlspecialchars($row['title']);
    $title_list = $title_list."<li><a href=\"index.php?id={$row['id']}\">".$escaped_title."</a></li>";
  }
  if (isset($_GET['id'])) {
  $safe_id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT * FROM topic WHERE id={$safe_id}"; //위의 $sql 덮어쓰게됨
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $article = array(
      'title'=>htmlspecialchars($row['title']),
      'description'=>htmlspecialchars($row['description'])
  );
  }
?>
<!doctype html>
    <head>
        <meta charset="utf-8">
        <title>WEB</title>
    </head>
    <body>
        <h1><a href="index.php">WEB</a></h1>
        <ol>
        <?=$title_list?>
        </ol>
        <a href="create.php">create</a>
        <form action="update_process.php" method="post">
            <input type="hidden" name="id" value="<?=$_GET['id']?>"></input>
            <p><input type="text" name="title" value="<?=$article['title']?>"></p>
            <p><textarea name="description">
                <?=$article['description']?>
            </textarea></p>
            <p><input type="submit"></p>
        </form>
    </body>
</html> 