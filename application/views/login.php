<h2><?php if (isset($title)) {echo $title;} ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('login/login_user'); //mando i dati al controller?> 

    <label for="username">username</label>
    <input type="input" name="username" /><br />

    <label for="password">password</label>
    <input type="password" name="password" value="admin"></input><br />

    <input type="submit" name="submit" value="Accedi" />
    <label><?if (isset($error)){echo $error;}?></label>
</form>