<?php
$dir = substr($_GET['dir'],0,-1);
$newFolderName = $_GET['newFolderName'];
mkdir($dir.'/'.$newFolderName, 0777);
$returnPath = dirname($_SERVER['PHP_SELF']);
//header('localhost/'.$returnPath.'/index.php');
//echo($dir);
$path = $returnPath.'/index.php?dir='.$dir;

echo 'This is returnpath : '.$returnPath;
echo '<br>';
echo 'This is Path : '.$path;





header("location:$path");