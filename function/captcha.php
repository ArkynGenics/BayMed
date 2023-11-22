<?php
function generateCaptcha() {
    $captchaText = substr(md5(uniqid(rand(), true)), 0, 6);
    $_SESSION['captcha'] = $captchaText;
    $image = imagecreate(150, 50);
    $bgColor = imagecolorallocate($image, 255, 255, 255); 
    for ($i = 0; $i < 5; $i++) {
        $lineColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
        imageline($image, rand(0, 150), rand(0, 50), rand(0, 150), rand(0, 50), $lineColor);
    }
    for ($i = 0; $i < 50; $i++) {
        $dotColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
        imagesetpixel($image, rand(0, 150), rand(0, 50), $dotColor);
    }
    $textColor = imagecolorallocate($image, 0, 0, 0);
    imagestring($image, 5, 20, 15, $captchaText, $textColor);
    ob_start();
    imagepng($image);
    $imageData = base64_encode(ob_get_clean());
    imagedestroy($image);
    return $imageData;
}
function validateCaptcha($userInput) {
    return isset($_SESSION['captcha']) && strtoupper($userInput) === strtoupper($_SESSION['captcha']);
}
?>