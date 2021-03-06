<?php
/**
 * Created by PhpStorm.
 * User: Listat
 * Date: 26.02.2017
 * Time: 13:12
 */

namespace app\commands;

global $N0, $Ne0, $Ne1, $Ne2, $Ne3, $Ne6;

$N0 = 'ноль';

$Ne0 = array(
    0 => array('','один','два','три','четыре','пять','шесть',
        'семь','восемь','девять','десять','одиннадцать',
        'двенадцать','тринадцать','четырнадцать','пятнадцать',
        'шестнадцать','семнадцать','восемнадцать','девятнадцать'),
    1 => array('','одна','две','три','четыре','пять','шесть',
        'семь','восемь','девять','десять','одиннадцать',
        'двенадцать','тринадцать','четырнадцать','пятнадцать',
        'шестнадцать','семнадцать','восемнадцать','девятнадцать')
);
$Ne1 = array('','десять','двадцать','тридцать','сорок','пятьдесят',
    'шестьдесят','семьдесят','восемьдесят','девяносто');

$Ne2 = array('','сто','двести','триста','четыреста','пятьсот',
    'шестьсот','семьсот','восемьсот','девятьсот');

$Ne3 = array(1 => 'тысяча', 2 => 'тысячи', 5 => 'тысяч');

$Ne6 = array(1 => 'миллион', 2 => 'миллиона', 5 => 'миллионов');

class Num2str
{
    function written_number($i, $female=false) {
        global $N0;
        if ( ($i<0) || ($i>=1e9) || !is_int($i) ) {
            return false; // Аргумент должен быть неотрицательным целым числом, не превышающим 1 миллион
        }
        if($i==0) {
            return $N0;
        }
        else {
            return preg_replace( array('/s+/','/\s$/'),
                array(' ',''),
                $this->num1e9($i, $female));
            return $this->num1e9($i, $female);
        }
    }

    function num_125($n) {
        /* форма склонения слова, существительное с числительным склоняется
         одним из трех способов: 1 миллион, 2 миллиона, 5 миллионов */
        $n100 = $n % 100;
        $n10 = $n % 10;
        if( ($n100 > 10) && ($n100 < 20) ) {
            return 5;
        }
        elseif( $n10 == 1) {
            return 1;
        }
        elseif( ($n10 >= 2) && ($n10 <= 4) ) {
            return 2;
        }
        else {
            return 5;
        }
    }

    function num1e9($i, $female) {
        global $Ne6;
        if($i<1e6) {
            return $this->num1e6($i, $female);
        }
        else {
            return $this->num1000(intval($i/1e6), false) . ' ' .
                $Ne6[$this->num_125(intval($i/1e6))] . ' ' . $this->num1e6($i%1e6, $female);
        }
    }

    function num1e6($i, $female) {
        global $Ne3;
        if($i<1000) {
            return $this->num1000($i, $female);
        }
        else {
            return $this->num1000(intval($i/1000), true) . ' ' .
                $Ne3[$this->num_125(intval($i/1000))] . ' ' . $this->num1000($i%1000, $female);
        }
    }

    function num1000($i, $female) {
        global $Ne2;
        if( $i<100) {
            return $this->num100($i, $female);
        }
        else {
            return $Ne2[intval($i/100)] . (($i%100)?(' '. $this->num100($i%100, $female)):'');
        }
    }

    function num100($i, $female) {
        global $Ne0, $Ne1;
        $gender = $female?1:0;
        if ($i<20) {
            return $Ne0[$gender][$i];
        }
        else {
            return $Ne1[intval($i/10)] . (($i%10)?(' ' . $Ne0[$gender][$i%10]):'');
        }
    }
}