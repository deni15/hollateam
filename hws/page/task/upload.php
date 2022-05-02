<?php
if ($_POST['submit']) {
    $action = $_POST['action'];
    $date = $_POST['date'];
    $namaFile = $_FILES['berkas']['name'];
    $namaSementara = $_FILES['berkas']['tmp_name'];
    $dirUpload = "../../../ assets/assets/evidence/";

    $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

    if ($terupload) {
        $insert = $koneksi->query("INSERT INTO `task_remark`(`task_no`, `action`, `time`, `remark`, `pic`) VALUES ('$tid','$action','$date','$remark','$namaFile')");
        if ($insert) {
            echo "Sukses";
        }else{
            echo "gagal insert";
        }
    }else{
        echo "gagal upload";
    }
}
?>