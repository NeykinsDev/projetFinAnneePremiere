<?php
include_once ("functions.ctl.php");
echo( get_inserted_user_id());
$role;

switch ($role) {
    case 0:
        echo "i égal 0";
        break;
    case 1:
        echo "i égal 1";
        break;
    case 2:
        echo "i égal 2";
        break;
}
?>