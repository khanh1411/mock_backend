<?php require_once "layouts/header.php"; ?>

<?php if($session->is_signed_in() === FALSE) { redirect("login.php"); } ?>
<?php
$users = new User;
$users = $users->find_all();
?>
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
                </h1>

                <a href="add_user.php" class="btn btn-primary">Add User</a>

                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <!-- <th>Photo</th> -->
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo $user['username']; ?>
                                        <div class="action_links">
                                            <a href="delete_user.php?id=<?php echo $user['id'] ?>">Delete</a>
                                            <a href="edit_user.php?id=<?php echo  $user['id'] ?>">Edit</a>
                                        </div>
                                    </td>
                                    <td><?php echo $user['first_name']; ?></td>
                                    <td><?php echo $user['last_name'] ?></td>
                                    <td><?php echo $user['role'] ?></td>


                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- /.row -->

    </div>


</div>

<?php include("layouts/footer.php"); ?>