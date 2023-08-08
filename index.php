<?php
require("lib/db.php");
require("config/config.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
$result = mysqli_query($conn, "SELECT * FROM topic");
//SELECT * FROM topic

//fetch = 가져오다 , assoc = 연관배열식



?>
<!DOCTYPE HTML5>
<html>
<head>
    <title>php web</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="http://localhost/php/style.css">-->
    <link href="http://localhost/php/bootstrap-3.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container" style="padding : 20px">
        <header class="jumbotron text-center">
            <h1 class="display-4"><a href="http://localhost/php/index.php">MyWeb</a>
            <img src="fefe.webp" class="img-circle" alt="" width=100px height=90px ></h1>
            <a href="https://github.com/baskduf" style="float : right">GITHUB</a>
        </header>
        
        <div class="row">
            
            <nav class="col-md-3">
                <ol class="nav nav-pills nav-stacked">
                    <?php
                    //echo file_get_contents("http://localhost/php/index_data/list.txt");
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<li><a href='http://localhost/php/index.php?id=".$row['id']."'>".$row['title']."</a></li>\n";
                        //출력
                    }
                    ?>
                </ol>
            </nav>
            <div class="col-md-9">
                
                <article>
                    <?php
                    if(!empty($_GET['id']))
                    {
                        switch($id = $_GET['id'])
                        {
                            case -1://write
                                echo "<form action='process.php' method='POST'>
                                <p>
                                    <div class='form-group'>
                                        <label for='inputtitle'>제목:</label>
                                        <input id='inputtitle' class='form-control' type='text' name='title'>
                                        
                                    </div>
                                </p>
                                <p>
                                    <div class='form-group'>
                                        <label for='inputauthor'>작성자:</label>
                                        <input id='inputauthor' class='form-control' type='text' name='author'>
                                        
                                    </div>
                                </p>
                                <p>
                                    <label for='inputarea'>본문:</label>
                                    <textarea id='inputarea' class='form-control' rows='3' name='description'></textarea>
                                </p>
                                <input type='hidden' name='type' value='write'>
                                <input class='btn btn-default' type='submit'> 
                                </form>";
                                break;
                            case -2://modify-1
                                echo "<form action='index.php' method='GET'>";
                                $result = mysqli_query($conn, "SELECT * FROM topic");
                                while($r = mysqli_fetch_assoc($result))
                                {
                                    echo "<p><input type='radio' name='title_id' value=".$r["id"]."> ".htmlspecialchars($r["title"])."</p>\n";
                                }
                                    echo "<input type='hidden' name='id' value='-4'>";
                                    echo "<input type='hidden' name='type' value='modify'>\n
                                    <input class='btn btn-default' type='submit' value='modify'> </form>";
                                break;
                            case -3://delete
                                echo "<form action='process.php' method='POST'>";
                                $result = mysqli_query($conn, "SELECT * FROM topic");
                                while($r = mysqli_fetch_assoc($result))
                                {
                                    echo "<p><input type='checkbox' name='title[]' value=".$r["id"]."> ".htmlspecialchars($r["title"])."</p>\n";
                                }
                                    echo "<input type='hidden' name='type' value='delete'>\n
                                    <input class='btn btn-default' type='submit' value='delete'> </form>";

                                break;
                            case -4://modify-2
                                $sql = "SELECT * FROM topic WHERE id=".$_GET['title_id'];
                                $result = mysqli_query($conn, $sql);
                                $data = mysqli_fetch_assoc($result);
                                echo "<form action='process.php' method='POST'>
                                <p>
                                    <div class='form-group'>
                                        <label for='inputtitle'>제목:</label>
                                        <input id='inputtitle' class='form-control' type='text' name='title' value='".htmlspecialchars($data['title'])."'>
                                    </div>
                                </p>
                                <p>
                                    <div class='form-group'>
                                        <label for='inputauthor'>작성자:</label>
                                        <input id='inputauthor' class='form-control' type='text' name='author' value='".htmlspecialchars($data['author'])."'>
                                    </div>
                                </p>
                                <p>
                                    <label for='inputarea'>본문:</label>
                                    <textarea id='inputarea' class='form-control' name='description'>".strip_tags($data['description'],'<a><br><br/><h1><h2><li><ul><ol>')."</textarea>
                                </p>
                                <input type='hidden' name='title_id' value='".$_GET['title_id']."'>
                                <input type='hidden' name='type' value='modify'>
                                <input class='btn btn-default' type='submit'> 
                                </form>";
                                break;
                        }
                        if($_GET['id'] >= 0)
                        {
                            $sql = 'SELECT * FROM topic WHERE id='.$_GET['id'];
                            $result = mysqli_query($conn,$sql);
                            $row = mysqli_fetch_assoc($result);
                            echo '<h2>'.htmlspecialchars($row['title']).'</h2>';
                            echo '<hr>';
                            echo nl2br(strip_tags($row['description'], '<a><h1><h2><h3><li><ul><ol><br>'));
                        }
                    }
                    ?>
                </article>
                <hr>
                <div id="control" class="btn-group" style="margin-bottom:40px">
                        <a class="btn btn-default" href="http://localhost/php/index.php?id=-1">write</a>
                        <a class="btn btn-default" href="http://localhost/php/index.php?id=-2">modify</a>
                        <a class="btn btn-default" href="http://localhost/php/index.php?id=-3">delete</a>
                </div>
            </div>
            
        </div>
    </div>
    
    
    <footer>

    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://localhost/php/bootstrap-3.3.4/dist/js/bootstrap.min.js"></script>
    
</body>
</html>