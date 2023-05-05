<?php
$fp = fopen('file.txt', 'a+');
fwrite($fp, rand());
fclose($fp);