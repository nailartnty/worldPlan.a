<?php
include 'db.php';

// Proses Insert data

if(isset($_POST['add'])) {
     // $q_insert = "INSERT INTO task (task_lable, task_status) VALUE (
     //      '".$_POST['task']."',
     //      'open'
     // )";

     $q_insert = "INSERT INTO task (task_lable, task_status) VALUE (
          '".mysqli_real_escape_string($conn, $_POST['task'])."', 
          'open'
          )";

     $run_q_insert = mysqli_query($conn, $q_insert);
     if($run_q_insert) {
          header('Refresh:0; url=index.php');
     }

     if(!$run_q_insert) {
          echo 'Error: ' . mysqli_error($conn);
     } else {
          header('Refresh:0; url=index.php');
     }
}


// Show Data
$q_select = "SELECT * FROM task ORDER BY task_id DESC"; // kita ngambil semua task dari task_id
$run_q_select = mysqli_query($conn, $q_select);

// Delete Data
if(isset($_GET['delete'])) {
     $q_delete = "DELETE FROM task WHERE task_id = '".$_GET['delete']."'";
     $run_q_delete = mysqli_query($conn, $q_delete);
     // :10 itu waktu ngerefresh
     header('Refresh:0; url=index.php');
}

// Update Status Data (open/close)
if(isset($_GET['done'])) {
     $status = 'close'; // kita ksih default value 

     if($_GET['status'] == 'open') {
          $status = 'close';
     } else {
          $status = 'open';
     }

     $q_update = "UPDATE task SET task_status = '".$status."' WHERE task_id = '".$_GET['done']."'";
     $run_q_update = mysqli_query($conn, $q_update);
     header('Refresh:0; url=index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>To Do List</title>
     <!-- link css -->
     <link rel="stylesheet" href="todostyle.css">
     <!-- ini buat boxicon -->
     <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
   
     <div class="container">
          <!-- ini unk header -->
          <div class="header">

               <div class="title">

                    <!-- <i class='bx bx-list-ol'></i> -->
                    <img src="img/Desain tanpa judul (9).png" alt="">
                    <span class="text">worldPlan.aila</span>
               </div>

               <!-- description date (l, itu utk hari) -->
               <div class="description"> 
                    <?= date("l, d M Y")?>
               </div>

          </div>

          <!-- ini untuk konten -->
          <div class="konten">
               <!-- ini untuk tugas -->
               <div class="card">

                    <form action="" method="post">
                         <!-- tambah tugas -->
                         <input name="task" type="text" class="input-control" placeholder="Add Task"> 

                         <!-- baut button -->
                         <div class="text-right">
                              <button type="submit" name="add">Add</button>
                         </div>
                    </form>

               </div>

               <!-- menampilkan task a/ tugasx -->
               <?php 
               // ini adalah percabangan 
               if(mysqli_num_rows($run_q_select) > 0) {
                    while($r = mysqli_fetch_array($run_q_select)){
                         
               
               ?>
               <div class="card"> 
                    <!-- $r itu tablex -->
                    <div class="task-item <?= $r['task_status'] == 'close' ? 'done':''?>">
                         <div>
                              <!-- fungsi window.location.href ngasih file baru-->
                              <input type="checkbox" onclick="window.location.href = '?done=<?= $r['task_id']?>&status=<?= $r['task_status'] ?>'"<?= $r['task_status'] == 'close' ? 'checked':'' ?>>
                              <span><?= $r['task_lable']?></span>    
                         </div>

                         <div>
                              
                              <a href="edit.php?id=<?= $r['task_id']?>" class="edit-task" title="Edit dlu gak sihhh"><i class='bx bx-edit-alt' ></i></a>
                              <!-- ?delete= itu udh jadi syntaxnya gk bisa diubah2 a/ url gak bisa dikasih spasi-->
                              <a href="?delete=<?= $r['task_id']?>" class="delete-task" title="Hapus aja lahhh" onclick="return confirm('Hapus gak yahhh?')"><i class='bx bx-trash' ></i></a>
                         </div>

                    </div>

               </div>

               <?php
                    }
               } else { ?>
               <div>Belum ada Data</div>
               <?php } ?>

          </div>
     
     </div>
</body>
</html>