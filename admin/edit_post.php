<?php include("layouts/header.php"); ?>

<?php if ($session->is_signed_in() === FALSE) {
    redirect("login.php");
} ?>

<?php
$categories = new Category;
$categories = $categories->find_all();

$post = new Post;
$post = $post->find_by_id($_GET['id']);

if (isset($_POST['update'])) {
    if ($post) {
        $post->title          = $post->escape_string($_POST['title']);
        $post->content        = html_entity_decode($_POST['content']);
        $post->category_id    = $post->escape_string($_POST['category_id']);
        $post->public_time    = $post->escape_string($_POST['public_time']);

        if(!empty($post->image_url)){
            $post->set_file($_FILES['image_url']);
            $post->save_image();
        }
        // echo "<pre>";
        // print_r($post); die;
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
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="col-md-6 col-md-offset-3">

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="<?php echo $post->title; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="file" name="image_url">
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea id="summernote" class="form-control" name="content" id="" cols="30" rows="10">
                                <?php echo $post->content; ?>
                            </textarea>
                        </div>

                        <div class="form-group">
                            <select name="category_id" >
                                <?php 
                                    $reg_datetime = date("Y-m-d H:i", strtotime($post->public_time)); // convert to time
                                    $from_for_val=  date("Y-m-d\TH:i:s", strtotime($reg_datetime)); // format $reg_datetime
                                ?>

                                <?php foreach($categories as $category) { ?>
                                    <option <?php echo $category->id == $post->category_id ? 'selected' : '' ?> value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                                <?php } ?>

                            </select>
                        </div>

                        <input type="datetime-local" name="public_time" value="<?=$from_for_val;?>">
                        

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