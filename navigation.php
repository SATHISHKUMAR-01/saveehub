<style>
#profile_pic {
    width: 30px;
    height: 30px;
    border-radius: 0px;
}

#navigation {
    background-image: linear-gradient(to bottom, #656d6d, #838b8b, #a3aaaa, #c4caca, #e6ebeb);
    border-bottom: 1px solid lightgrey;
}
</style>
<?php
$status = $_SESSION['is_club'];
$username_nav = $_SESSION['name'];

$pic = '';

if($status == 0){

$sql = "SELECT pic FROM login where username = '$username_nav'";
$res = mysqli_query($conn, $sql);
$pic = $res->fetch_array()['pic'];
}else if($status == 1){
  $sql = "SELECT pic FROM club where club_name = '$username_nav'";
$res = mysqli_query($conn, $sql);
$pic = $res->fetch_array()['pic'];
}

?>

<div>

    <nav class="navbar navbar-expand-sm shadow   navbar-inverse fixed-top  navbar-dark" style="background-color:#F5FCFF"
        id="navigation">

        &nbsp;

        <a class="nav-link text-black float-start text-warning fs-6" href="viewprofile.php">





            <?php echo  $_SESSION['name'] ?> </a>


        <img src="images/logo1.png" class="d-block mx-auto" width="100px" height="10%">
        <a class="nav-link text-black float-end text-warning fs-3 " href="settings.php"> <i
                class="fa-solid fa-gear"></i></a>


    </nav>
</div>
<br><br><br><br>