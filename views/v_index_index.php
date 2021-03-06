<!-- Main area content. Contains Welcome note and sign in form -->
<section id="feature_area">

    <!-- Welcome Note-->
    <article>
        <div class="inner" id="about">
            <h3>Welcome!</h3>
            <p>Welcome to my Micro Blog. This app enables users to write posts and view posts from other users. Please <span style="color:orange">sign in</span> on the right hand side pane if you are an existing user or <a href='/users/signup' >register here. </a> </p><br>

            <p><span style="color:orange">+1 Features: edit post and delete post</span> </p>

        </div>
    </article>

    <!-- Sign in into this Micro Blog -->
    <article>
        <div class="inner" id="login">
            <h3>Please Sign In</h3><br />
            <form id="siginform" action ="/users/p_login" method="post">
                <fieldset>
                    <p class="note">* indicates required field</p>
                    <section id="email" class= clearfix>
                        <label for="email" >Email<span> *</span></label>
                        <input type="text" name="email" />
                    </section>
                    <section id="password" class = clearfix>
                        <label for="password">Password<span> *</span></label>
                        <input type="password" name="password" maxlength="20" />
                    </section>
                    <?php if(isset($error)): ?>
                        <p class="showerror">Wrong user name or password</p>
                        <br>
                    <?php endif; ?>
                    <section>
                        <input type="submit" value="Submit" />
                    </section>
                </fieldset>
            </form>
        </div>
    </article>
</section>

