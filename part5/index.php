<html>
<head>
<title>Task 2 - Part 5</title>
</head>
<body>
<h2>Task 2 - Part 5</h2>
<br>
<?php
// include 'flag.php';

if  ("POST" == $_SERVER['REQUEST_METHOD'])
{
    $password = $_POST['password'];
    if (0 >= preg_match('/^[[:graph:]]{12,}$/', $password))
    {
        echo 'Wrong Format';
        exit;
    }
    while (TRUE)
    {
        $reg = '/([[:punct:]]+|[[:digit:]]+|[[:upper:]]+|[[:lower:]]+)/';
        if (6 > preg_match_all($reg, $password, $arr))
            break;
        $c = 0;
        $ps = array('punct', 'digit', 'upper');
        foreach ($ps as $pt)
        {
            if (preg_match("/[[:$pt:]]+/", $password))
            $c += 1;
        }
        if ($c < 3) break;
        if ("88" == $password) 
            if(isset($_POST[ 'ip' ])) {
                $target = trim($_POST[ 'ip' ]);
                $subs = array(
                    '&'  => '',
                    ';'  => '',
                    '| ' => '',
                    '-'  => '',
                    '$'  => '',
                    '('  => '',
                    ')'  => '',
                    '`'  => '',
                    '||' => '',
                );
                $target = str_replace( array_keys( $subs ), $subs, $target );
                $cmd = shell_exec( 'ping  -c 1 ' . $target );
                if ($cmd){
                    echo "Congratulation!!!";
                    echo  "<pre>{$cmd}</pre>";
                }
                else {
                    echo "something wrong";
                }
            }
        else 
            echo 'Wrong password';
        exit;
    }
}
else{
    echo "<p>Please review the source code</p><br><br>";
    highlight_file(__FILE__);
}
?>
</body>
</html>