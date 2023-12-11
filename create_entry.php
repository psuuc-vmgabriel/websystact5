<?php
session_start();
require 'connect.php';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    if (isset($_POST['post'])) {
        $title = $_POST['title'];
        $cat = $_POST['category'];
        $content = $_POST['content'];
        $Imagename = $_FILES['image']['name'];
        $Imagetype = $_FILES['image']['type'];
        $Imagesize = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];

        if (move_uploaded_file($tmp_name, "../Gabriel_LabAct5/images/" . $Imagename)) {
            echo "upload successfully";
        }

        $stmt = "insert into post(blogtitle,blogcontent,datetime,blogcat,blogpic)values('$title','$content',NOW(),'$cat','$Imagename')";
        $container = $conn->query($stmt);
        echo " <script>
        Swal.fire({
            title: 'Entry successfully post',
            text: '',
            icon: 'success'
        });
    </script>";
    header("Refresh:0;url=home.php");
    }
} else {
    header("Refresh:1;url=login.php");
    exit(); // Add exit() to stop script execution after redirection
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

    <style>
        body {
            background-image: url('../Gabriel_LabActivity5/images/bgb.webp'); 
            background-color: #ffffff;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #F4CE14;
            padding: 10px 0;
            box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.1);
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            color: #000000;
            font-size: 30px;
            margin: 0;
        }

        header ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 15px;
        }

        header li a {
            color: #000000;
            text-decoration: none;
            font-size: 14px;
        }

        section {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .post-form-container {
            width: 80%;
        }

        .post-form {
            border: 3px solid #F4CE14;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .post-form h2 {
            color: #000000;
            font-size: 30px;
            margin-bottom: 20px;
            text-align: center;
        }

        .post-form label {
            color: #000000;
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            text-align: left;
        }

        .post-form input,
        .post-form textarea,
        .post-form select {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 16px;
            border: 1px solid #F4CE14;
            border-radius: 3px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .post-form input[type="file"] {
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .post-form input[type="submit"] {
            background-color: #F4CE14;
            color: #000000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
    </style>
</head>

<body>

    <header>
        <div class="container">
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarScroll"
                aria-controls="navbarScroll"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <h1>Gabriel's Blog</h1>

            <ul>
                <li><a class="nav-link" href="home.php">Home</a></li>
                <li><a class="nav-link" href="create_entry.php">Create Blog Entry</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header>

    <section>
        <div class="post-form-container">
            <div class="post-form">
                <h2>Post a Blog</h2>
                <form id="blogForm" action="create_entry.php" method="POST" enctype="multipart/form-data">
                    <label for="title">Blog Entry:</label>
                    <input type="text" id="title" name="title" class="form-control" required>

                    <label for="category">Category:</label>
                    <select class="form-select" name="category" id="category" required>
                        <option selected disabled>Select Category</option>
                        <option value="Travel and Leisure">Travel</option>
                        <option value="Technology">Daily Life</option>
                        <option value="Food">Food</option>
                    </select>

                    <label for="content">Content:</label>
                    <textarea id="content" name="content" rows="8" class="form-control" required></textarea>

                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" class="form-control" required>

                    <input type="submit" value="ADD ENTRY" name="post" class="btn btn-warnings">
                </form>
            </div>
        </div>

        <div class="blog-container mt-4" id="blogContainer">
            <!-- The posted blogs will be dynamically added here -->
        </div>
    </div>
</section>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
