<?php

if (isset($_SERVER['PHP_AUTH_USER'])){

print_r($_SERVER);

}
else
{

header('www-authenticate:basic realm="Secret Stash"');
header('http/1.0 401 unauthorized');
exit;
}
?>
