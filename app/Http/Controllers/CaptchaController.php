<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class CaptchaController extends Controller {
        public function createCaptcha() {
            $characters = '23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < 5; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }

            session(['captcha' => $randomString]);

            $image = imagecreate(120, 40);
            $background = imagecolorallocate($image, 255, 255, 255);
            $textColor = imagecolorallocate($image, 0, 0, 0);

            imagefill($image, 0, 0, $background);
            $x = 10;
            $y = 25;
            for ($i = 0; $i < strlen($randomString); $i++) {
                $angle = rand(-20, 20);
                imagettftext($image, 16, $angle, $x, $y, $textColor, "C:\Windows\Fonts\arial.ttf", $randomString[$i]);
                $x += 20;
            }

            ob_start();
            imagepng($image);
            $contents = ob_get_clean();
            imagedestroy($image);

            return response($contents) -> header('Content-Type', 'image/jpeg');
        }

        public function getCaptcha() {
            return response() -> make(session('captcha'));
        }
    }
