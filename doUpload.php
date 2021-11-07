<?php
$fileName = $_FILES['myFile']['name'];
$path = substr($_POST['myPath'],0,-1);
$targPath = $path.'/'.$fileName;

if(move_uploaded_file($_FILES['myFile']['tmp_name'], $targPath)){
    echo "Successful";
    echo "<br>"."<a href='".dirname($_SERVER['PHP_SELF'])."index.php?dir=".$path."'>return to back</a>";
} else {
    echo "Error";
}
