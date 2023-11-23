<?php
$album_id=$_GET['albumid'];
$user_id=$_GET['userid'];
$songid =$_GET['songid'];
$artist_id =$_GET['artistid'];
$genre_id = $_GET['genreid'];

echo $user_id;

require_once('../connect.php');

if(isset($_GET['albumid'])){
    $q="DELETE from `album` where Album_ID = $album_id";
    $result=mysqli_query($mysqli, $q);

    if($result)
    {
        echo "Deleted success";
        header("Location: adminAlbum.php");
    }else{
        echo "delete failed. Error: ".$mysqli->error;
    } 

}elseif (isset($_GET['userid'])){
    $q="DELETE from `users` where Student_ID = $user_id";
    $result=mysqli_query($mysqli, $q);
    if($result)
    {
        echo "Deleted user success";
        header("Location: adminUser.php");
    }else{
        echo "delete failed. Error: ".$mysqli->error;
    } 

}
elseif (isset($_GET['songid'])){
    $q="DELETE from `global_musicbank` where Song_ID = $songid";
    $result=mysqli_query($mysqli, $q);
    if($result)
    {
        echo "Deleted song success";
        header("Location: adminGlobal.php");
    }else{
        echo "delete failed. Error: ".$mysqli->error;
    } 

}elseif (isset($_GET['artistid'])){
    $q="DELETE from `artist` where Artist_ID = $artist_id";
    $result=mysqli_query($mysqli, $q);
    if($result)
    {
        echo "Deleted artist success";
        header("Location: adminArtist.php");
    }else{
        echo "delete failed. Error: ".$mysqli->error;
    } 

}elseif (isset($_GET['genreid'])){
    $q="DELETE from `genre` where Genre_ID = $genre_id";
    $result=mysqli_query($mysqli, $q);
    if($result)
    {
        echo "Deleted artist success";
        header("Location: adminGenre.php");
    }else{
        echo "delete failed. Error: ".$mysqli->error;
    } 

}

?>