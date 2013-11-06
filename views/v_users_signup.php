
<section id="feature_area">
    <article>
        <div class="inner" id="registration">
            <h3>Registration</h3><br />
            <form id="siginform" action ="/users/p_signup" method="POST">
                <fieldset>
                    <p class="note">* indicates required field</p>
                    <section id="first_name">
                        <label for="first_name">First Name<span> *</span></label>
                        <input type="text" name="first_name" />
                    </section>
                    <section id="last_name">
                        <label for="last_name" >Last Name<span> *</span></label>
                        <input type="text" name="last_name" />
                    </section>
                    <section id="email">
                        <label for="email" >Email<span> *</span></label>
                        <input type="text" name="email" />
                    </section>
                    <section id="password">
                        <label for="password">Password<span> *</span></label>
                        <input type="password" name="password" maxlength="20" />
                    </section>
                    <section>
                    <input type='hidden' name='timezone'>
                    <script>
                        $('input[name=timezone]').val(jstz.determine().name());
                    </script>
                    </section>

                    <?php if(isset($error) && $error == 'errorEmptyField'): ?>
                        All fields area required.
                        <br>
                    <?php endif; ?>

                    <?php if(isset($error) && $error == 'errorDupEmail'): ?>
                        An account with this email already exists.
                        <br>
                    <?php endif; ?>

                    <section>
                        <input type="submit" value="Sign up" />
                    </section>
                </fieldset>
            </form>
        </div>
    </article>

</section>
