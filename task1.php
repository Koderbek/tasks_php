<?php
//Вывод массива
function get($mas, $n) {
	for($i=0; $i <= $n-2; $i++) {
		echo "Mas[$i] = " . $mas[$i] . '; <br>';
	}
}

$mas = array(); //Массив данных
$n = 1000;

//Заполняем массив рандомными числами из диапозона
for($i=0; $i<=$n-2; $i++) {
	$element = rand(1, $n);
	$j = $i;	
	while ($j>=0) {
		if ($mas[$j] != $element){
			$mas[$i] = $element;
			$j--;
		} else {
			$element = rand(1, $n);
			$j = $i;
		}
	}
}

echo 'Данный массив:<br>';
$func = 'get';
$func($mas, $n);//Вывод массива
echo '<hr>';

echo 'Ответ: <br>';
sort($mas);//Сортируем массив

//Поиск пропущенного числа
if ($mas[0]==1 && $mas[$n-2]==$n){
	for($i=0; $i<=$n-3; $i++) {
		if($mas[$i] == $mas[$i+1]-1){
		} else {
			echo "Пропущенное число: " . ($mas[$i]+$mas[$i+1])/2;
			$i=$n-2;
		}
	}
} elseif ($mas[0] != 1){
	echo "Пропущенное число: 1";
} else  echo "Пропущенное число: $n";
?>