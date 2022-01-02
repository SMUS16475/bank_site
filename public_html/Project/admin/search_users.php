<?php
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("home.php")));
}

$query = "SELECT b.id FROM Accounts b JOIN Users a on b.user_id = a.id WHERE a.last_name = :ln and b.account_number like :act_num";
$stmt = $db->prepare($query);
$stmt->execute([":ln" => $lastName, ":act_num" => "%$act_num2"]);
$yourAccount = se($stmt->fetch(), "id", "", false);

$query = "SELECT username, first_name, last_name FROM Users "
?>