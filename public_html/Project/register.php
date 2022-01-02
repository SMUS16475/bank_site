<?php
require(__DIR__ . "/../../partials/nav.php");
reset_session();
?>
<form onsubmit="return validate(this)" method="POST">
    <h1>Register</h1>
    <div>
        <label for="firstname">First Name</label>
        <input type="text" name="firstname" id="firstname" required value="<?php if (isset($_POST['firstname'])) {echo $_POST['firstname']; } ?>" />
    </div>
    <div>
        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" id="lastname" required value="<?php if (isset($_POST['lastname'])) {echo $_POST['lastname']; } ?>" />
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required value="<?php if (isset($_POST['email'])) {echo $_POST['email']; } ?>" />
    </div>
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required value="<?php if (isset($_POST['username'])) {echo $_POST['username'];} ?>" maxlength="30" />
    </div>
    <div>
        <label for="pw">Password</label>
        <input type="password" id="pw" name="password" required minlength="8" />
    </div>
    <div>
        <label for="confirm">Confirm</label>
        <input type="password" name="confirm" required minlength="8" />
    </div>
    <input type="submit" value="Register" />
</form>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success
        let pw = form.password.value;
        let un = form.username.value;
        let em = form.email.value;
        var lC = /[a-z]/i;
        var uC = /[A-Z]/i;
        var num = /[0-9]/g;
        return true;
    }
</script>
<?php
//TODO 2: add PHP Code
if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm"])) {
    $firstName = se($_POST, "firstname", "", false);
    $lastName = se($_POST, "lastname", "", false);
    $email = se($_POST, "email", "", false);
    $password = se($_POST, "password", "", false);
    $username = se($_POST, "username", "", false);
    $confirm = se($_POST, "confirm", "", false);
    // $username = se($_POST, "username", "", false);
    //TODO 3
    $hasError = false;
    if (empty($email)) {
        flash("Email must not be empty", "danger");
        $hasError = true;
    }
    //sanitize
    $email = sanitize_email($email);
    //validate
    if (!is_valid_email($email)) {
        flash("Invalid email address", "danger");
        $hasError = true;
    }
    if (!preg_match('/^[a-z0-9_-]{3,16}$/i', $username)) {
        flash("Username must only be alphanumeric and can only contain - or _", "danger");
        $hasError = true;
    }
    if (empty($password)) {
        flash("password must not be empty", "danger");
        $hasError = true;
    }
    if (empty($confirm)) {
        flash("Confirm password must not be empty", "danger");
        $hasError = true;
    }
    if (strlen($password) < 8) {
        flash("Password too short", "danger");
        $hasError = true;
    }
    if (strlen($password) > 0 && $password !== $confirm) {
        flash("Passwords must match", "danger");
        $hasError = true;
    }
    if (!$hasError) {
        //TODO 4
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Users (email, password, username, first_name, last_name) VALUES(:email, :password, :username, :fn, :ln)");
        try {
            $stmt->execute([":email" => $email, ":password" => $hash, ":username" => $username, ":fn" => $firstName, ":ln" => $lastName]);
            flash("Successfully registered!");
        } catch (Exception $e) {
            users_check_duplicate($e->errorInfo);
        }
    }
}
?>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>