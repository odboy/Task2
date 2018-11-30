<html>
<head>
<title>Task 2 - Part 3</title>
</head>
<body>
<h4>Specify the Filename to save the flag.</h4>
<?php
include 'flag.php';
error_reporting(0);
$referer = $_SERVER['HTTP_REFERER'];
if(isset($referer)!== false) {
    $savepath = "uploads/" . sha1($_SERVER['REMOTE_ADDR']) . "/";
    if (!is_dir($savepath)) {
        $oldmask = umask(0);
        mkdir($savepath, 0777);
        umask($oldmask);
    }
    if ((@$_GET['filename'])) {
        $content = $flag;
        file_put_contents("$savepath" . $_GET['filename'], $content);
        $msg = '<p>Flag is here, you should get it very fast (just 0.1s).</p><p>' 
            . $savepath . htmlspecialchars($_GET['filename']) . "</p><br>";
        echo $msg;
        usleep(100000);   // 睡眠100毫秒
        $content = "Too slow, flag already lost, you should be faster !!!";
        file_put_contents("$savepath" . $_GET['filename'], $content);
    }
   print <<<EOT
<br>
<form action="" method="get">
<label>Filename</label>
<input type="text" name="filename"  placeholder="Filename">
<button type="submit"   >Submit</button>
</form>
EOT;
}
else{
    echo 'you can not see this page directly';
}
?>
</body>
</html>