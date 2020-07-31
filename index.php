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
  $update_link = "";
  $delete_link = "";
  if (isset($_GET['id'])) {
  $safe_id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT * FROM topic LEFT JOIN author ON topic.author_id = author.id WHERE topic.id={$safe_id}"; //위의 $sql 덮어쓰게됨
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $article = array(
      'title'=>htmlspecialchars($row['title']),
      'description'=>htmlspecialchars($row['description']),
      'author'=>htmlspecialchars($row['name'])
  );
  $update_link = "<a href=\"update.php?id={$_GET['id']}\">update</a>";
  $delete_link = "
  <form action=\"delete_process.php?id={$_GET['id']}\" method=\"post\">
    <input type=\"hidden\" name=\"id\" value={$_GET['id']}>
    <input type=\"submit\" value=\"delete\">
  </form>
  ";
  }
?>
<!doctype html>
    <head>
        <meta charset="utf-8">
        <title>WEB</title>
        <p><a href="author.php">author</a></p>
    </head>
    <body>
        <h1><a href="index.php">WEB</a></h1>
        <ol>
        <?=$title_list?>
        </ol>
        <a href="create.php">create</a>
        <?=$update_link?>
        <?=$delete_link?>
        <?php if (isset($_GET['id'])) { ?>
        <h2><?=$article['title']?></h2>
        <?=$article['description']?>
        <p>by <?=$article['author']?></p>
        <?php } else { ?>
        <h2>Welcome</h2>
        Home Page
        <?php } ?>
    </body>
</html>