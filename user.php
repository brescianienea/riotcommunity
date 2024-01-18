<?php
include('query/user/user.php');
include('query/post/post.php');
$userInfo = User::getUserInfoByID($_GET['user_id']);
if (isset($_SESSION['user_id']) && $_GET['user_id'] == $_SESSION['user_id']) {
    header("Location: /profile-page.php?profile");
    exit();
}
?>
<!DOCTYPE html>
<html lang='en'>
<?php include('head.php'); ?>
<body>
<?php include('header.php'); ?>
</header>
<main>
    <div class='column'>
        <div class='wrapper post'>
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
                                data-url="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>"
                                   href=""><?php include('source/icons/facebook.svg') ?></a>
                            </li>
                            <li>
                                <a class="share-twitter"
                                data-url="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>"
                                   href="#"><?php include('source/icons/x-twitter.svg') ?></i></a>
                            </li>
                            <li>
                                <a class="share-whatsapp"
                                data-url="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>"
                                   href="#"><?php include('source/icons/whatsapp.svg') ?></i></a>
                            </li>
                            <li>
                                <a class="share-telegram"
                                data-url="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>"
                                   href="#"><?php include('source/icons/telegram.svg') ?></a>
                            </li>
                        </ul>
                        <p>Or copy link</p>
                        <div class="field">
                            <?php include('source/icons/link-solid.svg') ?>
                            <input type="text" readonly
                                   value="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">
                            <button>Copy</button>
                        </div>
                    </div>
                </div>

                <section class="profile-title">
                <h2 hidden = "hidden">title</h2>
                    <img alt="Profile Image" src="source/images/profile/placeholder.webp">
                    <div>
                        <h1><?= User::getUsernameByID($_GET['user_id'])['username'] ?></h1>

                    </div>
                    <a id="share-profile">
                        <?php include('source/icons/share-nodes-solid.svg') ?>
                    </a>
                    <div class="actions">
                        <button class="message-button">Message</button>
                        <?php if (in_array($_GET['user_id'], User::getFriendsByID($_SESSION['user_id']))): ?>
                            <form hidden="hidden">
                                <input name="user_id" id="user_id" value="<?= $_GET['user_id'] ?>">
                            </form>
                            <button id="revoke_friendship">Remove Friend</button>

                        <?php elseif (in_array($_GET['user_id'], User::getFriendRequestSent($_SESSION['user_id']))): ?>
                            <form hidden="hidden">
                                <input name="user_id" id="user_id" value="<?= $_GET['user_id'] ?>">
                            </form>
                            <button id="revoke_request">Request Sent</button>

                        <?php else: ?>
                            <form hidden="hidden">
                                <input name="user_id" id="user_id" value="<?= $_GET['user_id'] ?>">
                            </form>
                            <button id="send_request">Send Request</button>

                        <?php endif; ?>
                    </div>
                </section>
                <section class="post-wrapper">
                <h2 hidden = "hidden">wrapper</h2>
                    <?php $postList = Post::getPostsByID($_GET['user_id']); ?>

                    <?php if (is_array($postList)): ?>
                        <ul class="post-list">
                            <?php foreach ($postList as $post): ?>
                                <li onclick="location.href = '../post.php?post_id=<?= $post['post_id'] ?>'">

                                    <section>
                                    <h2 hidden = "hidden">game icons</h2>
                                        <div class="game-icon <?= $post['game_tag'] ?>">
                                            <?php include('source/icons/' . $post['game_tag'] . '.svg') ?>
                                        </div>

                                        <span>Posted by <a><?= User::getUsernameByID($post['member_id'])['username'] ?> </a></span>
                                        <span class="topic"><?= $post['tenor_tag'] ?></span>
                                    </section>
                                    <h2><?= $post['title'] ?></h2>

                                </li>
                            <?php endforeach; ?>
                        </ul>

                    <?php else: ?>
                        <article class="centered">
                            <?php include('source/icons/photo-film-solid.svg') ?>
                            <span>You haven't posted anything yet.</span>
                            <a href="new-post.php">Post Now</a>
                        </article>

                    <?php endif; ?>
                </section>


            </div>


            <script>
                $('#send_request').on('click', function () {
                    $(this).closest('form')
                    {
                        $.ajax({

                            method: "POST",
                            url: "/query/user/addFriendRequest.php",
                            data: $('form').serialize(),
                            success: function (data) {
                                console.log(data);
                                let result = JSON.parse(data);
                                if (result['message'] === 'success') {

                                } else {
                                    alert(result['message']);
                                }


                            }

                        });
                    }
                    location.reload();
                });

                $('.message-button').on('click', function () {
                    window.location = '/chat.php?user_id=<?= $_GET['user_id'] ?>'
                })

                $('#revoke_request').on('click', function () {
                    $(this).closest('form')
                    {
                        $.ajax({

                            method: "POST",
                            url: "/query/user/deleteFriendRequest.php",
                            data: $('form').serialize(),
                            success: function (data) {
                                console.log(data);
                                let result = JSON.parse(data);
                                if (result['message'] === 'success') {

                                } else {
                                    alert(result['message']);
                                }


                            }

                        });
                    }
                    location.reload();
                });

                $('#revoke_friendship').on('click', function () {
                    $(this).closest('form')
                    {
                        $.ajax({

                            method: "POST",
                            url: "/query/user/deleteFriend.php",
                            data: $('form').serialize(),
                            success: function (data) {
                                console.log(data);
                                let result = JSON.parse(data);
                                if (result['message'] === 'success') {

                                } else {
                                    alert(result['message']);
                                }


                            }

                        });
                    }

                    location.reload();
                });


                const viewBtn = document.querySelector("#share-profile"),
                    popup = document.querySelector(".popup"),
                    close = popup.querySelector(".close"),
                    field = popup.querySelector(".field"),
                    input = field.querySelector("input"),
                    copy = field.querySelector("button");

                viewBtn.onclick = () => {
                    popup.classList.toggle("show");
                }
                close.onclick = () => {
                    viewBtn.click();
                }

                copy.onclick = () => {
                    input.select(); //select input value
                    if (document.execCommand("copy")) { //if the selected text is copied
                        field.classList.add("active");
                        copy.innerText = "Copied";
                        setTimeout(() => {
                            window.getSelection().removeAllRanges(); //remove selection from page
                            field.classList.remove("active");
                            copy.innerText = "Copy";
                        }, 3000);
                    }
                }

                $('.share-facebook').on('click', function () {
                    let currentURL = $(this).attr('url');
                    window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(currentURL), 'facebook-share');

                });

                $('.share-whatsapp').on('click', function () {
                    let currentURL = $(this).attr('url');
                    let encodedURL = encodeURIComponent(currentURL);

                    let whatsappURL = "https://wa.me/?text=Check out this page: " + encodedURL;

                    window.open(whatsappURL);

                });

                $('.share-telegram').on('click', function () {
                    var currentURL = $(this).attr('url');
                    var encodedURL = encodeURIComponent(currentURL);

                    var telegramURL = "tg://msg?text=Check out this page: " + encodedURL;

                    window.open(telegramURL);

                });

                $('.share-twitter').on('click', function () {
                    const currentURL = $(this).attr('url');

                    window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(currentURL), 'twitter-share');
                })
            </script>

        </div>

    </div>
    <?php include('navbar.php'); ?>
</main>

</body>
<?php include('footer.php'); ?>


</html>