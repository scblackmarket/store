<?php
if($_POST){
$id_produk=$_POST['id_produk'];
$nama_produk=$_POST['nama_produk'];
$deskripsi=$_POST['deskripsi'];
$harga=$_POST['harga'];
//upload foto
$ekstensi = array('png','jpg','jpeg');
$namafile = $_FILES['file']['name'];
$tmp = $_FILES['file']['tmp_name'];
$tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
$ukuran = $_FILES['file']['size'];  

if(empty($nama_produk)){
            echo "<script>alert('nama produk tidak boleh kosong');location.href='../pages/produk.php';</script>";
            }else{
            if(!in_array($tipe_file, $ekstensi)){
                header("location:../file/ubah_produk.php?alert=gagal_ektensi");
            }else{
                if($ukuran < 1044070){          
                    move_uploaded_file($tmp, 'assets/foto_produk/'.$namafile);
                    include "koneksi.php";
                    $query = mysqli_query($conn, "INSERT INTO produk (id_produk, nama_produk, deskripsi, harga, foto_produk) VALUE ('".$id_produk."', '".$nama_produk."','".$deskripsi."', '".$harga."', '".$namafile."')");
                    if($query){
                        echo "<script>alert('Sukses tambah produk');location.href='../pages/produk.php';</script>";
                    }else{
                        echo "<script>alert('Gagal tambah produk');location.href='../pages/produk.php';</script>";
                    }
                }else{
                    echo "<script>alert('Ukuran Terlalu Besar');location.href='../pages/produk.php';</script>";
                }
            }
        }
}
?>