<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
<?php
session_start();

          require 'connect.php';

            if(isset($_POST['pcomment'])){
                $comment=$_POST['comment'];
                $id=$_POST['id'];
                $username=$_SESSION['username'];
                $stmt = "INSERT INTO comment (post_id, username, comment, datetime) VALUES ('$id', '$username', '$comment', NOW())";
                $container = $conn->query($stmt);
               echo " <script>
               Swal.fire({
                   title:'comment successfully',
                   text: '',
                   icon: 'success'
               });
               </script>";
               header("Refresh:2;url=home.php");
              }
          
           ?>
</body>
</html>