<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-in</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-image: url('../Gabriel_LabActivity5/images/bgw.webp'); 
        background-size: cover; 
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        }

        form {
          height: 400px;
            width: 800px;
            padding: 30px; /* Adjust the padding as needed */
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px #f1eb90;
        }

        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-floating {
            margin-bottom: 15px;
        }

        .checkbox {
            text-align: center;
            margin-bottom: 15px;
        }

        .btn-warning {
            background-color: #f1eb90;
            color: #000000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .mx-3 {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <form action="login.php" method="post">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
            <input
                id="username"
                type="text"
                class="form-control"
                placeholder="Email"
                name="username"
                required
            />
            <label for="username">Username</label>
        </div>

        <div class="form-floating">
            <input
                id="password"
                type="password"
                class="form-control"
                placeholder="Password"
                name="password"
                required
            />
            <label for="password">Password</label>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me" /> Remember me
            </label>
        </div>

        <div>
            <input
                type="submit"
                class="w-100 btn btn-lg btn-warning"
                value="Sign in"
                name="log"
            />
        </div>

        <a href="logup.php" class="mx-3"><i>Don't have an account?Register Here!</i></a>
    </form>

    <?php
    require 'connect.php';
    session_start();

    if (isset($_POST['log'])) {
        $username = $_POST['username'];
        $pass = $_POST['password'];

        $stmt = "SELECT username, password FROM user";
        $container = $conn->query($stmt);

        $isValidUser = false;

        while ($data = $container->fetch_assoc()) {
            if ($data['username'] == $username && $data['password'] == $pass) {
                $_SESSION['username'] = $username;
                $isValidUser = true;
                break; // Exit the loop if a match is found
            }
        }

        if ($isValidUser) {
            echo " <script>
            Swal.fire({
                title:'Welcome user',
                text: '',
                icon: 'success'
            });
            </script>";
            header("Refresh:2;url=home.php");
        } else {
            echo " <script>
            Swal.fire({
                title:'Invalid username or password',
                text: '',
                icon: 'error'
            });
            </script>";
        }
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
