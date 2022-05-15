<?php 

    $connection = odbc_connect("Driver={SQL Server Native Client 10.0};Server=hostingmssql07;Database=livreoo_com_ventes;", 'livreoo_com_alex', 'Rf17bpe7');

    // Microsoft Access
    $connection = odbc_connect("Driver={Microsoft Access Driver (*.mdb)};Dbq=$mdbFilename", $user, $password);

?>