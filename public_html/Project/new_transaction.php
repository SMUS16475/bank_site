<?php
require(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);

$db = getDB();
$stmt = $db->prepare("SELECT id, account_number, account_type, balance, active FROM Accounts WHERE user_id = :uid");
$stmt->execute([":uid" => get_user_id()]);
$accounts = $stmt->fetchAll();
?>

<h1>Make A Transaction</h1>
<form onsubmit="return validate(this)" method="POST">
    <div>
        <label for="act_choice">Account</label>
        <select name="account1">
            <?php foreach($accounts as $a):?>
                <?php if (se($a, "account_type", "", false) != "loan" && se($a, "active", "", false) != 0) : ?>
                    <option value="<?php se($a,'id');?>"><?php se($a, "account_number");?></option>
                <?php endif; ?>
            <?php endforeach;?>
        </select>
    </div>
    <div>
        <label for="trans_type">Transaction Type</label>
        <select name="trans_type">
            <option value="select">Select type</option>
            <option value="deposit">Deposit</option>
            <option value="withdraw">Withdraw</option>
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
        var transType = form.trans_type.value;
        if (transType != "deposit" && transType != "withdraw") {
            try {
                flash("Please choose a transaction type.", "warning");
            } catch (e) {
                console.log(e);
            }
            return false;
        }
        return true;
    }
</script>

<?php
    if (isset($_POST["trans_type"]) && isset($_POST["trans"]) && isset($_POST["memo"]) && isset($_POST["account1"])) {
        $transType = se($_POST, "trans_type", "", false);
        $trans = se($_POST, "trans", "", false); 
        $memo = se($_POST, "memo", "", false);
        $account_id = se($_POST, "account1", "", false);

        $stmt = $db->prepare("SELECT id, account_number, balance FROM Accounts WHERE user_id = :uid AND id = :id");
        $stmt->execute([":uid" => get_user_id(), ":id" => $account_id]);
        $act_1 = $stmt->fetch();

        $hasError = false;

        if (intval($trans) <= 0) {
            flash("Transaction value should be more than $0.", "danger");
            $hasError = true;
        }

        if (strval($transType) == "withdraw" && intval($trans) > se($act_1, "balance", 0, false)) {
            flash("That value exceeds the account balance!", "warning");
            $hasError = true;
        }

        if (!$hasError) {
            flash("Transaction successful!", "success");
            $wrd_act = -1;
            if (strval($transType) == "deposit") {
                do_bank_action($wrd_act, $account_id, $trans, "deposit", $memo);
            } else if (strval($transType) == "withdraw") {
                do_bank_action($account_id, $wrd_act, $trans, "withdraw", $memo);
            }
        }
    }
?>
<?php
require_once(__DIR__ . "/../../partials/flash.php");
?>