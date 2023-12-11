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
    session_destroy();
    echo " <script>
    Swal.fire({
        title:'You have been logout',
        text: '',
        icon: 'success'
    });
    </script>";
    header("Refresh:2;url=login.php");
    ?>
</body>
</html>