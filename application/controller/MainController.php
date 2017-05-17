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
        if (Helper::isAjax()) {
            $currentPage = $_POST['currentPage'];
            $countRowOnPage = 2;
            $countRows = DataBase::findOne('SELECT COUNT(id) FROM `feedback`');
            
            $formData = $_POST['filterFormData'];

            $formattedData = [];
            foreach ($formData as $value) {
                $partOfStringData = explode('=', $value);
                $formattedData[$partOfStringData[0]] = $partOfStringData[1];
            }

            $feedbackMessages = DataBase::findAll('SELECT * FROM `feedback` ORDER BY ' .
                'name ' . $formattedData['userName'] .
                ', email ' . $formattedData['userEmail'] .
                ', createDate ' . $formattedData['createDate'] .
                'LIMIT ' .  ($currentPage) * $countRowOnPage . ', ' . $countRowOnPage
            );

            

            $htmlResponseTable =  Helper::genarateHtmlTable($feedbackMessages);

            echo  json_encode([$htmlResponseTable, ceil($countRows % $countRowOnPage)]);
            die;
        }

        include_once VIEWS_PATH . 'dashboard.php';
    }

    public function actionSendFeedbackMessage()
    {
        if (Helper::isAjax()) {
            if (Captcha::checkCaptchaOnValid($_POST['captcha'])) {
                DataBase::query('INSERT INTO feedback(`name`, `email`, `homepage`, `message`, `createDate`) VALUE (?, ?, ?, ?, ?)',
                    [
                        htmlspecialchars($_POST['name']),
                        htmlspecialchars($_POST['email']),
                        htmlspecialchars($_POST['homepage']),
                        htmlspecialchars($_POST['text']),
                        date_format(new \DateTime(), 'Y-m-d H:i:s'),
                    ]);

                echo 'ok';
            } else {
                echo 'error';
            }
        }
    }

}