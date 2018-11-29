<?php  
$servername = "mysql";
$username = "task2";
$password = "task2pass";
$dbname = "task2_1";


function stop_hack($value,$v=false){
    $pattern = "insert|delete|or|make_set|concat_ws|group_concat|join|floor|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile|dumpfile|sub|hex|file_put_contents|fwrite|curl|system|eval";
    $pattern = ($v)?$pattern:$pattern."|select|from|concat|updatexml";
    $back_list = explode("|",$pattern);
    foreach($back_list as $hack){
        if(preg_match("/$hack/i", $value))
            die("$hack detected!");
    }
    return $value;
}
?>
