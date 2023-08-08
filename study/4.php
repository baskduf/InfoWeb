<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <form action="http://localhost/test" method="post">
        <?php
        $conn =mysqli_connect('localhost','root','root');
        //mysql -hlocalhost -uroot -p
        
        mysqli_select_db($conn, 'opentutorials');
        //use opentutorials
        
        $result = mysqli_query($conn, "SELECT * FROM topic");

        while($r = mysqli_fetch_assoc($result))
        {
            echo "<p>
            <input type='checkbox' name='title[]' value=".$r["id"].">
        ".$r["title"]."</p>\n";
        }
        echo "<input type='hidden' name='type' value='delete'>\n
        <input type='submit' value='삭제'> "
        ?>
    </form>
</body>
</html>