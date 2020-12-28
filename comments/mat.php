<?php
     @setlocale(LC_ALL, array ('ru_RU.CP1251', 'rus_RUS.1251'));

    if(!preg_match("/[a-zа-я]/iu", $_POST['mat']))
    {
        echo 'Непонятно что вы отправили';
    }
    else if(!($file = fopen("censor/mat.txt", "r")))
    {
        echo 'Файл с матьюками не удалось открыть';
    }
    else
    {
        $mat_in_file = fgets($file);

        fclose($file); // прочитали -> закрыли

        //$info = 'Было в файле : "' . $mat_in_file . '"   ';

        $str = $_POST['mat'];
        $str = preg_replace("/[ ]+/iu", " ", $str); // заменяем много подряд идущих пробелов - одним пробелом
        $str = preg_replace("/^[ ]|[ ]$/iu", "", $str); // убираем пробел в начале и конце (если такие имеются)

        $mat = explode(" ", $str); // для нас разделитель - пробел
        $array_mat_in_file = explode("|", $mat_in_file);

        unset($mat_in_file);

        foreach($mat as $slovo)
        {
            if(!in_array($slovo, $array_mat_in_file)) //если такое слово ещё не записано в файл с матерными словами
            { // запишем его 
                $array_mat_in_file[] = $slovo;
            }
        }

        foreach($array_mat_in_file as $slovo)
        {
            if(empty($mat_in_file))
            {
                $mat_in_file = $slovo;
            }
            else
            {
                $mat_in_file = $mat_in_file . '|';
                $mat_in_file = $mat_in_file . $slovo;
            }
        }

        //$info .= 'Стало в файле: "' .  $mat_in_file . '"';

        $file = fopen("censor/mat.txt", "w");
        fwrite($file, $mat_in_file);
        fclose($file); // записали -> закрыли 
    }
?>