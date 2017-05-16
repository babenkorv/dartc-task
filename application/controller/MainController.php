<?php

namespace application\controller;

use application\components\Captcha;
use application\components\Helper;
use application\components\DataBase;

class MainController
{
    public function actionIndex()
    {
        include VIEWS_PATH . 'home.php';
    }

    public function actionFeedback()
    {
        Captcha::generateCaptcha();

        $captchaPatch = '/application/assets/img/' . $_SESSION['captchaFileName'] . '.png';

        include_once VIEWS_PATH . 'feedbackForm.php';
    }

    public function actionDashboards()
    {
        include_once VIEWS_PATH . 'dashboard.php';
    }

    public function actionSendFeedbackMessage()
    {
        if(Helper::isAjax()) {
            if (Captcha::checkCaptchaOnValid($_POST['captcha'])) {
                DataBase::query('INSERT INTO feedback(`name`, `email`, `homepage`, `message`) VALUE (?, ?, ?, ?)',
                    [htmlspecialchars($_POST['name']), htmlspecialchars($_POST['email']), htmlspecialchars($_POST['homepage']), htmlspecialchars($_POST['text'])]);
                
                echo 'ok';
            } else {
                echo 'error';
            }
        }
    }
    
}