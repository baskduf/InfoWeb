<?php
$conn = mysqli_connect("localhost","root","root");
mysqli_select_db($conn,"opentutorials");
if($_POST['type'] == 'write')
{
    $sql = "INSERT INTO topic(title,description,author,created) VALUES('".htmlspecialchars($_POST['title'])."', '".strip_tags($_POST['description'],'<a><h1><h3><h2><li><ul><ol>')."', '".htmlspecialchars($_POST['author'])."', '".date("Y-m-d H:i:s")."')";
    $result = mysqli_query($conn, $sql);
    //redirection
    header('Location: http://localhost/php/index.php');
}
else if($_POST['type'] == 'delete')
{
    foreach($_POST['title'] as $key => $value)
    {
        $sql = "DELETE FROM topic WHERE id=".$value;
        $result = mysqli_query($conn, $sql);
    }
    header('Location: http://localhost/php/index.php');
}
else if($_POST['type']=='modify')
{
    $sql = "UPDATE topic SET `title`='".htmlspecialchars($_POST['title'])."',`description`='".strip_tags($_POST['description'],'<a><h1><h2><h3><li><ul><ol>')."',`author`='".htmlspecialchars($_POST['author'])."',created='".date("Y-m-d H:i:s")."' WHERE id=".$_POST['title_id'];
    $result = mysqli_query($conn,$sql);
    header('Location: http://localhost/php/index.php?id='.$_POST['title_id']);

}
/*
htmlspecialchars()
scripts를 그대로 표시해줌으로써
공격을 무력화함
단 : html태그도 무력화 되므로 문서에는 부적합

strip_tags()
특정한 태그만 허용

escaping
*/
?>