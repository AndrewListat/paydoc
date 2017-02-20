<?php
namespace app\commands;
/**
 * Created by PhpStorm.
 * User: Listat
 * Date: 20.02.2017
 * Time: 16:31
 */
class Dadata
{
    public function suggest($type, $fields)
    {
        $result = false;
        if ($ch = curl_init("http://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/$type"))
        {
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: '.\Yii::$app->params['dadata_api_key']
            ));
            curl_setopt($ch, CURLOPT_POST, 1);
            // json_encode
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            $result = json_decode($result, true);
            curl_close($ch);
        }
        return $result;
    }
}