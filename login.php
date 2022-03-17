<?php
include_once 'header.php';
?>

<section class="signup-form page-content">
    <h2>Log In</h2>
    <div class="signup-form-form">
        <form action="login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username/Email..." />
            <input type="passsword" name="pwd" placeholder="Password..." />
            <button type="submit" name="submit">Log In</button>
        </form>
    </div>
</section>

<?php
include_once 'footer.php';
?>