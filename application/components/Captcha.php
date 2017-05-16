<?php

namespace application\components;

class Captcha
{
    private static $captcha = null;

    private static $captchaImgName = null;

    public static function generateCaptcha()
    {
        self::removeOldData();

        self::$captcha = self::generateString();
        self::$captchaImgName = self::generateString(8, 8);
        $image = self::generateImage();
        self::saveImg($image);
    }

    private static function removeOldData()
    {
        $pathToImg = IMG_PATH . D_S . $_SESSION['captchaFileName'] . '.png';

        self::$captcha = null;

        if (file_exists($pathToImg)) {
            unlink($pathToImg);
        }
        self::$captchaImgName = null;
    }

    private static function generateString($minLength = 4, $maxLength = 8)
    {
        $chars = 'abdefhknrstyz23456789';
        $randomString = '';
        $stringLength = rand($minLength, $maxLength);

        for ($i = 0; $i < $stringLength; $i++) {
            $randomString .= $chars[rand(0, strlen($chars))];
        }

        $_SESSION['captcha'] = md5(self::$captcha);

        return $randomString;
    }

    public static function generateImage()
    {
        $width = 15 * 2 + strlen(self::$captcha) * 12;
        $height = 45;
        $font_size = 12;
        $font = PROJECT_BASE_DIR . D_S . 'application' . D_S . 'assets' . D_S . 'font' . D_S . 'DroidSans.ttf';

        $colors = [90, 110, 130, 150, 170, 190, 210];

        $src = imagecreatetruecolor($width, $height);
        $backgroundColor = imagecolorallocate($src, rand(240, 255), rand(240, 255), rand(240, 255));
        imagefill($src, 0, 0, $backgroundColor);

        for ($i = 0; $i < strlen(self::$captcha); $i++) {
            $color = imagecolorallocatealpha($src, $colors[rand(0, sizeof($colors) - 1)],
                $colors[rand(0, sizeof($colors) - 1)],
                $colors[rand(0, sizeof($colors) - 1)], rand(20, 40));
            $size = rand($font_size * 2 - 2, $font_size * 2 + 2);
            $x = ($i + 1) * $font_size + rand(1, 5);
            $y = (($height * 2) / 3) + rand(0, 5);
            imagettftext($src, $size, rand(0, 15), $x, $y, $color, $font, self::$captcha[$i]);
        }

        return $src;
    }

    private static function saveImg($img)
    {
        $pathToImg = IMG_PATH . D_S . self::$captchaImgName . '.png';
        imagepng($img, $pathToImg);
        $_SESSION['captchaFileName'] = self::$captchaImgName;
    }

    public static function getCaptcha()
    {
        return self::$captcha;
    }

    public static function getCaptchaImgName()
    {
        return self::$captchaImgName;
    }

    public static function checkCaptchaOnValid($userCaptcha)
    {
        $errorArray = [];
        if ($_SESSION['captcha'] == md5($userCaptcha)) {
           return true;
        }

        return false;
    }
}