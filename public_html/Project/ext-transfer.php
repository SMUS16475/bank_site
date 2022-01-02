<?php
require(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);

$db = getDB();
$stmt = $db->prepare("SELECT id, account_number, balance, account_type, active FROM Accounts WHERE user_id = :uid");
$stmt->execute([":uid" => get_user_id()]);
$myAccounts = $stmt->fetchAll();

$lastName = se($_POST, "last_name", "", false);
$account_id2 = se($_POST, "id", "", false);
$act_num2 = se($_POST, "account2", "", false);

$query = "SELECT b.id FROM Accounts b JOIN Users a on b.user_id = a.id WHERE a.last_name = :ln and b.account_number like :act_num";
$stmt = $db->prepare($query);
$stmt->execute([":ln" => $lastName, ":act_num" => "%$act_num2"]);
$yourAccount = se($stmt->fetch(), "id", "", false);
?>
<style>
    h3 {
        color: white;
    }
</style>
<h1>Transfer Funds</h1>
<form onsubmit="return validate(this)" method="POST">
    <div>
        <label for="act_choice">From</label>
        <select name="account1">
        <?php foreach($myAccounts as $a):?>
            <?php if (se($a, "account_type", "", false) != "loan" && se($a, "active", "", false) != 0) : ?>
                <option value="<?php se($a,'id');?>"><?php se($a, "account_number");?></option>
            <?php endif; ?>
        <?php endforeach;?>
        </select>
    </div>
    <h3>Receiver Info</h3>
    <div>
        <label for="last_name">Last Name</label>
        <input type="text" name=last_name required placeholder="Enter receiver's last name."/>
    </div>
    <div>
        <label for="act_choice_2">Number</label>
        <input type="text" name=account2 required placeholder="Enter last 4 digits."/>
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

        $stmt = $db->prepare("SELECT id, account_number, balance FROM Accounts WHERE user_id = :uid AND id = :id");
        $stmt->execute([":uid" => get_user_id(), ":id" => $account_id]);
        $act_1 = $stmt->fetch();

        $hasError = false;

        if (intval($trans) <= 0) {
            flash("Transfer value should be more than $0.", "danger");
            $hasError = true;
        }

        if (intval($trans) > se($act_1, "balance", 0, false)) {
            flash("That value exceeds the account balance!", "warning");
            $hasError = true;
        }

        if (!$hasError) {
            flash("Transfer successful!", "success");
            do_bank_action($account_id, $yourAccount, $trans, "ext-transfer", $memo);
        }
    }
?>
<?php
require_once(__DIR__ . "/../../partials/flash.php");
?>