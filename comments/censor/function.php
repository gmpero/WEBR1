<?php
 @setlocale(LC_ALL, array ('ru_RU.CP1251', 'rus_RUS.1251'));
    
    function censor(string $text)
    {
        $text = preg_replace("/[ ]+/u", "  ", $text); // делаем так, чтобы все символы разделялись двойными пробелами

        $file = fopen("censor/mat.txt", "r");

        //кусок регулярного выражения в виде <слово1>|<слово2>|<слово3>
        //$mat = iconv('cp1251', 'utf-8', fgets($file)); 
        $mat = fgets($file);
        
        fclose($file);
        
        if(preg_match("/[^а-я|]/iu", $mat)) //если нашли символ, которого там не может быть (значит ошибка)
        {
            return $text; // возвращаем без изменений
        }

        $find = "/([^а-я]|^)($mat)([^а-я]|$)/iu";
        $text = preg_replace($find, "$1****$3", $text);
        
        return $text;
    }
?>