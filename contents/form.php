<?php 

$errors = [];

if(isset($_POST['do-submit'])) {
    if(
        !isset($_POST['gender'])
    ){
        $errors['gender'] = "Please select a gender.";
    }
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
    if(!isset($_POST['tos'])){
        $errors['tos'] = "You must accept the terms of service";
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
            <p>Select your gender</p>
            <fieldset>
                <div>
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">Female</label>
                </div>
                <div>
                    <input type="radio" id="male" name="gender" value="male">
                    <label for="male">Male</label>
                </div>
                <div>
                    <input type="radio" id="non" name="gender" value="non">
                    <label for="non">Non-binary</label>
                </div>
                <div>
                    <input type="radio" id="other" name="gender" value="other">
                    <label for="other">Other</label>
                </div>
                <div>
                <?php
                printError("gender");
                ?>
            </div>

            </fieldset>
        </div>

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
            <label for="adress1">Adress Line 1</label>
            <input type="text" name="adress1" id="adress1">
        </div>
        <div class="form__field">
            <label for="adress2">Adress Line 2</label>
            <input type="text" name="adress2" id="adress2">
        </div>
        <div class="form__field">
            <div>
                <input type="checkbox" name="tos" id="tos">
                <label for="tos">I accept the <a href="#">terms of service</a></label>
            </div>
            <div>
                <?php printError("tos"); ?>
            </div>

        </div>
        <div>
            <button type="submit" name="do-submit" value="do-submit">Send</button>
        </div>
    </form>
<?php else: ?>
    Vielen dank für ihre Nachricht.
<?php endif; ?>
