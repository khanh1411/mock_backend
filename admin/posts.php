<?php require_once "layouts/header.php"; ?>

<?php if($session->is_signed_in() === FALSE) { redirect("login.php"); } ?>
<?php
$result = new Post;
$posts = $result->find_all();

// $post_images = $result->picture_path();
// echo"<pre>";
// print_r($post_images); die;
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
                    Posts
                </h1>

                <a href="add_post.php" class="btn btn-primary">Add Post</a>

                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th id="thIdPost">Id</th>
                                <!-- <th id="thPhotoPost">Image</th> -->
                                <th id="thTitlePost">Title</th>
                                <th id="thContentPost">Content</th>
                                <th id="thTypePost">Type_id</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($posts as $post) : ?>
                                <tr>
                                    <td id="idPost"><?php echo $post['id']; ?></td>
                                    <!-- <td></td> -->
                                    <td id="titlePost"><?php echo $post['title']; ?>
                                        <div class="action_links">
                                            <a href="delete_post.php?id=<?php echo $post['id'] ?>">Delete</a>
                                            <a href="edit_post.php?id=<?php echo  $post['id'] ?>">Edit</a>
                                        </div>
                                    </td>
                                    <td id="contentPost"><?php echo substr($post['content'], 0, 400)." ..."; ?></td>
                                    <td id="typePost"><?php echo $post['type_id'] ?></td>
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