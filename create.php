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
  $sql = "SELECT * FROM author";
  $author_select_form = '<select name="author_id">';
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result)){
    $author_select_form .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
  }
  $author_select_form .= '</select>';
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
        <form action="create_process.php" method="post">
            <p><input type="text" name="title" placeholder="title"></p>
            <p><textarea name="description" placeholder="description"></textarea></p>
            <p>author: <?=$author_select_form?></p>
            <p><input type="submit"></p>
        </form>
    </body>
</html>