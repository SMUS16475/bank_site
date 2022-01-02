<?php
error_log("data: " . var_export($_POST, true));
require(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);

$db = getDB();
$account_id = se($_GET, "id", "", false);
$params = [":a_id" => $account_id];
$stmt = $db->prepare("SELECT id FROM Accounts WHERE id = :a_id");
$stmt->execute([":a_id" => $account_id]);
?>
<style>
    h3, button {
        padding: 4px;
    }
</style>
<h3 id="question">Are you sure you want to close your account?</h3>
<form onsubmit="return validate(this)" method="POST">
    <input type="submit" value="Yes" name="choice"/>
    <input type="submit" value="No" name="choice"/>
</form>

<?php
if (isset($_POST["choice"])) {
    $choice = se($_POST, "choice", "", false);

    $hasError = false;

    $db = getDB();
    $stmt = $db->prepare("SELECT id, balance FROM Accounts WHERE id = :aid");
    $stmt->execute([":aid" => $account_id]);
    $act_bal = $stmt->fetch();

    if (strval($choice) == "Yes" && intval(se($act_bal, "balance", 0, false)) > 0) {
        flash("Please extract all funds before closing this account.", "warning");
        $hasError = true;
    }

    if (strval($choice) == "No") {
        redirect("transactions_page.php?id=" . $account_id);
    }

    if (!$hasError && strval($choice) == "Yes") {
        $query = "UPDATE Accounts set active = :act where id = :aid";
        $stmt = $db->prepare($query);
        try {
            $active_val = 0;
            $stmt->execute([":aid" => $account_id, ":act" => $active_val]);
        } catch (Exception $e) {
            flash("<pre>" . var_export($e, true) . "</pre>");
        }
        flash("Account closed.", "success");
        redirect("view_accounts.php");
    }
}
?>
<?php
require_once(__DIR__ . "/../../partials/flash.php");
?>