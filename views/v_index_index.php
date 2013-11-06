<?php if($user):?>

   <?php Router::redirect('/users/profile'); ?>

<?php else:?>

    <!-- Main area content composing of Welcome note and sign in -->
    <section id="feature_area">

        <!-- Welcome Note-->
        <article>
            <div class="inner" id="about">
                <h3>Welcome!</h3>
                <p>Welcome to my Micro Blog. This app enables users to write posts and view posts from other users. Please <span style="color:orange">sign in</span> on the right hand side pane if you are an existing user or <a href='/users/signup' >register </a> with us.</p>

            </div>
        </article>

        <!-- Sign in into this Micro Blog -->
        <article>
            <div class="inner" id="login">
                <h3>Please Sign In</h3><br />
                <form id="siginform" action ="/users/p_login" method="post">
                    <fieldset>
                        <p class="note">* indicates required field</p>
                        <section id="email">
                            <label for="email" >Email<span> *</span></label>
                            <input type="text" name="email" />
                        </section>
                        <section id="password">
                            <label for="password">Password<span> *</span></label>
                            <input type="password" name="password" maxlength="20" />
                        </section>
                        <?php if(isset($error)): ?>
                            <div class='note'>
                                Login failed. Please double check your email and password.
                            </div>
                            <br>
                        <?php endif; ?>
                        <?php $error = NULL; ?>
                        <section>
                            <input type="submit" value="Submit" />
                        </section>
                    </fieldset>
                </form>
            </div>
        </article>
    </section>

<?php endif;?>