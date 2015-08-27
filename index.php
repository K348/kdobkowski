<?php
$output = print_r($_SERVER, true);
$output = str_replace(" ", "&nbsp;", $output);
$output = nl2br($output);
echo($output);
?>