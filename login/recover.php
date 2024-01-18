<div class="login">
    <div class="container">
        <h1>Recover Your Account</h1>
        <div id="form">
            <form id="recover_password_form" novalidate>
                <div class="input-container input-value">
                    <input type="text" name="username" required/>
                    <label for="username">Username</label>
                </div>

                <div class="button">
                    <button href="#" id="submit" type="submit"
                            class="btn"><?php include('source/icons/arrow-right-solid.svg') ?></button>
                </div>

                <div class="bottom-links">
                    <p><a class="switch" href="#">Forgot username?</a></p>
                    <p><a href="/login-page.php?section=login">Login</a></p>
                </div>
            </form>

            <form id="recover_username_form" novalidate hidden>
                <div class="input-container input-value">
                    <input id="mail" type="text" name="mail" required/>
                    <label for="mail">Email</label>
                </div>

                <div class="button">
                    <button href="#" id="submit" type="submit"
                            class="btn"><?php include('source/icons/arrow-right-solid.svg') ?></button>
                </div>

                <div class="bottom-links">
                    <p><a class="switch" href="#">Forgot Password?</a></p>
                    <p><a href="/login-page.php?section=login">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../js/login/recover.js"></script>
