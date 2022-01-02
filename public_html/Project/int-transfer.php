<?php
error_log("data: " . var_export($_GET, true));
require(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);

$db = getDB();
$stmt = $db->prepare("SELECT id, account_number, balance, account_type, active FROM Accounts WHERE user_id = :uid");
$stmt->execute([":uid" => get_user_id()]);
$accounts = $stmt->fetchAll();
?>

<h1>Transfer Funds</h1>
<form onsubmit="return validate(this)" method="POST">
    <div>
        <label for="act_choice">From</label>
        <select name="account1">
        <?php foreach($accounts as $a):?>
            <?php if (se($a, "account_type", "", false) != "loan" && se($a, "active", "", false) != 0) : ?>
                <option value="<?php se($a,'id');?>"><?php se($a, "account_number");?></option>
            <?php endif; ?>
        <?php endforeach;?>
        </select>
    </div>
    <div>
        <label for="act_choice_2">To</label>
        <select name="account2">
        <?php foreach($accounts as $a):?>
            <?php if (se($a, "active", "", false) != 0) : ?>
                <option value="<?php se($a,'id');?>"><?php se($a, "account_number");?></option>
            <?php endif; ?>
        <?php endforeach;?>
        </select>
    </div>
    <div>
        <label for="trans">Transaction</label>
        <input type="text" name="trans" required placeholder="Enter value in USD ($0.00)"/> 
    </div>
    <div>
        <label for="memo">Memo</label>
        <input type="text" name="memo" required placeholder="Enter a memo."/>
    </div>
    <input type="submit" value="Submit" name="submit"/>
</form>
<script>
    function validate(form) {
        var account1 = form.act_choice.value;
        var account2 = form.act_choice_2.value;
        if (account1 == account2) {
            try {
                flash("You cannot transfer funds to the same account.", "danger");
            } catch (e) {
                console.log(e);
            }
            return false;
        }
        return true;
    }

</script>

<?php
    if (isset($_POST["trans"]) && isset($_POST["memo"]) && isset($_POST["account1"]) && isset($_POST["account2"])) {
        $trans = se($_POST, "trans", "", false); 
        $memo = se($_POST, "memo", "", false);
        $account_id = se($_POST, "account1", "", false);
        $account_id2 = se($_POST, "account2", "", false);
        $loanPH = 0.0;
        $active_val = 0;

        $stmt = $db->prepare("SELECT id, account_number, balance FROM Accounts WHERE user_id = :uid AND id = :id");
        $stmt->execute([":uid" => get_user_id(), ":id" => $account_id]);
        $act_1 = $stmt->fetch();

        $stmt = $db->prepare("SELECT account_type, balance, active FROM Accounts WHERE user_id = :uid AND id = :id");
        $stmt->execute([":uid" => get_user_id(), ":id" => $account_id2]);
        $act_2_type = se($stmt->fetch(), "account_type", "", false);
        $act_2_bal = se($stmt->fetch(), "balance", "", false);

        $hasError = false;

        if (intval($trans) <= 0) {
            flash("Transfer value should be more than $0.", "danger");
            $hasError = true;
        }

        if (intval($trans) > se($act_1, "balance", "", false)) {
            flash("That value exceeds the account balance!", "warning");
            $hasError = true;
        }

        if (!$hasError) {
            flash("Transfer successful!", "success");
            do_bank_action($account_id, $account_id2, $trans, "transfer", $memo);
            if ($act_2_type == "loan" && intval($act_2_bal) == 0) {
                $query = "UPDATE Accounts set apy = :apy, active = :act WHERE id = :aid";
                $stmt = $db->prepare($query);
                $stmt->execute([":aid" => $account_id2, ":apy" => $loanPH, ":act" => $active_val]);
            }
            redirect("view_accounts.php");
        }
    }
?>
<?php
require_once(__DIR__ . "/../../partials/flash.php");
?>