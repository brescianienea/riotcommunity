<?php
require_once('query/notification/notification.php');
$current_url = explode("?", $_SERVER['REQUEST_URI']);
$current_url = $current_url[0];
$notifications = '';
if ($_SESSION['logged'] == 'true') {
    $notifications = Notification::getNotificationsByID($_SESSION['user_id']);

}


?>
<nav class="">
    <ul class="nav navbar-nav">
        <li><a href="home.php?" class="<?php if ($_SESSION['page'] == 'feed'): ?> _selected <?php endif; ?>">
                <?php include('source/icons/newspaper-solid.svg'); ?>
                Feed</a></li>
        <li><a href="new-post.php?" class="<?php if ($_SESSION['page'] == 'new-post'): ?> _selected <?php endif; ?>">
                <?php include('source/icons/square-plus-solid.svg'); ?>
                New Post</a></li>
        <li><a href="social.php?" class="<?php if ($_SESSION['page'] == 'social'): ?> _selected <?php endif; ?>
        <?php if (!empty($notifications)) : ?> <?php if ($notifications['friendreq_notification'] > 0 || $notifications['chat_notification'] > 0): ?> notify <?php endif; ?> <?php endif; ?>
                                          ">
                <?php include('source/icons/comments-solid.svg'); ?>

                Social</a></li>
        <li><a href="profile-page.php?" class="<?php if ($_SESSION['page'] == 'profile'): ?> _selected <?php endif; ?>">
                <?php include('source/icons/user-solid.svg'); ?>
                Profile</a></li>
    </ul>
</nav>
