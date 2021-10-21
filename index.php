<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Login Form in PHP With Session</title>
</head>

<body style="background:#CCC;">
    <?php require_once 'process.php' ?>
    <?php
    if (isset($_SESSION['message'])) :
    ?>
    <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
        <?php
            echo $_SESSION['message'];
            //unset($_SESSION['message']);
            ?>
    </div>
    <?php endif ?>
    <div class="container ">
        <?php
        $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT *FROM data") or die($mysqli->error);
        ?>

        <div class="row justify-content-center ">
            <div class="col-lg-6 m-auto">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row = $result->fetch_assoc()) :
                    ?>
                    <tr>
                        <td> <?php echo $row['name'] ?></td>
                        <td> <?php echo $row['location'] ?></td>
                        <td>
                            <a href="  index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                            <a href="  index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>
    <?php
    function pre_r($array)
    {
        echo '<pre>';
        print_r($array);
        echo '<pre>';
    }
    ?>
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-lg-6 m-auto ">
                <form action="process.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id;?> ">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" placeholder="Enter your name" value="<?php echo $name ?>"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="location" placeholder="Enter your location" value="<?php echo $location ?>"
                            class="form-control">
                    </div>
                    <?php
                    if($update ==true):

                    ?>
                    <button type="submit" class=" mt-2 btn btn-primary" name="update">Update</button>
                    <?php else: ?>
                    <div class="form-group">
                        <button type="submit" class=" mt-2 btn btn-primary" name="save">Save</button>
                    <?php endif;?>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>