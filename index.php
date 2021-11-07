<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .icon {
            cursor: pointer;
            width: 120px;
            height: 103px;
            overflow: hidden;
            border-radius: 10px;
            float: left;
            z-index = 0;
        }

        .icon:hover {
            background: #c4e3e3;
        }

        .iconImageFolder {
            background: transparent url('images/folder.png') no-repeat scroll 0% 0%;
            width: 72px;
            height: 72px;
            margin: 0 auto;
        }

        .iconImageFile {
            background: transparent url('images/images.png') no-repeat scroll 0% 0%;
            width: 72px;
            height: 72px;
            margin: 0 auto;
        }


        .iconImageParent {
            background: transparent url('images/parent.png') no-repeat scroll 0% 0%;
            width: 72px;
            height: 72px;
            margin: 0 auto;
        }

        .iconImageNewfolder {
            background: transparent url('images/add.png') no-repeat scroll 0% 0%;
            width: 72px;
            height: 72px;
            margin: 0 auto;
        }

        .iconTitle {
            font-family: Tahoma, serif;
            font-size: 13px;
            color: #000000;
            text-align: center;
            margin: 0 auto;
            max-width: 120px;
            max-height: 30px;
            overflow: hidden;
        }

        .iconRemove {
            float: left;
            background: transparent url("images/remove_icon.png") no-repeat scroll 0% 0%;
            width: 16px;
            height: 16px;
            margin: 0px auto;
            text-align: center;
            margin-left: 22px;
        }

        .iconRename {
            float: left;
            background: transparent url("images/rename_icon.png") no-repeat scroll 0% 0%;
            width: 16px;
            height: 16px;
            margin: 0px auto;
            text-align: center;
            margin-left: 5px;
        }
        .uploadBox {
            margin: 10px;
            padding: 10px;
            background-color: aqua;
        }
    </style>

</head>
<body>
<?php

if(isset($_GET['dir']) && !empty($_GET['dir'])){
    $currentDir = $_GET['dir'].'/';
} else {
    $currentDir = 'myComputer/';
}

$fileList = glob("$currentDir*");
?>
<div class="uploadBox">
    <form action="doUpload" method="post" enctype="application/x-www-form-urlencoded" >
        <label for="uploader"></label>
        <input type="file" name="myFile" id="uploader">
        <input type="text" name="myPath" value="<?php echo $currentDir; ?>">
        <input type="submit" value="upload this" name="submit">
    </form>
</div>
<br>

<?php

//==============================================TODO back to parent directory ============================

if($currentDir != 'myComputer/'){
    echo $currentDir;
    echo "<a href='?dir=".dirname($currentDir)."/'>";
    echo "<div class='icon'>";
    echo "<div class='iconImageParent'></div>";
    echo "<div class='iconTitle'>..</div>";
    echo "</div>";
    echo "</a>";

}

//=================================== TODO create current directory and folders ============================
foreach ($fileList as $currentFile) {
    if (is_dir($currentFile)) {
        echo "<a href='?dir=$currentFile'>";
            echo "<div class='icon'>";
            echo "<div class='iconRemove' onclick='removeThis(\"$currentFile\"); return false;'></div>";
            echo "<div class='iconRename' onclick='renameThis(\"$currentFile\"); return false;'></div>";
                echo "<div class='iconImageFolder'></div>";
                echo "<div class='iconTitle'>" . str_replace($currentDir, '', $currentFile) . "</div>";
            echo "</div>";
        echo "</a>";
    } else {
        echo "<div class='icon'>";
            echo "<div class='iconImageFile'></div>";
            echo "<div class='iconTitle'>" . str_replace($currentDir, '', $currentFile) . "</div>";
        echo "</div>";
    }
}

// TODO create new Folder ================================

echo "<a onclick='createFolder();'>";
echo "<div class='icon'>";
echo "<div class='iconImageNewfolder'></div>";
echo "<div class='iconTitle'>+</div>";
echo "</div>";
echo "</a>";
?>

    <script>
        function createFolder(){
            let folderName = prompt('Please Type Your Folder Name ');
            if(folderName === null){
                return false;
            } else if (folderName === ''){
                alert('Please Enter A Name in Box');
            }else{
               window.location = "createFolder.php?dir=<?php echo $currentDir; ?>&newFolderName="+folderName;
            }
        }

        function renameThis(fileName){
            var newName = prompt("Please enter your new name", "");
            if(newName == null){
                return false;
            } else if (newName == ''){
                alert("Please Enter a new Name in the box");
                return false;
            } else {
                window.location = "rename.php?dir=<?php echo $currentDir ?>&fileName="+fileName+"&newName="+newName;
            }
        }
        function removeThis(fileName){
            if(fileName != ''){
                window.location = 'remove.php?dir=<?php echo $currentDir; ?>&fileName='+fileName;
            }
        }
    </script>
</body>
</html>