<?php

namespace application\components;

class Helper
{
    public static function isAjax()
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        } 
        
        return false;
    }
    
    public static function genarateHtmlTable($data) {
        $htmlResponseTable = '<tr>
                                <th>USER NAME</th>
                                <th>USER EMAIL</th>
                                <th>USER HOMEPAGE</th>
                                <th>USER MESSAGE</th>
                                <th>CREATE DATE</th>
                            </tr>';

        foreach ($data as $feedbackMessage) {
            $htmlResponseTable .= ' <tr> ' .
                '<td>' .  $feedbackMessage['name'] . ' </td> ' .
                '<td>' .  $feedbackMessage['email'] . ' </td> ' .
                '<td>' .  $feedbackMessage['homepage'] . ' </td> ' .
                '<td>' .  $feedbackMessage['message'] . ' </td> ' .
                '<td>' .  $feedbackMessage['createDate'] . ' </td> ' .
                '</tr>';
        }
        
        return $htmlResponseTable;
    }
}