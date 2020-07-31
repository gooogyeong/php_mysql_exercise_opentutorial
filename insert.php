<?php 
echo "<h1>Insert</h1>";
//터미널에서 mysql에 연결:
//mysql -hlocalhost -uroot -p 이 명령어 치고 패스워드 입력
require('config.php');
$conn = mysqli_connect($host, $user, $password, $db);
mysqli_query($conn, "
    INSERT INTO topic (
        title,
        description,
        created
    ) VALUES (
        'MySQL2',
        'MySQL2 is ....',
        NOW()
    )");
echo mysqli_error($conn); //에러 없을때는 아무것도 출력 X
?>