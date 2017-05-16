<?php

namespace application\controller;

use application\components\Captcha;

class MainController
{
    public function actionIndex()
    {
        include VIEWS_PATH . 'home.php';
    }

    public function actionFeedback()
    {
        Captcha::generateCaptcha();

        $captchaPatch =  '/application/assets/img/' . $_SESSION['captchaFileName'] . '.png';

        include_once VIEWS_PATH . 'feedbackForm.php';
    }

    public function actionDashboards()
    {
        include_once VIEWS_PATH . 'dashboard.php';
    }

    public function actionSendFeedbackMessage()
    {

    }
}