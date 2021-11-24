<?php
$pass = password_hash('password1', PASSWORD_DEFAULT);
echo $pass."\n\n";


for ($i = 1; $i < 21; $i++ ) {
    $pass = password_hash('password'.$i, PASSWORD_DEFAULT);
    echo $pass."\n";
}
?>