<?php
require(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);
?>

<h1>Transfer</h1>
<h4>Would you like to (1) transfer to <strong>another</strong> account you own or (2) transfer to an account someone else owns?</h4>
<button type="button" id="choice"><a href="int-transfer.php">First Option</a></button>
<button type="button" id="choice"><a href="ext-transfer.php">Second Option</a></button>