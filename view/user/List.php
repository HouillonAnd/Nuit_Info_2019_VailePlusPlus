<div><h1>Gestion des utilisateurs</h1>
    <div>
<?php
	foreach ($tab_user as $user) {
        echo '<div>
                <div style="background-image: url('. $user->get('profilePicture') .')"></div>
                <div>
                    <h4 id="user_name">'  . htmlspecialchars($user->get('userFirstName')) . " " . htmlspecialchars($user->get('userName')) . '</h4>
                    <a href="index.php?controller=user&action=update&mail=' . rawurlencode($user->get('userMail')) . '">Update</a>
                </div>
            </div>' ;
    }
?>
    </div>
</div>
