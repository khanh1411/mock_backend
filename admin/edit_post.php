<?php include("layouts/header.php"); ?>

<?php if ($session->is_signed_in() === FALSE) {
    redirect("login.php");
} ?>

<?php
$post = new Post;
$post = $post->find_by_id($_GET['id']);

if (isset($_POST['update'])) {
    if ($post) {
        $post->title      = $_POST['title'];
        $post->content    = $_POST['content'];
        $post->type_id    = $_POST['type_id'];
        $post->created_at = $_POST['created_at'];

        $post->save();
        redirect("posts.php");
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
                    Posts
                    <small>create new one</small>
                </h1>
                <form action="" method="POST">
                    <div class="col-md-6 col-md-offset-3">

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="<?php echo $post->title ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <input id="content_edit_post" type="text" name="content" value="<?php echo $post->content ?>" class="form-control">
                            <!-- <textarea id="summernote" class="form-control" name="content" id="" cols="30" rows="10">
                            </textarea> -->
                        </div>

                        <div class="form-group">
                            <label for="type_id">Type_id</label>
                            <input type="text" name="type_id" value="<?php echo $post->type_id ?>" class="form-control">
                        </div>

                        <input type="datetime-local" name="created_at" value="<?php echo $post->created_at ?>" />

                        <div class="form-group">
                            <input type="submit" name="update" class="btn btn-primary pull-right">
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