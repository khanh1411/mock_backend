<?php include("layouts/header.php"); ?>

<?php if ($session->is_signed_in() === FALSE) {
    redirect("login.php");
} ?>

<?php
if (empty($_GET['id'])) {
    redirect("users.php");
}
$users = new User;
$users = $users->find_by_id($_GET['id']);

if ($users) {
    $users->delete_user();
    redirect("users.php");
} else {
    redirect("users.php");
}

?>