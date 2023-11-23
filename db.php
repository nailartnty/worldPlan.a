<?php
// buat koneksi ke db yg udh kita buat
$conn = mysqli_connect(
     'localhost',
     'root',
     '',
     'todolist-db'
)or die ('kita gak nyambung'); // kalau kita gak nyambung tampikan ini

?>