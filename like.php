<?php 
session_start();
require_once('connection.php');
try {
	if(isset($_POST['article_id'],$_POST['profile_name'],$_POST['rel']))


{

$id = $_POST['article_id'];
$user_name = $_POST['profile_name'];
$rel = $_POST['rel'];

if($rel=="like")
{
$check = $db->prepare("SELECT * FROM LIKES WHERE AUTHOR = '$user_name' AND ARTICLE_ID = '$id'");
$check->execute();
$row = $check->fetchAll();
if(!empty($row))
{
$likecount_get = $db->prepare("SELECT LIKE_COUNT  FROM BLOGCONTENT WHERE ARTICLE_ID = '$id' and AUTHOR = '$user_name' ");
$likecount_get->execute();
$likes = $likecount_get->fetch();
echo $likes["LIKE_COUNT"];


}
else {

$qq = $db->prepare("INSERT INTO LIKES(AUTHOR,ARTICLE_ID) VALUES (?,?)");	
$qq->bindParam(1,$user_name);
$qq->bindParam(2,$id);
$qq->execute();

$likecount_update = $db->prepare("UPDATE BLOGCONTENT SET LIKE_COUNT = LIKE_COUNT + 1 WHERE ARTICLE_ID = '$id' ");
$likecount_update->execute();
$likecount_get = $db->prepare("SELECT * FROM BLOGCONTENT WHERE ARTICLE_ID = '$id' ");
$likecount_get->execute();
$likes = $likecount_get->fetch();
$getlikes = $likes['LIKE_COUNT'];
echo $getlikes;
}


}
else if($rel=="unlike")
{
//--unlike
$check2 =  $db->prepare("SELECT * FROM LIKES WHERE AUTHOR = '$user_name' AND ARTICLE_ID = '$id' ");
$check2->execute();

 $unlike = $db->prepare("DELETE FROM LIKES WHERE AUTHOR = '$user_name' AND ARTICLE_ID = '$id' ");
 $unlike->execute();
$likecount_delete = $db->prepare("UPDATE BLOGCONTENT SET LIKE_COUNT = LIKE_COUNT - 1 WHERE ARTICLE_ID = '$id'");
$likecount_delete->execute();
$likecount_obtain = $db->prepare("SELECT * FROM BLOGCONTENT WHERE ARTICLE_ID = '$id' ");
$likecount_obtain->execute();
$likes = $likecount_obtain->fetch();
$getlikes = $likes['LIKE_COUNT'];
echo $getlikes;

}









}
else
{
	echo "string";
}

}
 catch (Exception $e) {
	$e->getMessage();
}

?>