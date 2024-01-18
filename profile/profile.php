<?php
include('query/user/user.php');
include('query/post/post.php');
$userInfo = User::getUserInfoByID($_SESSION['user_id']);
$username = User::getUsernameByID($_SESSION['user_id'])['username'];
?>
<div class="profile">
    <div class="popup">
        <div class="heading">
            <span>Share Modal</span>
            <div class="close"><?php include('source/icons/xmark-solid.svg') ?></i></div>
        </div>
        <div class="content">
            <p>Share this link via</p>
            <ul class="icons">
                <li>
                    <a class="share-facebook"
                    data-url="https://<?= $_SERVER['HTTP_HOST'] . '/user.php?user_id=' . $_SESSION['user_id'] ?>"
                       href=""><?php include('source/icons/facebook.svg') ?></a>
                </li>
                <li>
                    <a class="share-twitter"
                    data-url="https://<?= $_SERVER['HTTP_HOST'] . '/user.php?user_id=' . $_SESSION['user_id'] ?>"
                       href="#"><?php include('source/icons/x-twitter.svg') ?></i></a>
                </li>
                <li>
                    <a class="share-whatsapp"
                    data-url="https://<?= $_SERVER['HTTP_HOST'] . '/user.php?user_id=' . $_SESSION['user_id'] ?>"
                       href="#"><?php include('source/icons/whatsapp.svg') ?></i></a>
                </li>
                <li>
                    <a class="share-telegram"
                    data-url="https://<?= $_SERVER['HTTP_HOST'] . '/user.php?user_id=' . $_SESSION['user_id'] ?>"
                       href="#"><?php include('source/icons/telegram.svg') ?></a>
                </li>
            </ul>
            <p>Or copy link</p>
            <div class="field">
                <?php include('source/icons/link-solid.svg') ?>
                <label hidden="hidden" for="popup-link">copy</label>
                <input id="popup-link" type="text" readonly
                       value="https://<?= $_SERVER['HTTP_HOST'] . '/user.php?user_id=' . $_SESSION['user_id'] ?>">
                <button>Copy</button>
            </div>
        </div>
    </div>

    <section class="profile-title">
    <h2 hidden = "hidden">image</h2>
        <img alt="Profile Image" src="../source/images/profile/placeholder.webp">
        <h1><?= $username ?></h1>
        <a id="share-profile">
            <?php include('source/icons/share-nodes-solid.svg') ?>
        </a>
    </section>
    <section class="post-wrapper">
    <h2 hidden = "hidden">wrapper</h2>
        <?php $postList = Post::getPostsByID($_SESSION['user_id']); ?>

        <?php if (is_array($postList)): ?>
            <ul class="post-list">
                <?php foreach ($postList as $post): ?>
                    <li onclick="location.href = '../post.php?post_id=<?= $post['post_id'] ?>'">

                        <section
                        >
                        <h2 hidden = "hidden">icon</h2>
                            <div class="game-icon <?= $post['game_tag'] ?>">
                                <?php include('source/icons/' . $post['game_tag'] . '.svg') ?>
                            </div>

                            <span>Posted by <a><?= User::getUsernameByID($post['member_id'])['username'] ?> </a></span>
                            <span class="topic">
                                <?= $post['tenor_tag'] ?>
                            </span>
                        </section>
                        <h2><?= $post['title'] ?></h2>

                    </li>
                <?php endforeach; ?>
            </ul>

        <?php else: ?>
            <article class="centered">
                <?php include('source/icons/photo-film-solid.svg') ?>
                <span>You haven't posted anything yet.</span>
                <a href="../new-post.php">Post Now</a>
            </article>

        <?php endif; ?>
    </section>


</div>
<script src="../js/profile/profile.js"></script>