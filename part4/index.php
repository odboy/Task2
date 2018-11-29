<html>
<head>
<title>Task 2 - Part 4</title>
</head>
<body>
<h2>Task 2 - Part 4</h2>
<p>Please upload an image</p>
<br><br>
<?php
function GetIP(){
    if(!empty($_SERVER["HTTP_CLIENT_IP"]))
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    else if(!empty($_SERVER["REMOTE_ADDR"]))
        $cip = $_SERVER["REMOTE_ADDR"];
    else
        $cip = "0.0.0.0";
    return $cip;
}
function getReailFileType($filename){
    $file = fopen($filename, "rb");
    $bin = fread($file, 2); //just read 2 bytes
    fclose($file);
    $strInfo = @unpack("C2chars", $bin);    
    $typeCode = intval($strInfo['chars1'].$strInfo['chars2']);    
    $fileType = ''; 
    switch($typeCode){      
        case 255216:            
            $fileType = 'jpg';
            break;
        case 13780:            
            $fileType = 'png';
            break;        
        case 7173:            
            $fileType = 'gif';
            break;
        default:            
            $fileType = 'unknown';
        }    
        return $fileType;
}

if(isset($_POST['submit'])){
    $GetIPs = GetIP();
    $tmp_file = $_FILES['upload_file']['tmp_name'];
    $realfile_type = getReailFileType($tmp_file);
    if ($GetIPs=="127.0.0.1" and $realfile_type !== 'unknown'){
        $is_upload = false;
        $UPLOAD_ADDR = "./uploads";
        $msg = null;
        if (isset($_POST['submit'])) {
            if (!file_exists($UPLOAD_ADDR)) {
                if (!is_dir($UPLOAD_ADDR)) {
                    mkdir($UPLOAD_ADDR, 0777);
                }
            }
            $deny_ext = array("php","php5","php4","php3","php2","html","htm","phtml","jsp","jspa","jspx","jsw","jsv","jspf","jtml","asp","aspx","asa","asax","ascx","ashx","asmx","cer","swf","htaccess");
            $file_name = trim($_FILES['upload_file']['name']);
            $file_name = str_ireplace($deny_ext,"", $file_name);
            if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $UPLOAD_ADDR . '/' . $file_name)) {
                $img_path = $UPLOAD_ADDR . '/' .$file_name;
                $is_upload = true;
            }
        }
    ?>
        <div id="img">
            <?php
                if($is_upload){
                    echo '<img src="'.$img_path.'" width="250px" />';
                }
            ?>
        </div>
    <?php
    }
    else{
        die("Your are not allowed or the file you uploaded is illegal.");
    }
}
?>
<div id="upload_panel">
    <form enctype="multipart/form-data" method="post">
        <p>Images:<p>
        <input class="input_file" type="file" name="upload_file"/>
        <input class="button" type="submit" name="submit" value="上传"/>
    </form>
    <div id="msg">
        <?php 
            if($msg != null){
                echo "Hit: ".$msg;
            }
        ?>
    </div>
</div>
</body>
</html>