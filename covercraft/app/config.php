<?php
/*
 * Establishes connection
 * Create process log if not exist
 */
function include_multi($files)
{
    $files = func_get_args();
    foreach($files as $file):
        include_once($file);
    endforeach;
}

function launch_app()
{
    include_multi(
        'model/data_connect.php',
        'model/CC_Order_Data.php',
        'controller/pagination.php',
        'view/elements.php',
        'view/controls.php',
        'view/table.php'
    );

    $connection = new CC_Connect();
    $connection->get_connect();
}
