<?php include("layouts/header.php"); ?>

<?php if ($session->is_signed_in() === FALSE) {
    redirect("login.php");
} ?>

<?php
if (empty($_GET['id'])) {
    redirect("posts.php");
}
$posts = new Post;
$posts = $posts->find_by_id($_GET['id']);

if ($posts) {
    $posts->delete_post();
    redirect("posts.php");
} else {
    redirect("posts.php");
}

?>