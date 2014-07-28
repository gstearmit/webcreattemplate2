<?php session_start();
    if(array_key_exists('send', $_POST)) {
        $to = 'example@domain.com';
        //list expected fields
        $expected = array('name', 'email', 'subject', 'comments', 'security_code');
        //set required fields
        $required = array('name', 'email', 'comments', 'security_code');
        //create empty array for any missing fields
        $missing = array();
        //process the $_POST variables
        foreach ($_POST as $key => $value) {
            //assign to temporay variable and strip white space
            $temp = is_array($value) ? $value : trim($value);
            //if empty and required, add to $missing array
            if(empty($temp) && in_array($key, $required)){
                array_push($missing, $key);
                }
            //otherwise, assign to a variable of the same name as $key
            elseif(in_array($key, $expected)) {
                ${$key} = $temp;
            }
        }
        // validate the email address
        if (!empty($email)) {
        // regex to ensure no illegal characters in email address
        $checkEmail = '/^[^@]+@[^\s\r\n\'";,@%]+$/';
        // reject the email address if it doesn't match
        if (!preg_match($checkEmail, $email)) {
        array_push($missing, 'email');
        }
        }
        //go ahead only if all required fields OK
        if(empty($missing) && $_SESSION['security_code'] == $_POST['security_code']) {
        //build the message 
        $message = "Name: $name\n\n";
        $message .= "Email: $email\n\n";
        $message .="Comments: $comments";
        //limit line lenght to 70 chars
        $message = wordwrap($message, 70);
        //Send it
        $mailSent = mail($to, $subject, $message);
        if ($mailSent) {
            //$missing is no longer needed if the email is sent, so dump it
            unset($missing);
        }
        }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="izwebz" />
    <script type="text/javascript" charset="utf-8" src="js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/jquery.validate.js"></script>
    <script type="text/javascript">
        $(document).ready(function()    {
            $('#contact-form').validate();
        });
    
    </script>
    <link rel="stylesheet" type="text/css" href="style.css" />

	<title>Contact Form</title>
</head>

<body>
    <div id="wrapper">
    <a href="/">Index</a>
        <?php
        if ($_POST && isset($missing)) {
        ?>
            <p class="warning">Please complete the missing items</p>
        <?php }
        elseif ($_POST && !$mailSent) {
        ?>
        <p class="warning">Sorry, there was a problem sending your email</p>
        <?php }
        elseif ($_POST && $mailSent) {
        ?>
        <p class="success"><strong>Your message has been sent, we will be in touch</strong></p>
        <?php } ?>
        <img class="stamp" src="images/stamp.png" alt="stamp" />
        <form method="post" action="" id="contact-form">

                <label for="name"><strong>Name:<span>*</span></strong> <?php
                if (isset($missing) && in_array('name', $missing)) { ?>
                    <span class="error">Please enter your name</span> <?php } ?>
                </label>
                <input type="text" size="50" name="name" id="name" class="required" minlength=4
                <?php if (isset($missing)) {
                    echo 'value="'.htmlentities($_POST['name']).'"';
                }?>
                />

                <label for="email"><strong>Email:<span>*</span></strong><?php
                if (isset($missing) && in_array('email', $missing)) { ?>
                    <span class="error">Please enter your email</span> <?php } ?>
                </label>
                <input type="text" size="50" name="email" id="email" class="required email"
                <?php if (isset($missing)) {
                    echo 'value="'.htmlentities($_POST['email']).'"';
                }?>
                />

                <label for="subject"><strong>Subject:</strong></label>
                <input type="text" size="50" name="subject" id="subject"
                <?php if (isset($missing)) {
                    echo 'value="'.htmlentities($_POST['subject']).'"';
                }?>/>

                <label for="message"><strong>Comments:</strong><span>*</span> <?php
                if (isset($missing) && in_array('comments', $missing)) { ?>
                    <span class="error">Please tell me what you want</span> <?php } ?>
                </label>
                <textarea rows="" cols="" name="comments" id="comments" class="required"><?php
                if (isset($missing)) {
                    echo htmlentities($_POST['comments']);
                } ?>
                
                </textarea>

            <img src="captcha.php" id="captcha" alt="captcha"/>
            <label for="security_code"><strong></p>Spam protection</strong><span>*</span><?php
                if (isset($missing) && in_array('security_code', $missing)) { ?>
                    <span class="error">Please fill in the form below</span> <?php } ?>
            </label>
            <input type="text" id="security_code" name="security_code" autocomplete="off" class="required"/>
            <input type="submit" value="Send Message" name="send" />
              <p class="rules">
                Nếu bạn có bất cứ thắc mắc, ý kiến đóng góp hoặc câu hỏi gì khi sử dụng Izwebz.com, hãy liên lạc với tôi bằng form dưới đây. Tôi sẽ hồi âm bạn sớm nhất có thể. Tôi luôn cố gắng trả lời tất cả những email gửi tới, cho nên nếu trong vòng 2 ngày bạn chưa nhận được hồi âm, rất có thể email của bạn đã bị thất lạc. Bạn vui lòng gửi lại email khác.</p>
        </form>
    </div><!--End #wrapper-->


</body>
</html>