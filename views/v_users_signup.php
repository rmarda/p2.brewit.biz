<!--
<form method='POST' action='/users/p_signup'>

    First Name <br>
    <input type='text' name='first_name'>
    <br><br>

    Last Name<br>
    <input type='text' name='last_name'>
    <br><br>

    Email<br>
    <input type='text' name='email'>
    <br><br>

    Password<br>
    <input type='password' name='password'>
    <br><br>

    <input type='submit' value='Sign up'>

</form>
-->
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
                        <input type="submit" value="Sign up" />
                    </section>
                </fieldset>
            </form>
        </div>
    </article>

</section>
