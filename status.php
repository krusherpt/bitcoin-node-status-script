<?php
exec("pgrep bitcoind", $output, $return);
if ($return == 0) {
    echo "ON\n";
}
else
{
echo "OFF\n";
}
?>