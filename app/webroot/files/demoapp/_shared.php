<?php
require '../wepay.php';
Wepay::useStaging('32382', 'dead2f8dee');
session_start();

echo '<pre>';
print_R($_SESSION);
echo '</pre>';