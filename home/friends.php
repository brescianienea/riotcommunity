<?php
include('query/user/user.php');
include('query/post/post.php');
$friedsIDs = User::getFriendsByID($_SESSION['user_id']);
?>


<?php if (!is_array($friedsIDs) || count($friedsIDs) == 0): ?>
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
    <section class="filters">
    <h2 hidden = "hidden">filters:</h2>
        <div class="select">
            <label for="game_tag">Game: </label>
            <select id="game_tag" name="game_tag" onchange="redirect();">
                <option value="" <?php if (!isset($_GET['game_tag']) || $_GET['game_tag'] == ''): ?> selected <?php endif; ?> >
                    All Games
                </option>
                <option value="lol" <?php if (isset($_GET['game_tag']) && $_GET['game_tag'] == 'lol'): ?> selected <?php endif; ?> >
                    League of Legends
                </option>
                <option value="tft" <?php if (isset($_GET['game_tag']) && $_GET['game_tag'] == 'tft'): ?> selected <?php endif; ?> >
                    Teamfight Tactics
                </option>
                <option value="wildrift" <?php if (isset($_GET['game_tag']) && $_GET['game_tag'] == 'wildrift'): ?> selected <?php endif; ?> >
                    Wild
                    Rift
                </option>
                <option value="valorant" <?php if (isset($_GET['game_tag']) && $_GET['game_tag'] == 'valorant'): ?> selected <?php endif; ?> >
                    VALORANT
                </option>
                <option value="lor" <?php if (isset($_GET['game_tag']) && $_GET['game_tag'] == 'lor'): ?> selected <?php endif; ?> >
                    Legends of
                    Runeterra
                </option>
            </select>
        </div>
        <div class="select">
            <label for="tenor_tag">Topic: </label>
            <select id="tenor_tag" name="tenor_tag" onchange="redirect();">
                <option value="" <?php if (!isset($_GET['tenor_tag']) || $_GET['tenor_tag'] == ''): ?> selected <?php endif; ?> >
                    All Topics
                </option>
                <option value="meme" <?php if (isset($_GET['tenor_tag']) && $_GET['tenor_tag'] == 'meme'): ?> selected <?php endif; ?> >
                    Meme
                </option>
                <option value="question" <?php if (isset($_GET['tenor_tag']) && $_GET['tenor_tag'] == 'question'): ?> selected <?php endif; ?> >
                    Question
                </option>
                <option value="discussion" <?php if (isset($_GET['tenor_tag']) && $_GET['tenor_tag'] == 'discussion'): ?> selected <?php endif; ?> >
                    Discussion
                </option>
                <option value="theory" <?php if (isset($_GET['tenor_tag']) && $_GET['tenor_tag'] == 'theory'): ?> selected <?php endif; ?> >
                    Theory &
                    Lore
                </option>
                <option value="guides" <?php if (isset($_GET['tenor_tag']) && $_GET['tenor_tag'] == 'guides'): ?> selected <?php endif; ?> >
                    Guides &
                    Tips
                </option>
                <option value="cosplay" <?php if (isset($_GET['tenor_tag']) && $_GET['tenor_tag'] == 'cosplay'): ?> selected <?php endif; ?> >
                    Cosplay
                </option>
                <option value="fanart" <?php if (isset($_GET['tenor_tag']) && $_GET['tenor_tag'] == 'fanart'): ?> selected <?php endif; ?> >
                    Fan Art
                </option>
                <option value="news" <?php if (isset($_GET['tenor_tag']) && $_GET['tenor_tag'] == 'news'): ?> selected <?php endif; ?> >
                    News
                </option>
            </select>

        </div>

    </section>
    <section class="post-wrapper">
    <h2 hidden = "hidden">wrapper</h2>
        <?php if (!isset($_GET['tenor_tag'])) {
            $_GET['tenor_tag'] = '';
        }
        if (!isset($_GET['game_tag'])) {
            $_GET['game_tag'] = '';
        }
        ?>
        <?php $postList = Post::getPostsByMultipleIDs($friedsIDs, $_GET['tenor_tag'], $_GET['game_tag']); ?>

        <?php if (is_array($postList) && count($postList) > 0): ?>
            <ul class="post-list">
                <?php foreach ($postList as $post): ?>
                    <li onclick="location.href = '../post.php?post_id=<?= $post['post_id'] ?>'">

                        <section
                        >
                        <h2 hidden = "hidden">icon</h2>
                            <div class="game-icon <?= $post['game_tag'] ?>">
                                <?php include('source/icons/' . $post['game_tag'] . '.svg') ?>
                            </div>

                            <span>Posted by <a
                                        href="../user.php?user_id=<?= $post['post_id'] ?>"><?= User::getUsernameByID($post['member_id'])['username'] ?> </a></span>
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
                <span>No post available</span>
            </article>

        <?php endif; ?>
    </section>
    <script>
        function redirect() {
            var newUrl = new URL(location.protocol + '//' + location.host + location.pathname);
            newUrl.searchParams.append('section', '<?= $_GET['section'] ?>');

            newUrl.searchParams.append('game_tag', $('#game_tag').val())


            newUrl.searchParams.append('tenor_tag', $('#tenor_tag').val())


            window.location.href = newUrl.toString();
        }

    </script>

<?php endif; ?>
