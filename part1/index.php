<html>
<head>
<title>Task 2 - Part 1</title>
</head>
<body>
<h2>Task 2 - Part 1</h2>

<form method="post">
<p><label>User ID：<br /><input type="text" name="id" value="" size="40" /></span> </label></p>
<p><input type="submit", value="提交" /></p>
</form>

<?php
// error_reporting(0);
include 'config.php';
if (isset($_REQUEST['id'])) {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: ");
    }

    $sql = "SELECT COUNT(*) FROM users";
    $whitelist = array();
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $whitelist = range(1, $row['COUNT(*)']);
    }

    $id = stop_hack($_REQUEST['id'],$_COOKIE['v']);
    $sql = "SELECT * FROM users WHERE id=$id";

    if (!in_array($id, $whitelist)) {
        die("id $id is not in whitelist.");
    }

    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        echo "<table style='margin-top:0' border='1' padding='3px' cellpadding='10'>";
        foreach ($row as $key => $value) {
            echo "<tr><td><center>$key</center></td><br>";
            echo "<td><center>$value</center></td></tr><br>";
        }
        echo "</table>";
    }
    else{
        die($conn->error);
    }
}
?>
<!-- select flag from flag; Have you noticed this info? -->
</body>
</html>
