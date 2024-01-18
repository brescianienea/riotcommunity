<?php include('query/user/user.php');
require_once('query/notification/notification.php');
Notification::addNotification($_SESSION['user_id'], 1, 0, true);
?>
<h1 hidden="hidden">Friend Requests</h1>
<section class="requests-container">
<h2 hidden = "hidden">container</h2>
    <?php
    $received = User::getFriendRequestReceived($_SESSION['user_id']);
    if (is_array($received) && count($received) > 0): ?>
        <section class="received">
            <h2>Received Requests</h2>
            <?php foreach ($received as $r): ?>
                <div>
                    <span><?= User::getUsernameByID($r)['username'] ?></span>
                    <button user_id="<?= $r ?>" class="deny"><?php include('source/icons/xmark-solid.svg') ?></button>
                    <button user_id="<?= $r ?>"
                            class="approve"><?php include('source/icons/check-solid.svg') ?></button>

                </div>
            <?php endforeach; ?>

        </section>
    <?php endif; ?>
    <?php
    $sended = User::getFriendRequestSent($_SESSION['user_id']);
    if (is_array($sended) && count($sended) > 0): ?>
        <section class="sended">
            <h2>Sended Requests</h2>
            <?php foreach ($sended as $s): ?>
                <div>
                    <span><?= User::getUsernameByID($s)['username'] ?></span>
                </div>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
    <?php if ((!is_array($sended) || count($sended) == 0) && (!is_array($received) || count($received) == 0)): ?>
        No friend requests at the moment...
    <?php endif; ?>
</section>
<script src="../js/social/requests.js"></script>