<?php require_once "layouts/header.php"; ?>

<?php if($session->is_signed_in() === FALSE) { redirect("login.php"); } ?>
<?php
$result = new Post;
$posts = $result->pagination();
// echo "<pre>";
// print_r($result->find_all()); die;

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
                                <th id="">Id</th>
                                <th id="">Title</th>
                                <th id="">Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($posts as $post) : ?>
                                <tr>
                                    <td id=""><?php echo $post->id; ?></td>
                                  
                                    <td id="titleDisplayPost"><?php echo $post->title; ?>
                                        <div class="action_links">
                                            <a href="delete_post.php?id=<?php echo $post->id; ?>">Delete</a>
                                            <a href="edit_post.php?id=<?php echo  $post->id; ?>">Edit</a>
                                        </div>
                                    </td>
                                    
                                    <td><img class="admin-user-thumbnail user_image" src="<?php echo $post->image_path(); ?>" alt=""></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <div>
                    <?php 
                        $sql = "SELECT * FROM posts";
                        $post_all = $result->query($sql);
                        $post_count = $post_all->num_rows;
                        $post_button = ceil($post_count/4);
                        $i = 1;
                        echo 'trang';
                        for($i=1; $i<=$post_button; $i++){
                            echo '<a style="margin: 0 5px;" href="posts.php?trang='.$i.' ">'.$i.'</a>';
                            
                        }
                        
                    ?>
                </div>

            </div>
        </div>
    </div>


</div>

<?php include("layouts/footer.php"); ?>