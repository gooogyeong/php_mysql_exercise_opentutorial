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
  }
?>
<!doctype html>
    <head>
        <meta charset="utf-8">
        <title>WEB</title>
        <p><a href="index.php">topic</a></p>
    </head>
    <body>
        <h1><a href="index.php">WEB</a></h1>
        <table border="1">
            <tr>
                <td>id</id><td>name</td><td>profile</td>
            </tr>
            <?php 
            $sql = "SELECT * FROM author";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
              $filtered = array(
                'id'=>htmlspecialchars($row['id']),
                'name'=>htmlspecialchars($row['name']),
                'profile'=>htmlspecialchars($row['profile'])
              );
            ?>
              <tr>
                <td><?=$filtered['id']?></td>
                <td><?=$filtered['name']?></td>
                <td><?=$filtered['profile']?></td>
                <td><a href="author.php?id=<?=$filtered['id']?>">modify</a></td>
                <td>
                  <form action="delete_process_author.php" method="post" onsubmit="if(!confirm('sure?')){return false;}">
                    <input type="hidden" name="id" value=<?=$filtered['id']?>>
                    <input type="submit" value="delete">
                  </form>
                </td>
              </tr>
            <?php } ?>
        </table>
        <?php
        $escaped = array(
            'name'=>'',
            'profile'=>''
        );
        $submit_label = 'Add';
        $form_action = "create_process_author.php";
        $input_id = "";
        if (isset($_GET['id'])) {
        $submit_label = 'Update';
        $form_action = "update_process_author.php";
        $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
        settype($filtered_id, 'integer');
        $sql = "SELECT * FROM author WHERE id = {$filtered_id}";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $escaped['name'] = $row['name'];
        $escaped['profile'] = $row['profile'];
        $input_id = '<input type="hidden" name="id" value="'.$_GET['id'].'">';
        }
        ?>
        <form action=<?=$form_action?> method="post">
          <?=$input_id?>
          <p><input type="text" name="name" placeholder="name" value=<?=$escaped['name']?>></p>
          <p><textarea name="profile" placeholder="profile"><?=$escaped['profile']?></textarea></p>
          <p><input type="submit" value=<?=$submit_label?>></p>
        </form>
    </body>
</html>