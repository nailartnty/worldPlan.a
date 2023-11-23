function sweet(){
     // Swal.fire("SweetAlert2 is working!");

     // Swal.fire({
     //      icon: '<a href="todo.php">yakin mau buat nihh?</a>',
     //      // title: "Oops...",
     //      text: "Something went wrong!"
     //      // footer: 
     //    });

     Swal.fire({
          title: "Are you sure?",
          text: "Make worldPlan.aila with me!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Mau bangettt!"
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: "LET'S GO",
              text: "yeyy let's make worldPlan.aila together.",
              icon: "success",
              tittle: 'yakin mau buat nihh?'
            }).then(()=> {
               window.location.href = 'todo.php';
            });
          }
        });
}
   