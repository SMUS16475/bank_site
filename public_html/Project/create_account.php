<!-- User form must have account type option and minimum deposit (at least $5) -->
<!-- On submit, insert in account table the account type and associate with that user (user_id) and set the account number initially to NULL-->
<!-- After successful execution, get the last insert id.-->
<!-- Use str_pad in php-->
<!-- Update the value of the account number based on the str_pad for the account inserted () -->
<!-- Account should have been created. Now, you create a transaction with a type of deposit from the world account to the last insert id based on the valid deposit--> 
<!-- Refresh account balance which is similar to example on the board-->

<?php
require(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);

$db = getDB();
$stmt = $db->prepare("SELECT id, account_number, balance, active FROM Accounts WHERE user_id = :uid");
$stmt->execute([":uid" => get_user_id()]);
$accounts = $stmt->fetchAll();
?>

<style>
    #hidden {
        display: none;
    }
</style>
<form onsubmit="return validate(this)" method="POST">
    <h1 id="title">Create Account</h1>
    <div>
        <label for="account">Account Type</label>
        <select name="account" onchange="showDiv('hidden', this)">
            <option value="select" id="select">Select type</option>
            <option value="checking" id="act_type">Checking</option>
            <option value="savings" id="act_type">Savings</option>
            <option value="loan" id="act_type">Loan</option>
        </select>
    </div>
    <div id="hidden"> 
        <label for="exs-accounts">Accounts</label>
        <select name="exs-account">
            <?php foreach($accounts as $a):?>
                <?php if (se($a, 'active', "", false) == 1) : ?>
                    <option value="<?php se($a,'id');?>"><?php se($a, "account_number");?></option>
                <?php endif; ?>
            <?php endforeach;?>
        </select>
        <p><strong>APY For Loans:</strong> 0.3</p>
    </div>
    <div>
        <label for="min_depo">Minimum Deposit</label>
        <input type="text" name="deposit" required placeholder="Enter value in USD ($)."/>
    </div>
    <div>
        <label for="memo">Memo</label>
        <input type="text" name="memo" required placeholder="Enter a memo."/>
    </div>
    <input type="submit" value="Create" name="create"/>
</form>
<script>
    function validate(form) {
        // JavaScript code
        var minDep = form.deposit.value;
        var accType = form.account.value;

        if (accType != "checking" && accType != "savings" && accType != "loan") {
            try {
                flash("Please choose an account type.", "warning");
            } catch (e) {
                console.log(e);
            }
            return false;
        }
        return true;
    }

    function showDiv(divId, element) {
        document.getElementById(divId).style.display = element.value == "loan" ? 'block' : 'none';
    }
</script>
<?php
if (isset($_POST["account"]) && isset($_POST["deposit"]) && isset($_POST["memo"])) {
    $account = se($_POST, "account", "", false);
    $account_id2 = se($_POST, "exs-account", "", false);
    $deposit = se($_POST, "deposit", "", false);
    $memo = se($_POST, "memo", "", false);
    $wrd_act = -1;

    $hasError = false;

    if (empty($deposit)) {
        flash("Please enter a minimum deposit value.", "warning");
        $hasError = true;
    }
    if (intval($deposit) < 5) {
        flash("Minimum deposit value should not be less than $5.", "danger");
        $hasError = true;
    }
    if (strval($account) == "loan" && intval($deposit) < 500) {
        flash("Minimum loan value should not be less than $500.", "danger");
        $hasError = true;
    }
    if (!$hasError) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Accounts (account_number, user_id, account_type) VALUES(NULL, :uid, :account)");
        try {
            $stmt->execute([":account" => $account, ":uid" => get_user_id()]);
            $account_id = $db->lastInsertId ();
            if (strlen($account_id) > 2) {
                $daActNum = get_random_str(12);
            } else {
                $newId = get_random_str(12 - strlen($account_id));
                $daActNum = $newId . $account_id;
            }
            if ($account == "savings" || $account == "loan") {
                $query = "SELECT value FROM SystemSettings WHERE name = :type";
                $stmt = $db->prepare($query);
                $stmt->execute([":type" => $account]);
                $apy = se($stmt->fetch(), "value", 0, false);
                $stmt = $db->prepare("UPDATE Accounts set apy = :apy WHERE id = :act_id");
                $stmt->execute([":apy" => $apy, ":act_id" => $account_id]);
            }
            $stmt = $db->prepare("UPDATE Accounts set account_number = :account_number WHERE id = :account_id");
            $stmt->execute([":account_id" => $account_id, ":account_number" => $daActNum]);
            flash("Success!", "success");
            if ($account != "loan") {
                do_bank_action($wrd_act, $account_id, $deposit, "deposit", $memo);
            } else {
                do_bank_action($account_id, $account_id2, $deposit, "deposit", $memo);
                flash("Make sure to pay off the loan.", "info");
            }
            redirect("view_accounts.php");
        } catch (Exception $e) {
            users_check_duplicate($e->errorInfo);
        }
    }
}
?>
<?php
require_once(__DIR__ . "/../../partials/flash.php");
?>