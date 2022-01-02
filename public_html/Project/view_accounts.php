<?php
require(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);

$db = getDB();
$stmt = $db->prepare("SELECT id, account_number, account_type, balance, apy, active FROM Accounts WHERE user_id = :uid LIMIT 5");
$stmt->execute([":uid" => get_user_id()]);
$accounts = $stmt->fetchAll();
?>

<h1>Accounts</h1>
<div>
    <?php foreach($accounts as $a):?>
        <?php if (se($a,'account_type', "", false) != "loan" && se($a,'account_type', "", false) != "savings" && se($a, 'active', "", false) == 1) : ?>
            <h3><a href="transactions_page.php?id=<?php se($a, 'id');?>" id="type"> <?php se($a,'account_type');?></a></h3>
            <p><strong>ID:</strong> <?php se($a,'id');?></p>
            <p><strong>Account Number:</strong> <?php se($a,'account_number');?></p>
            <p><strong>Balance:</strong> $<?php se($a,'balance');?></p>
            <p><strong>Annual Percentage Yield (APY):</strong> <?php 
            $apy = se($a, "apy","",false); 
            if(empty($apy)) {
                $apy = "-";} 
            echo $apy;
            ?></p>
        <?php elseif (se($a, 'account_type', "", false) == "savings") : ?>
            <h3><a href="transactions_page.php?id=<?php se($a, 'id');?>" id="type"> <?php se($a,'account_type');?></a></h3>
            <p><strong>ID:</strong> <?php se($a,'id');?></p>
            <p><strong>Account Number:</strong> <?php se($a,'account_number');?></p>
            <p><strong>Balance:</strong> $<?php se($a,'balance');?></p>
            <p><strong>Annual Percentage Yield (APY):</strong> <?php se($a, 'apy');?></p>
        <?php endif; ?>
    <?php endforeach;?>
</div>
<button type="button"><a href="create_account.php">Create Account</a></button>
<style>
    #type {
        color: white;
        text-decoration: none;
    }

    #type:hover {
        color: yellow;
        text-decoration: underline;
    }
</style>
<?php
require_once(__DIR__ . "/../../partials/flash.php");
?>