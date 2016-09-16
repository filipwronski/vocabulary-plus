<?php
require 'requires.php';
require 'Controller/EditController.php';
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
    <input type="text" placeholder="Podaj adres www" name="website">
    <br><br>
    <input type="text" placeholder="Podaj nazwe klasy zawierającą słowo" name="className">
    <br><br>
    <input type="submit" name="submit" value="Submit">  
</form>