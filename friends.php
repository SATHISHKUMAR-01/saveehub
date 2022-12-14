<?php

session_start();
include('config/connect.php');

$username = $_SESSION['name'];
$sql = "SELECT username,pic FROM login where username NOT IN (SELECT follower_name FROM followers WHERE account = '$username') AND username != '$username'";

$res = mysqli_query($conn, $sql);
$rows = array();
while ($row = mysqli_fetch_array($res))
    $rows[] = $row;

$sql1 = "SELECT club_name,pic FROM club where club_name NOT IN (SELECT follower_name FROM followers WHERE account = '$username') AND club_name != '$username'";

$res1 = mysqli_query($conn, $sql1);
$rows1 = array();
while ($row = mysqli_fetch_array($res1))
    $rows1[] = $row;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends</title>
    <?php include('header.php') ?>

    <style>
        #club {
            display: none;
        }

        .friends_pic {
            width: 40px;
            height: 40px;
            border-radius: 80px;
        }
    </style>


</head>

<body>
    <?php include('navigation.php'); ?>

    <div class="container">
        <h2 class="fs-2 fw-normal text-secondary pt-4 text-center"> Follow Requests</h2>

        <div class="text-center pt-3">
            <button class="fs-5 fw-normal px-4 text-center btn btn-outline-secondary" id="friend_button" > Friends</button>
            <button class="fs-5 fw-normal px-4 text-center btn btn-outline-secondary" id="club_button" > Clubs</button>
        </div>

        <br>

        <div class="text-center mx-auto w-75">
            <table class="table w-50 mx-auto mt-3" id="friends">
                <?php foreach ($rows as $row) { ?>

                    <tr class="fs-4 shadow-sm " style="background-image: linear-gradient(to right bottom, #13cad4, #5ed3d9, #85dbdf, #a6e3e5, #c4ebec);">

                        <?php if ($row['pic'] != '') { ?>
                            <td class="py-2 px-3"> <img src="./profile_pics/<?php echo $row['pic']; ?>" alt="" class="friends_pic"> </td>
                        <?php } else { ?>
                            <td class="py-2 px-3"> <i class="fa-regular fa-user"></i> </td>
                        <?php } ?>

                        <td class="py-2 px-3"> <?php echo $row['username']; ?> </td>
                        <td class="py-2 px-3">
                            <a href="addfollower.php?acc=<?php echo $username; ?>&follower=<?php echo $row['username']; ?> ">
                                <button class="btn btn-sm btn-dark">FOLLOW</button>
                            </a>
                        </td>
                    </tr>
                    


                <?php } ?>
            </table>
        </div>

        <div class="text-center mx-auto w-75">
            <table class="container table w-50 mx-auto mt-3" id="club">
                <?php foreach ($rows1 as $row) { ?>

                    <tr class="fs-4 shadow-sm" style="background-image: linear-gradient(to right bottom, #13cad4, #5ed3d9, #85dbdf, #a6e3e5, #c4ebec);">

                        <?php if ($row['pic'] != '') { ?>
                            <td class="py-2 px-3"> <img src="./club_pics/<?php echo $row['pic']; ?>" alt="" class="friends_pic"> </td>
                        <?php } else { ?>
                            <td class="py-2 px-3"> <i class="fa-regular fa-user"></i> </td>
                        <?php } ?>

                        <td class="py-2 px-3"> <?php echo $row['club_name']; ?> </td>
                        <td class="py-2 px-3">
                            <a href="addfollower.php?acc=<?php echo $username; ?>&follower=<?php echo $row['club_name']; ?> ">
                                <button class="btn btn-sm btn-dark">FOLLOW</button>
                            </a>
                        </td>
                    </tr>


                <?php } ?>
            </table>
        </div>

    </div>

    <br><br><br>

    <?php include('footer.php'); ?>

    <script>
        var friends = document.getElementById('friends');
        var club = document.getElementById('club');


        $(document).ready(function() {
            $("#friend_button").click(function() {
                $("#friends").fadeIn();
                $("#club").fadeOut();
            });
        });

        
        $(document).ready(function() {
            $("#club_button").click(function() {
                $("#club").fadeIn();
                $("#friends").fadeOut();
            });
        });

    </script>
</body>

</html>