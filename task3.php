<?php
//Фунуция вывода массива
function get($mas) {
	$column;
	for($i=0; $i<=2; $i++) {
		for($j=0; $j<=1; $j++) {
			if($j == 0){
				$column = 'AGE';
				echo "Mas [$i][$column] = " . $mas[$i][$column] . ' || ';
			} else {
				$column = 'NAME';
				echo "Mas [$i][$column] = " . $mas[$i][$column] . ';<br>';
			}
		}
	}
}

//Функцию для сравнения элементов
function sorting ($arr1,$arr2) {
	if($arr1["AGE"] != $arr2["AGE"]){
		return $arr1["AGE"] > $arr2["AGE"];
	}
	else {
		return $arr1["NAME"] > $arr2["NAME"];
	}
}

//Данный многомерный массив
$mas = [0=>['AGE'=>13,
			'NAME'=>'ANNA'],
		1=>['AGE'=>12, 
			'NAME'=>'OLEG'],
		2=>['AGE'=>13,
			'NAME'=>'ANDREY']];

$func = 'get';
$func($mas);//Выводим массив		
echo '<hr>';

usort($mas, "sorting");//Сортируем массив

$func($mas);//Выводим сортированный массив
?>