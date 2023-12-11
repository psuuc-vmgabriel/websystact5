<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign-up</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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
           
            width: 600px;
            padding: 30px;
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
            margin-bottom: 10px; /* Added margin-bottom for spacing */
        }
    </style>
</head>

<body>
    <form action="logup.php" method="post">
        <h1 class="h3 mb-3 fw-normal text-center">Create an Account</h1>

        <div class="form-floating">
            <input
                id="username1"
                type="text"
                class="form-control"
                id="floatingName"
                placeholder="Name"
                name="username"
                required
            />
            <label for="floatingName">Username</label>
        </div>
        <div class="form-floating">
            <input
                id="password1"
                type="password"
                class="form-control"
                id="floatingPassword"
                placeholder="Password"
                name="password"
                required
            />
            <label for="floatingPassword">Password</label>
        </div>
        <div class="form-floating">
            <input
                id="confirmpass1"
                type="password"
                class="form-control"
                id="floatingConfirmPassword"
                placeholder="Confirm Password"
                name="cpass"
                required
            />
            <label for="floatingConfirmPassword">Confirm Password</label>
        </div>

        <div class="checkbox mb-3 text-center">
            <label>
                <input type="checkbox" value="agree" required /> I agree to the terms and conditions
            </label>
        </div>
        <input
            type="submit"
            class="w-100 btn btn-lg btn-warning"
            value="Sign up"
            name="reg"
        />

        <p class="text-center mx-3">
            <i>Already have an account <a href="login.php">Login here!</a></i>
        </p>
    </form>

    <?php
    require 'connect.php';

    if (isset($_POST['reg'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpass = $_POST['cpass'];

        // Check if the username already exists
        $checkusername = "SELECT username FROM user WHERE username=?";
        $stmt = $conn->prepare($checkusername);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($username == "" || $password == "" || $cpass == "") {
            echo " <script>
                Swal.fire({
                    title:'Fill up the form',
                    text: '',
                    icon: 'error'
                });
                </script>";
        } else {
            if ($result->num_rows > 0) {
                // Username is already taken
                echo " <script>
                    Swal.fire({
                        title:'Username Already Taken',
                        text: 'This username is already registered. Please choose a different username.',
                        icon: 'error'
                    });
                    </script>";
            } else {
                if ($password == $cpass) {
                    // Insert new user using prepared statement
                    $insertQuery = "INSERT INTO user (username, password) VALUES (?, ?)";
                    $stmt = $conn->prepare($insertQuery);
                    $stmt->bind_param("ss", $username, $password);
                    $stmt->execute();

                    echo " <script>
                        Swal.fire({
                            title:'Registered Successfully',
                            text: '',
                            icon: 'success'
                        });
                        </script>";
                    header("Refresh:2;url=login.php");
                } else {
                    // Passwords do not match
                    echo " <script>
                        Swal.fire({
                            title:'Password not match',
                            text: '',
                            icon: 'error'
                        });
                        </script>";
                }
            }
        }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
