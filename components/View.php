<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 29.08.2018
 * Time: 19:03
 */
class View {
    private $content;

    public function __set($name, $value) {
        $this->{$name} = $value;
    }

    function generate($templateView, $mainView) {
        if (!$mainView) {
            echo 'Установите вид!'; die;
        }

        $this->content = $this->getRenderHTML('views/' . $mainView);

        include 'views/layouts/' . $templateView;
    }
    public function getRenderHTML($path) {
        ob_start();
        include ($path);
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }

    public function getRusDate($baseDate) {                                       // функция для замены месяца на английском языке на русский язык под формат макета сайта
        $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s", $baseDate);
        $new_datetime = $new_datetime->format('d m Y');
        $dateArr = explode(' ', $new_datetime);
        $m = '';
        switch ($dateArr[1]){
            case 1: $m = 'января'; break;
            case 2: $m = 'февраля'; break;
            case 3: $m = 'марта'; break;
            case 4: $m = 'апреля'; break;
            case 5: $m = 'мая'; break;
            case 6: $m = 'июня'; break;
            case 7: $m = 'июля'; break;
            case 8: $m = 'августа'; break;
            case 9: $m = 'сентября'; break;
            case 10: $m = 'октября'; break;
            case 11: $m = 'ноября'; break;
            case 12: $m = 'декабря'; break;
        }
        echo $dateArr[0] ." ". $m ." ". $dateArr[2];
    }
}
?>