<?php if(isset($added)): ?>
    <div>
        Post successfully added. Add another?
    </div>
    <br>
<?php endif; ?>

<form method = 'post' action ='/posts/p_add'>

    <textarea name= 'content'></textarea>

    <input type='Submit' value='Add new post'>

</form>