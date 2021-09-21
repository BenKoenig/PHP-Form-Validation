<?php 

$errors = [];

if(isset($_POST['do-submit'])) {
    if(
        !isset($_POST['firstName'])
        || strlen($_POST['firstName']) < 2
        || strlen($_POST['firstName']) > 100
    ) {
        $errors['firstName'] = "Please enter in a valid first Name.";
    } 

    if(
        !isset($_POST['lastName'])
        || strlen($_POST['lastName']) < 2
        || strlen($_POST['lastName']) > 100
    ) {
        $errors['lastName'] = "Please enter in a valid last Name.";
    } 
    if (!isset($_POST['paymentMethod']) || $_POST['paymentMethod'] === '_default') {
        $errors['paymentMethod'] = 'Please select a payment method.';
    }
}

function printError (string $name) {
    global $errors;
    if(isset($errors[$name])) {
        echo '<div class="error">' . $errors[$name] . '</div>';
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
    <form method="post" class="form" novalidate >
        <div class="form__field">
            <label for="name">First Name</label>
            <input type="text" name="firstName" id="firstName" required value="<?php old('firstName') ?>">
            <div>
                <?php
                printError("firstName");
                ?>
            </div>
       
        </div>

        <div class="form__field">
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" id="lastName" required value="<?php old('lastName') ?>">
            <div>
                <?php
                printError("lastName");
                ?>
            </div>

        </div>

        <div class="form__field">
            <label for="paymentMethod">Payment Method</label>
            <select name="paymentMethod" id="paymentMethod">
                <option value="_default" disabled selected>Please select a method</option>
                <option value="paypal">PayPal</option>
                <option value="googlepay">Google Pay</option>
                <option value="mastercard">MasterCard</option>
                <option value="visa">Visa</option>
            </select>
            <div>
                <?php printError("paymentMethod"); ?>
            </div>


        </div>
        <div class="form__field">
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
