﻿<?php
/*Вес людей, которые хотят совершить прогулку на вертолете
в парке аттракционов, является нормально распределенной случайной величи-
ной с математическим ожиданием 75 кг и стандартным отклонением 6 кг. Вме-
стимость вертолета составляет 5 пассажиров, максимальная грузоподъемность
– 400 кг. Провести 1000 испытаний с моделью и оценить вероятность того, что
вертолет не взлетит с пятью пассажирами на борту?*/

//Нормальное распределение
function N() {
	for($z=0;$z<12;$z++){
		$R[$z] = rand(0,1);
	}	
	return $X = 75 + 6 * (array_sum($R) - 6);
}

$n = 1000; //Количество испытаний
$prob = 0;

for($i=0; $i<$n; $i++){
	for($j=0;$j<5;$j++){
		$people[$j] = N();
	}
	
	if(array_sum($people)>400){
		$prob++;
		echo "Перегрузка на испытании $i<br>";
	}
}
echo "Вероятность перегрузки вертолета: " . $prob/$n;
?>