<?php
include('query/user/user.php');
include('query/message/message.php');
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
        <div class='wrapper chat'>
            <div class="chat-header">
                <a href="user.php?user_id=<?= $_GET['user_id'] ?>">
                    <img alt="Profile Image" src="source/images/profile/placeholder.webp">
                    <div>
                        <h1><?= User::getUsernameByID($_GET['user_id'])['username'] ?></h1>

                    </div>
                </a>

            </div>
            <div class="chat">
                <?php $messages = Message::getMessagesSent($_GET['user_id'], $_SESSION['user_id']) ?>
                <div class="message-wrapper">
                    <?php foreach ($messages as $message): ?>
                        <div class="message <?= $message['sender_id'] == $_SESSION['user_id'] ? 'sent' : 'received' ?>">
                         <span>
                            <?= $message['content'] ?>
                        </span>

                        </div>

                    <?php endforeach; ?>
                </div>

                <form>
                    <label hidden="hidden" for="message-text">message</label>
                    <label hidden="hidden" for="receiver_id">receiver id</label>
                    <input type="text" hidden="hidden" name="receiver_id" id="receiver_id"
                           value="<?= $_GET['user_id'] ?>">
                    <textarea name="message-text" id="message-text" placeholder="Type..."></textarea>
                    <button id="submit"><?php include('source/icons/arrow-up-solid.svg') ?></button>
                </form>

            </div>


        </div>
        <script>
            $('#submit').on('click', function (e) {
                e.preventDefault();
                $(this).closest('form')
                {
                    $.ajax({
                        method: "POST",
                        url: "/query/message/addMessage.php",
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

                    location.reload();
                }

            });

            $('form').on('submit', function (e) {
                e.preventDefault();
            });


        </script>


    </div>
    <?php include('navbar.php'); ?>
</main>

</body>
<?php include('footer.php'); ?>


</html>