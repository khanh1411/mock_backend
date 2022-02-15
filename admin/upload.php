<?php include("layouts/header.php"); ?>

<?php if($session->is_signed_in() === FALSE) { redirect("login.php"); } ?>

<?php 
if(isset($_POST['submit'])){
    $image = new Image();
    $image->name = $_POST['name'];
    $image->set_file($_FILES['file_upload']);
    $image->post_id = $_POST['post_id'];
    $image->created_at = $_POST['created_at'];
    
    if($image->save()){
        $message = "photo uploaded successfully";
    } else {
        // $message = join("<br>", $photo->errors); 
        $message = implode("<br>", $image->errors);
    }    
}

?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("layouts/top_nav.php") ?>

    <?php include("layouts/side_nav.php") ?>
</nav>

<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Upload
                    <small>take some photo here</small>
                </h1>
               
                <?php if(isset($message)) echo $message ?>
                <div class="col-md-6">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="name" >
                            <input type="text" name="post_id" class="post_id" placeholder="post_id">
                            
                        </div>

                        <input type="datetime-local" value="" name="created_at">

                        <div class="form-group" id="btnupload">
                            <input type="file" name="file_upload">
                        </div>

                        <input type="submit" name="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->

<?php include("layouts/footer.php"); ?>