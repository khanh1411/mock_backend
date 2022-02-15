<?php include("layouts/header.php"); ?>

<?php if ($session->is_signed_in() === FALSE) {
    redirect("login.php");
} ?>

<?php
$user = new User;
if (isset($_POST['create'])) {
    if($user){
        $user->username   = $_POST['username'];
        $user->password   = md5($user->key).md5($_POST['password']);
        $user->first_name = $_POST['first_name'];
        $user->last_name  = $_POST['last_name'];
        $user->role       = $_POST['role'];

        $user->save();
        redirect("users.php");
    }
}

?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->

    <?php include("layouts/top_nav.php") ?>
    <!-- Top Menu Items -->

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

    <?php include("layouts/side_nav.php") ?>


    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Users
                    <small>create new one</small>
                </h1>
                <form action="" method="POST">
                    <div class="col-md-6 col-md-offset-3">

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input type="text" name="first_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" name="role" class="form-control">
                        </div>

                      

                        <div class="form-group">
                            <input type="submit" name="create" class="btn btn-primary pull-right">
                        </div>

                    </div>

                

                </form>
            </div>
        </div>
        <!-- /.row -->

    </div>


</div>
<!-- /#page-wrapper -->

<?php include("layouts/footer.php"); ?>