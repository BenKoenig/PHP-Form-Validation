<?php 

$errors = [];

if(isset($_POST['do-submit'])) {
    if(
        !isset($_POST['firstName'])
        || strlen($_POST['firstName']) < 2
        || strlen($_POST['firstName']) > 100
        || is_numeric($_POST['firstName'])
        
    ) {
        $errors['firstName'] = "Please enter in a valid first Name.";
    } 

    if(
        !isset($_POST['lastName'])
        || strlen($_POST['lastName']) < 2
        || strlen($_POST['lastName']) > 100
        || is_numeric($_POST['lastName'])
    ) {
        $errors['lastName'] = "Please enter in a valid last Name.";
    } 

}

function printError (string $name) {
    global $errors;
    if(isset($errors[$name])) {
        echo '<div class="error" style="background-color: #f86161; padding: 5px">' . $errors[$name] . '</div>';
    }
}

function old (string $name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>

<?php

    if(!empty($errors) || !isset($_POST['do-submit'])):?>
    <form method="post" novalidate>
        <div>
            <label for="name">First Name</label>
            <input type="text" name="firstName" id="firstName" required value="<?php old('firstName') ?>">
            <?php
            printError("firstName");
            ?>
        </div>

        <div>
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" id="lastName" required value="<?php old('lastName') ?>">
            <?php
            printError("lastName");
            ?>
        </div>

        <div>
            <label for="paymentMethod">Payment Method</label>
            <select name="paymentMethod" id="paymentMethod">
                <option value="_default" disabled selected>Please select a method</option>
                <option value="paypal">PayPal</option>
                <option value="googlepay">Google Pay</option>
                <option value="mastercard">MasterCard</option>
                <option value="visa">Visa</option>
            </select>
        </div>
        <div>
            <label for="street">Street</label>
            <input type="text" name="street" id="street">
        </div>
        <div>
            <button type="submit" name="do-submit" value="do-submit">Send</button>
        </div>
    </form>
<?php else: ?>
    Vielen dank für ihre Nachricht.
<?php endif; ?>
