<?php
require_once "../app/dorayaki.php";
require_once "util.php";

$dorayaki = new Dorayaki();

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $res = $dorayaki->delete_dorayaki($id);
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Redirect to Main Page</title>
  <meta http-equiv="refresh" 
        content="0; url = index.php" />
</head>
<body>
    <p> Dorayaki Berhasil Dihapus </p>
</body>
</html>