<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: " . "login.php");
    }

    //check expiry time
    ob_start();
    if (isset($_SESSION["login"])) {

        if ($_SESSION["data"]["time"] < time()) { 
            $_SESSION["login"] = false;
            header('Location: login.php');
            exit();
        }
    }
    ob_end_flush();
?>
<?php

    require_once "../app/dorayaki.php";
    require_once "util.php";

    $dorayaki = new Dorayaki();


    if (isset($_POST["dorayaki_name"]) && isset($_POST["dorayaki_harga"])&&isset($_POST["dorayaki_stok"]) && isset($_POST["dorayaki_deskripsi"])){
        $name = $_POST["dorayaki_name"];
        $price = $_POST["dorayaki_harga"];
        $qty = $_POST["dorayaki_stok"];
        $desc = $_POST["dorayaki_deskripsi"];

        if (($_FILES['dorayaki_gambar']['name']!="")){
            $target_dir = "../assets/dorayaki/";
            $file = $_FILES['dorayaki_gambar']['name'];
            $path = pathinfo($file);
            $filename = $path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES['dorayaki_gambar']['tmp_name'];
            $path_filename_ext = $target_dir.$filename.".".$ext;
             
            move_uploaded_file($temp_name,$path_filename_ext);
        }
            /*
            // Buat Cek Sukses (Navbarnya jadi jelek tapi)
            if (file_exists($path_filename_ext)) {
                echo "Sorry, file already exists.";
                }
            else{
                move_uploaded_file($temp_name,$path_filename_ext);
                echo "Congratulations! File Uploaded Successfully.";
                }
            */
        $img = strval($filename.".".$ext);

        $res = $dorayaki->add_dorayaki($name, $price, $qty, $desc, $img);
        if($res) {
            header("Location: " . "index.php");
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/add_variant.css">
    <script src="../components/navbar.js" type="text/javascript" defer></script>
    <title>Doroyaki</title>
</head>
<body>
    <?php
        echo "<navbar-component></navbar-component>";
    ?>
       <div class="box">
        <h2 class="add_variant-title">Menambah Varian Dorayaki</h2>

        <script>
            function handleChangeForm(event) {
                var nameValue = document.getElementsByName("dorayaki_name")[0].value;
                var priceValue = document.getElementsByName("dorayaki_harga")[0].value;
                var stockValue = document.getElementsByName("dorayaki_stok")[0].value;
                var descValue = document.getElementsByName("dorayaki_deskripsi")[0].value;
                var imgValue = document.getElementsByName("dorayaki_gambar")[0].value;
                console.log(nameValue, priceValue, stockValue, descValue, imgValue);
                if (nameValue != "" && priceValue != "" && stockValue != "" && descValue != "" && imgValue != "") {
                    document.getElementById("submit-button").className = "inter";
                    document.getElementById("submit-button").disabled = false;
                }
                else {
                    document.getElementById("submit-button").className = "inter-disabled";
                    document.getElementById("submit-button").disabled = true;
                }
            }
        </script>

        <form action="add_variant.php" method="post" enctype="multipart/form-data" oninput="handleChangeForm(event)">
            <div class="form-box" id="form-top">
                <p class="label">Nama Dorayaki</p>
                <div class="search-box">
                    <input placeholder="Masukkan Nama Dorayaki" name="dorayaki_name" autocomplete="off"/>
                </div>
            </div>
            <div class="form-box" id="form-middle">
                <p class="label">Harga</p>
                <div class="harga-box">
                <div class="left-icon">Rp</div>
                    <input type="number" placeholder="Masukkan Harga Dorayaki" name="dorayaki_harga" min=1 autocomplete="off"/>
                </div>
            </div>
            <div class="form-box" id="form-middle">
                <p class="label">Stok</p>
                <div class="search-box">
                    <input type="number" placeholder="Masukkan Stok Dorayaki" name="dorayaki_stok" min=1 autocomplete="off"/>
                </div>
            </div>
            <div class="form-box" id="form-middle">
                <p class="label">Deskripsi</p>
                <div class="search-box">
                    <input placeholder="Masukkan Deskripsi Dorayaki" name="dorayaki_deskripsi" autocomplete="off"/>
                </div>
            </div>
            <div class="form-box" id="form-bottom">
                <p class="label">Gambar</p>
                <div class="deskripsi-box">
                <input type="file" name="dorayaki_gambar" id="fileToUpload"/>
                </div>
            </div>
            
            <input type="submit" class="inter-disabled" value="Submit" name="dorayaki_submit" id="submit-button"/>
    </div>
    
</body>
</html>