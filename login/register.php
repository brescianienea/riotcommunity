<div class="login">
    <div class="container">
        <h1>Create an Account</h1>
        <div id="form">
            <form id="registration_form" onsubmit="return false;" novalidate>

                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                </div>

                <div class="tab" id="mail-tab">
                    <h2>What's your email?</h2>
                    <div class="input-container input-value">
                        <input id="mail" type="text" name="mail" required/>
                        <label for="mail">Email</label>
                    </div>
                </div>

                <div class="tab" id="birth-tab">
                    <h2>When were you born?</h2>
                    <div class="input-container input-value">
                        <div class="date-wrapper">
                            <div class="input-container input-value">
                                <input id="day" autocomplete="false" type="number" name="day" placeholder="GG" min="1"
                                       max="31"
                                       minlength="2"
                                       required/>
                                <label for="day">Day</label>
                            </div>
                            <div class="input-container input-value">
                                <input id="month" autocomplete="false" type="number" name="month" placeholder="MM"
                                       min="1" max="12"
                                       minlength="2"
                                       required/>
                                <label for="month">Month</label>
                            </div>
                            <div class="input-container input-value">
                                <input id="year" autocomplete="false" type="number" name="year" placeholder="YYYY"
                                       min="1" max="9999"
                                       minlength="4"
                                       required/>
                                <label for="year">Year</label>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="tab" id="user-tab">
                    <h2>Choose a Username</h2>
                    <div class="input-container input-value">
                        <input id="username" type="text" name="username" required/>
                        <label for="username">Username</label>
                    </div>
                </div>

                <div class="tab" id="password-tab">
                    <h2>Choose a Password</h2>
                    <div class="input-container input-value">
                        <input id="password" type="password" name="password" required/>
                        <label for="password">Password</label>
                        <button id="show-password">
                        <span class="not-toggled">
                            <?php include('source/icons/eye-slash-solid.svg') ?>
                        </span>
                            <span class="toggled">
                                <?php include('source/icons/eye-solid.svg') ?>
                        </span>
                        </button>
                    </div>

                    <div class="password-requirements">
                        <p class="requirement" id="length">Min. 8 characters</p>
                        <p class="requirement" id="lowercase">Include lowercase letter</p>
                        <p class="requirement" id="uppercase">Include uppercase letter</p>
                        <p class="requirement" id="number">Include number</p>
                        <p class="requirement" id="characters">Include a special character: #.-?!@$%^&*</p>
                    </div>

                    <div class="input-container input-value">
                        <input id="confirm-password" type="password" name="confirm-password" required/>
                        <label for="confirm-password">Confirm Password</label>
                    </div>

                    <div class="password-requirements">
                        <p class="requirement" hidden="hidden" id="match">Passwords must match</p>
                    </div>

                </div>


                <div class="button">
                    <button href="#" disabled id="btnSubmit" type="submit" onclick="nextPrev(1); return false;"
                            class="btn"><?php include('source/icons/arrow-right-solid.svg') ?></button>
                </div>

                <div class="bottom-links">
                    <p><a class="switch" href="#">Forgot username?</a></p>
                    <p><a href="/login-page.php?section=login">Login</a></p>
                </div>
            </form>


        </div>
    </div>
</div>
<script src="../js/login/register.js"></script>

