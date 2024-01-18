<?php include('query/user/user.php');
$friends = User::getFriendsByID($_SESSION['user_id']);
?>
<h1 hidden="hidden">Friends</h1>
<?php if (!is_array($friends) || count($friends) == 0): ?>
    <section class="centered">
    <h2 hidden = "hidden">center</h2>
        <article>
        <h2 hidden = "hidden">icons</h2>
            <?php include('source/icons/circle-exclamation-solid.svg'); ?>
            <p>You really need to make some friends...</p>
            <a href="../social.php?section=requests">Friend requests</a>
        </article>
    </section>
<?php else: ?>
    <ul class="friend-list">
        <?php foreach ($friends as $friend): ?>
            <li>
                <a href="../user.php?user_id=<?= $friend ?>">
                    <img alt="Profile Image" src="source/images/profile/placeholder.webp">
                    <div>
                        <h2><?= User::getUsernameByID($friend)['username'] ?></h2>
                    </div>
                </a>

            </li>

        <?php endforeach; ?>
    </ul>
<?php endif; ?>
