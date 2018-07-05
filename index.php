<?php
ob_start();
session_start();
if (isset($_SESSION['timetable'])){
    header('Location: timetable.php');
    exit();
}

?>
<?php include __DIR__.'/layout/header.php'; ?>
<div class="container" style="text-align:center;">
    <div class="card" style="margin-top:20px;">
    <div class="card-body">
        <h1 class="index_title1">Multimedia University TimeTable</h1>
        <u><h2 class="index_title2">BETA TESTING</h2></u>
        <h2 class="index_title2">Log In</h2>
        <?php
        if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
            Echo "<div class='alert alert-danger' role=\"alert\">ERROR : " . $_SESSION['error']. "</div>";
            unset($_SESSION['error']);
        }
        ?>
        <form action="login_code.php" method="post" id="loginForm">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="row">
                    <div class="col-md-3 col-sm-12">
                        Student ID:
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <input class="form-control" type="text" name="id">
                    </div>
                    <div class="col-md-3 col-sm-12">
                        Password:
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <input class="form-control" type="password" name="pwd">
                    </div>
                    </div>
                    <br>
            <button class="btn btn-success" type="submit" form="loginForm" value="Submit" style="width:100%;">Login</button>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>

<?php include __DIR__.'/layout/footer.php'; ?>