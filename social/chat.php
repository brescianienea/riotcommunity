<?php
require_once('query/message/message.php');
require_once('query/user/user.php');
require_once('query/notification/notification.php');

$conversations = Message::getAllChats($_SESSION['user_id']);

Notification::addNotification($_SESSION['user_id'], 0, 1, true);
?>
<h1 hidden="hidden">Conversations</h1>
<div class="chat-list">
    <?php if (is_array($conversations) && count($conversations) > 0): ?>
        <?php foreach ($conversations as $chat): ?>
            <div>
                <a href="chat.php?user_id=<?= $chat ?>">
                    <img alt="Profile Image" src="source/images/profile/placeholder.webp">
                    <div>
                        <h2><?= User::getUsernameByID($chat)['username'] ?></h2>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <span>No conversations yet...</span>
    <?php endif; ?>
</div>