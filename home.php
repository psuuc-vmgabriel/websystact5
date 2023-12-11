<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gabriel's Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            background-color: #F4CE14;
        }

        header {
            background-color: #F4CE14;
            padding: 10px 0;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            color: #000000;
            font-size: px;
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

        .blog-post {
            border: 1px solid #F4CE14;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .blog-post h3 {
            color: #007bff;
            font-size: 20px;
            margin-top: 0;
        }

        .blog-post .category,
        .blog-post .dateposted {
            color: #000000;
            font-size: 12px;
            margin: 5px 0;
        }

        .blog-post img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
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

            <h1>Happy Blog</h1>

            <ul>
                <li><a class="nav-link" href="home.php">Home</a></li>
                <li><a class="nav-link" href="create_entry.php">Create Blog Entry</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header>

    <section class="bg-white d-flex align-items-center min-vh-100">
        <div class="container mt-5">
            <?php
            session_start();
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
            } else {
                header("Refresh:2;url=login.php");
            }
            ?>

            <?php
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                require 'connect.php';
                $stmt = "select * from post";
                $container = $conn->query($stmt);
                while ($data = $container->fetch_assoc()) {
            ?>
                    <div class="blog-post">
                        <h3><a href="view_comment.php?id=<?php echo $data['post_id'] ?>"><?php echo $data['blogtitle'] ?></a></h3>
                        <p class="category"><?php echo $data['blogcat'] ?></p>
                        <p class="dateposted"><?php echo $data['datetime'] ?></p>
                        <p><?php echo $data['blogcontent'] ?></p>
                        <img src="../Gabriel_LabActivity5/images/<?php echo $data['blogpic'] ?>" alt="Blog Image" class="img-fluid">
                    </div>
            <?php }
            } ?>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>
