<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gabriel's Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-image: url('../Gabriel_LabActivity5/images/bgb.webp'); 
            font-family: 'Arial', sans-serif;
        }
h2{
    color: #F4CE14;
}
        section {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .post-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 60%;
            text-align: center;
            margin-top: 20px;
        }

        .blog-post {
            border: 3px solid #F4CE14;
            border-radius: 3px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .blog-post h3 {
            color: #F4CE14;
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

        textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            border: 3px solid #F4CE14;
            border-radius: 3px;
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #F4CE14;
            color: #000000;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <section>
        <div class="post-form">
            <h2>View Blog</h2>
            <?php
            require 'connect.php';
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $stmt = "select * from post where post_id=$id";
                $container = $conn->query($stmt);
                while ($data = $container->fetch_assoc()) {
            ?>
                    <div class="blog-post">
                        <h3><?php echo $data['blogtitle'] ?></h3>
                        <p class="category"><?php echo $data['blogcat'] ?></p>
                        <p class="dateposted"><?php echo $data['datetime'] ?></p>
                        <p><?php echo $data['blogcontent'] ?></p>
                        <img src="../Gabriel_LabActivity5/images/<?php echo $data['blogpic'] ?>" alt="Blog Image" class="img-fluid">
                        <br>
                        <label>Comments</label>
                        <br><br>
                        <?php
                        require 'connect.php';
                        $stmt = "select * from comment where post_id=$id";
                        $container = $conn->query($stmt);
                        while ($data = $container->fetch_array()) {
                            echo "$data[2] says:"; ?>
                            <textarea name="" id="" cols="10" rows="2" readonly><?php echo $data[3] ?></textarea>
                            <p style="font-size: x-small;"><?php echo $data[4] ?></p>
                            <br>
                        <?php } ?>
                    </div>

                    <form action="comment.php" method="post">
                        <input type="hidden" value="<?php echo $id ?>" name="id">
                        <br>
                        <textarea name="comment" cols="30" rows="5"></textarea><br>
                        <input type="submit" value="Post a comment" name="pcomment">
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>
