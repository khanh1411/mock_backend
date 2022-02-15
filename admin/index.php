<?php include("layouts/header.php"); ?>

<?php if($session->is_signed_in() === FALSE) { redirect("login.php"); } ?>
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

            <!-- Top Menu Items -->
            <?php include("layouts/top_nav.php") ?> 
          
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("layouts/side_nav.php") ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <?php include("components/content.php") ?>

            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("layouts/footer.php"); ?>