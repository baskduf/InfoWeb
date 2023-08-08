<?php
$conn =mysqli_connect('localhost','root','root');
//mysql -hlocalhost -uroot -p

mysqli_select_db($conn, 'opentutorials');
//use opentutorials

$id = mysqli_real_escape_string($conn, $_GET['name']);
$pw = mysqli_real_escape_string($conn, $_GET['password']);
// mysqli real escape string
// => 따움표 ' 를 따움표 역할이 아닌 문자로 취급하게함
// ' -> \'  .. 쿼리조작 공격을 방지

$sql = "SELECT * FROM topic WHERE title='".$id."' AND description='".$pw."'";

$result = mysqli_query($conn, $sql);
//SELECT * FROM topic

//fetch = 가져오다 , assoc = 연관배열식

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <?php
    $password = $_GET["password"];
    if($result->num_rows == "0")
    {
        echo "뉘신지?";
        
    } else
    {
        echo "안녕하세요, 주인님.";
    }
    ?>
</body>
</html>