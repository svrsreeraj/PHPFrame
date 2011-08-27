<html>
<body>

<script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'custom',
    custom_theme_widget: 'recaptcha_widget'
 };
 </script>
<script type="text/javascript"  src="http://www.google.com/recaptcha/api/challenge?k=6LeuGMASAAAAALKS0kfLtAo6H6hm37jtXCsdYOLD">
</script>
 <div id="recaptcha_widget" style="display:none">

 <div id="recaptcha_image"></div>
 <div class="recaptcha_only_if_incorrect_sol" style="color:red">Incorrect please try again</div>

 <span class="recaptcha_only_if_image">Enter the words above:</span>
 <span class="recaptcha_only_if_audio">Enter the numbers you hear:</span>

 <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />

 <div><a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a></div>
 <div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
 <div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>

 <div><a href="javascript:Recaptcha.showhelp()">Help</a></div>

</div>

<noscript>
 <iframe src="http://www.google.com/recaptcha/api/noscript?k=your_public_key"
      height="300" width="500" frameborder="0"></iframe><br>
 <textarea name="recaptcha_challenge_field" rows="3" cols="40">
 </textarea>
 <input type="hidden" name="recaptcha_response_field"
      value="manual_challenge">
</noscript>	
    <form action="" method="post">
<?php

require_once('recaptchalib.php');

// Get a key from https://www.google.com/recaptcha/admin/create
$publickey 	= "6LeuGMASAAAAALKS0kfLtAo6H6hm37jtXCsdYOLD";
$privatekey = "6LeuGMASAAAAAAaDIl5G5oHNtW19QjWghMIdN9z8";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

# was there a reCAPTCHA response?
if ($_POST["recaptcha_response_field"]) {
        $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);

        if ($resp->is_valid) {
                echo "You got it!";
        } else {
                # set the error code so that we can display it
                $error = $resp->error;
        }
}
echo recaptcha_get_html($publickey, $error);
?>
    <br/>
    <input type="submit" value="submit" />
    </form>
  </body>
</html>
