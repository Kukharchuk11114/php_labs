<?php
include_once "classes/Page.php";
include_once "classes/Pdo_.php";

Page::display_header("Main page");

$Pdo = new Pdo_();

// adding new user
if (isset($_REQUEST['add_user'])) {
    $login = $_REQUEST['login'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $password2 = $_REQUEST['password2'];
    if ($password == $password2) {
        $Pdo->add_user($login, $email, $password);
    } else {
        echo 'Passwords doesn\'t match';
    }
}

// change password
if (isset($_REQUEST['change_password']))
{
    $login = $_REQUEST['loginNewpass'];
    $password = $_REQUEST['passwordCh'];
    $password2 = $_REQUEST['passwordCh2'];
    if ($password == $password2)
    {
        $Pdo->change_pass($login, $password);
    }
    else
    {
        echo 'Passwords doesn\'t match';
    }
}
// LOGINSS new user
if (isset($_REQUEST['log_user_in'])) {
    $login = $_REQUEST['login'];

    $password = $_REQUEST['password'];
    $Pdo->log_user_in($login, $password);
}
?>
<H2> Main page</H2>
<!---------------------------------------------------------------------->
<hr>
<P> Register new user</P>
<form method="post" action="index.php">
    <table>
        <tr>
            <td>login</td>
            <td>
                <label for="name"></label>
                <input required type="text" name="login" id="login" size="40" />
            </td>
        </tr>
        <tr>
            <td>email</td>
            <td>
                <label for="name"></label>
                <input required type="text" name="email" id="email" size="40" />
            </td>
        </tr>
        <tr>
            <td>password</td>
            <td>
                <label for="name"></label>
                <input required type="text" name="password" id="password" size="40" />
            </td>
        </tr>
        <tr>
            <td>repeat password</td>
            <td>
                <label for="name"></label>
                <input required type="text" name="password2" id="password2" size="40" />
            </td>
        </tr>
    </table>
    <input type="submit" id="submit" value="Create account" name="add_user">
</form>
<!---------------------------------------------------------------------->
<hr>
<P> Log in</P>
<form method="post" action="index.php">
    <table>
        <tr>
            <td>login</td>
            <td>
                <label for="name"></label>
                <input required type="text" name="login" id="login" size="40" value="" />
            </td>
        </tr>
        <tr>
            <td>password</td>
            <td>
                <label for="name"></label>
                <input required type="text" name="password" id="password" size="40" value="" />
            </td>
        </tr>
    </table>
    <input type="submit" id="submit" value="Log in" name="log_user_in">
</form>
<!---------------------------------------------------------------------->
<h3>Change password</h3>
    <form method="post" action="index.php">
        <table>
            <tr>
                <td>Login</td>
                <td>
                    <input type="text" name="login" maxlength="40" required>
                </td>
            </tr>
            <tr>
                <td>New Password</td>
                <td>
                    <input type="password" name="passwordCh" maxlength="255" required>
                </td>
            </tr>
            <tr>
                <td>Confirm Password</td>
                <td>
                    <input type="password" name="passwordCh2" maxlength="255" required>
                </td>
            </tr>
        </table>
        <input type="submit" name="change_password" value="Change Password">
    </form>
    <hr>
<?php
Page::display_navigation();
?>
</body>

</html>