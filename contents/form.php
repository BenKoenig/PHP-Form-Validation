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
    if(
        $_POST['age'] > 118
        || $_POST['age'] < -1
    ) {
        $errors['age'] = "Please enter a valid age.";
    }
    if(!isset($_POST['tos'])){
        $errors['tos'] = "You must accept the terms of service";
    }
    $pattern = '/(\+?|0{0,2})[0-9 ]{1,3}[0-9 \/()-]+/m';
    if (!isset($_POST['phone']) || preg_match($pattern, $_POST['phone']) !== 1) {
        $errors['phone'] = 'Please enter a valid phone number.';
    }
    $pattern = '/[\w.]+@[\w]+\.[a-z]{2,}/m';
    if (!isset($_POST['email']) || preg_match($pattern, $_POST['email']) !== 1) {
        $errors['email'] = 'Please enter a valid email adress.';
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

            <?php
            $gender = [
                "female" => "female",
                "male" => "male",
                "non-binary" => "non-binary", 
                "other" => "other"
            ];
            ?>
                
            <?php
            foreach($gender as $value => $label): ?>
                <?php
                    $checkedParticle = '';
                    if (isset($_POST['gender']) && $_POST['gender'] === $value) {
                        $checkedParticle = ' checked';
                    }
                ?>

                <div>
                    <input type="radio" name="gender" value="<?php echo $value; ?>" id="<?php echo $label; ?>" <?php echo $checkedParticle; ?> required>
                    <label for="<?php echo $label; ?>"><?php echo ucfirst($label); ?></label>
                </div>
            
            <?php endforeach; ?>
      
            <div>
                <?php printError("gender");?>
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
            <?php
            $methods = [
                'paypal' => 'PayPal',
                'googlepay' => 'GooglePay',
                'mastercard' => 'MasterCard',
                'visa' => 'Visa'
            ];
            ?>

            <label for="paymentMethod">Payment Method</label>
            <select name="paymentMethod" id="paymentMethod">
                <option value="_default" disabled selected>Please select a method</option>
                <?php
                foreach($methods as $value => $label): ?>
                    <?php 
                        $selectedParticle = '';

                        if (isset($_POST['paymentMethod']) && $_POST['paymentMethod'] === $value) {
                            $selectedParticle = ' selected';
                        }
                    ?>

                    <option value="<?php echo $value; ?>"<?php echo $selectedParticle; ?>><?php echo $label; ?></option>
                <?php endforeach; ?>
            </select>
            <div>
                <?php printError("paymentMethod"); ?>
            </div>
        </div>
        <div class="form__field">
            <label for="age">Your Age</label>
            <input type="textfield" name="age" id="age" value="<?php old('age') ?>">
            <div>
                <?php printError("age"); ?>
            </div>
        </div>
        <div class="form__field">
            <label for="phone">Your phone number</label>
            <input type="text" name="phone" id="phone" value="<?php old('phone') ?>">
            <div><?php printError("phone"); ?></div>
        </div>
        <div class="form__field">
            <label for="email">Your email adress</label>
            <input type="text" name="email" id="email" value="<?php old('email') ?>">
            <div><?php printError("email"); ?></div>
        </div>
        <div class="form__field">
            <div>
                <input type="checkbox" name="tos" id="tos" value="tos" <?php if(isset($_POST['tos']) && $_POST['tos'] =='tos' ){echo "checked";}?> >
                <label for="tos">I accept the <a href="index.php?page=tos">terms of service</a></label>
            </div>
            <div><?php printError("tos"); ?></div>

        </div>
        <div>
            <button type="submit" name="do-submit" value="do-submit">Send</button>
        </div>
    </form>
<?php else: ?>
    <p>Thank you for your message.</p>
    <ol>
        <li><em>Gender:</em> <?php echo ucfirst($_POST["gender"])?></li>
        <li><em>First Name:</em> <?php echo ucfirst($_POST["firstName"])?></li>
        <li><em>Last Name:</em> <?php echo ucfirst($_POST["lastName"])?></li>
        <li><em>Payment Method:</em> <?php echo ucfirst($_POST["paymentMethod"])?></li>
        <li><em>Age:</em> <?php echo $_POST["age"]?></li>
        <li><em>Phone Number:</em> <?php echo $_POST["phone"]?></li>
        <li><em>Email Adress:</em> <?php echo $_POST["email"]?></li>
    </ol>
    <a href="index.php">Back to home</a
<?php endif; ?>
