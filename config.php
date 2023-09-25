<?php

//buat koneksi
$koneksi =mysqli_connect("localhost","root","","db_sekolah");

// cek koneksi
// if(mysqli_connect_error()) {
// echo "gagal koneksi ke dataabase";
// }else {
 // echo "berhasil koneksi";
//}

// url induk
$main_url = "http://localhost/smkn1moilong/";

function uploadimg ($url){
  $namafile = $_FILES['image']['name'];
  $ukuran   = $_FILES['image']['size'];
  $error    = $_FILES['image']['error'];
  $tmp      = $_FILES['image']['tmp_name'];

  //cek file yang di upload
  $validExtension = ['jpg','jpeg','png'];
  $fileExtension = explode('.', $namafile);
  $fileExtension = strtolower(end($fileExtension));
  if (!in_array($fileExtension, $validExtension)) {
    header("location:" . $url . '?msg=notimage');
    die;
  }

  // cek ukuran gambar
  if ($ukuran > 1000000) {
    header("location:" . $url . '?msg=oversize');
    die;
  }

  //generate nama file gambar

  $namafilebaru = rand(10, 1000) . '-' . $namafile;

  // upload gambar 
  move_uploaded_file( $tmp, "../asset/image/" . $namafilebaru);
  return $namafilebaru;
}
