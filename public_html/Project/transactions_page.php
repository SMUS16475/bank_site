<?php
error_log("data: " . var_export($_GET, true));
require(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);

$db = getDB();
$account_id = se($_GET, "id", -1, false);
$transType = se($_GET, "tran_type", "", false);
$date = se($_GET, "date", "", false);
if(intval($account_id) < 1){
  flash("Invalid account.", "danger");
  redirect("home.php");
}
$params = [":account_id" => $account_id];
$query = "SELECT a.account_type, a.balance, a.account_number as account_src, b.account_number as account_des, bal_change, trans_type, exp_total, t.created FROM Transactions t JOIN Accounts a on t.account_src = a.id JOIN Accounts b on t.account_des = b.id WHERE t.account_src = :account_id";
if(!empty($transType)){
    $query .= " AND trans_type = :t_type";
    $params[":t_type"] = $transType;
}
if (!empty($date)) {
    $query .= " AND t.created = :trans_date";
    $params[":trans_date"] = $date;
}

$query .= " LIMIT 10";
$stmt = $db->prepare($query);
$stmt->execute($params);
$trans = $stmt->fetchAll();

$query = "SELECT distinct trans_type FROM Transactions";
$stmt = $db->prepare($query);
$stmt->execute();
$types = $stmt->fetchAll();

$query = "SELECT created FROM Transactions WHERE created BETWEEN CAST('2021-12-18' AS DATE) AND CAST('2021-12-21' AS DATE)";
$stmt = $db->prepare($query);
$stmt->execute();
$dates = $stmt->fetchAll();

$query = "SELECT account_type FROM Accounts WHERE id = :aid";
$stmt = $db->prepare($query);
$stmt->execute([":aid" => $account_id]);
$daType = $stmt->fetch();
?>

<style>
    #type {
        color: white;
        text-decoration: none;
    }
    .center {
        margin-left: auto;
        margin-right: auto;
    }
    table, th, td {
        order: 3px solid blue;
        border-collapse: collapse;
        text-align: center;
        padding: 10px;
    }
</style>
<h1>Transactions</h1>
<h4>Filter by</h4>
<div>
    <table class="center">
        <thead>
            <th>Account Source</th>
            <th>Account Destination</th>
            <th>Balance Change</th>
            <th>Current Balance</th>
            <th>Account Type</th>
            <th><label>Transaction Type</label></th>
            <form>
                <select name="tran_type">
                    <option value="">All</option>
                    <?php foreach($types as $tran): ?>
                        <option><?php se($tran, "trans_type")?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" value="Filter"/>
                <input type="hidden" name="id" value="<?php se($account_id);?>"/>
            </form>
            <form>
                <select name="date">
                    <option value="">All</option>
                    <?php foreach($dates as $new_date): ?>
                        <option><?php se($new_date, "created")?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" value="Filter"/>
                <input type="hidden" name="id" value="<?php se($account_id);?>"/>
            </form>
            <th>Expected Total</th>
            <th>Date & Time of Transaction</th>
        </thead>
        <tbody>
            <?php if (empty($trans)) : ?>
                <tr>
                    <td colspan="100%">No transactions made.</td>
                </tr>
            <?php else : ?>
                <?php foreach ($trans as $row): ?>
                    <tr>
                        <td><?php se($row, "account_src") ?></td>
                        <td><?php se($row, "account_des") ?></td>
                        <td>$<?php se($row, "bal_change") ?></td>
                        <td>$<?php se($row, "balance") ?></td>
                        <td><?php se($row, "account_type") ?></td>
                        <td><?php se($row, "trans_type") ?></td>
                        <td>$<?php se($row, "exp_total") ?></td>
                        <td><?php se($row, "created") ?></td>
                    </tr>
                <?php endforeach; ?> 
            <?php endif; ?>
        </tbody>
    </table>
    <a href="close_account.php?id=<?php se($account_id); ?>">Close Account</a>
</div>
<?php
require_once(__DIR__ . "/../../partials/flash.php");
?>