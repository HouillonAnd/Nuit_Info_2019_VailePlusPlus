<form method="get" action="index.php">
    <fieldset>
        <input type='hidden' name='controller' value="user">
        <input type='hidden' name='action' value="<?php if (!isset($isCreating)) {echo'updated';}else{echo 'created';}?>">
        <legend><?php if (!isset($isCreating)) {echo'Modify';}else{echo 'Register';}?></legend>
        <p>
            <label for="update_mail_input">Mail</label> :
            <input value="<?php if (!isset($isCreating)) {echo htmlspecialchars($u->get('userMail'));}?>" type="email" name="mail" id="update_mail_input" <?php if (isset($isCreating)) {echo 'required';} else {echo 'readonly';}?>>
        </p>
        <p>
            <label for="update_login_input">Username</label> :
            <input value="<?php if (!isset($isCreating)) {echo htmlspecialchars($u->get('login'));}?>" type="text" name="login" id="update_login_input" required>
        </p>
        <p>
            <label for="update_firstname_input">First Name</label> :
            <input value="<?php if (!isset($isCreating)) {echo htmlspecialchars($u->get('userFirstName'));}?>" type="text" name="firstname" id="update_firstname_input" required>
        </p>
        <p>
            <label for="update_name_input">Name</label> :
            <input value="<?php if (!isset($isCreating)) {echo htmlspecialchars($u->get('userName'));}?>" type="text" name="name" id="update_name_input" required>
        </p>
        <?php
        if (!(!isset($isCreating) && Session::is_admin() && $u->get('userMail')!=$_SESSION['userMail'])) {
            echo '
            <p>
                <label for="update_password_input">Password</label> :
                <input type="password" name="password" id="update_password_input" required>
            </p>
            <p>
                <label for="update_confirm_password_input">Confirm password</label> :
                <input type="password" name="confirm_password" id="update_confirm_password_input" required>
            </p>';
            }
        if (!isset($isCreating)) {
            echo '<p>
                <label for="update_picture_input">Profile picture (link)</label> :
                <input type="text" name="picture" id="update_picture_input">
                </p>';
            }
        if (!isset($isCreating) && Session::is_admin() && $u->get('userMail')!=$_SESSION['userMail']) {
            echo '<p>
                <label for="update_admin_input">IsAdmin :
                    <input type="checkbox" name="isAdmin" id="update_admin_input" value="false"/>
                    <span></span>
                </label>
                </p>';
        }
            ?>
        <p>
            <input class="btn red" type="submit" value="<?php if (!isset($isCreating)) {echo'Update';}else{echo 'Register';}?>" />
        </p>
    </fieldset>
</form>
