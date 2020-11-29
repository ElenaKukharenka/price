<?php
//устанавливаем подключение к  БД
	//$mysqli = new mysqli("localhost", "root", "", "pricelist");
	
//открываем файл
	$file = fopen('pricelist.csv', 'r');
 
	echo '<table cellspacing = "0" border = "1">';
//переменные для общего количества товаров на двух складах	
	$sum1 = 0;
	$sum2 = 0;
//переменные для подсчета средней стоимости товаров
	$cost_rozn = 0;
	$cost_opt = 0;
	
	
	$maxc = 0;
	
//считываем построчно файл, пока не дойдем до конца
	while(!feof($file)){
//помещаем строки в массив
		$mass = fgetcsv($file, 10000000, ";");
		
		
		$j= count($mass);
		if($j>1){
			
		echo '<tr>';
			echo '<td>';
			echo $mass[0];
			echo '</td>';
			echo '<td>';
			echo $mass[1];
			echo '</td>';
			echo '<td>';
			echo $mass[2];
			echo '</td>';
			echo '<td>';
			echo $mass[3];
			echo '</td>';
			echo '<td>';
			echo $mass[4];
			echo '</td>';
			echo '<td>';
			echo $mass[5];
			echo '</td>';
			echo '<td>';
			
			echo '</td>';
			
		echo '</tr>';
		
		
		
		$sum1 += $mass[3];
		$sum2 += $mass[4];
		
		$cost_rozn += $mass[1];
		$cost_opt += $mass[2];
		
		if($mass[1]>$maxc) {
		$maxc= $mass[1];
		}
		
		
		//$mass[0] = iconv('WINDOWS-1251', 'UTF-8', $mass[0]);
		//$mass[1] = iconv('WINDOWS-1251', 'UTF-8', $mass[1]);
		//$mass[2] = iconv('WINDOWS-1251', 'UTF-8', $mass[2]);
		//$mass[3] = iconv('WINDOWS-1251', 'UTF-8', $mass[3]);
		//$mass[4] = iconv('WINDOWS-1251', 'UTF-8', $mass[4]);
		//$mass[5] = iconv('WINDOWS-1251', 'UTF-8', $mass[5]);
//вставляем считанную строку в строку БД
		//$mysqli->query("INSERT INTO price (name, cost, cost_opt, stock_availability1, stock_availability2, country) 
		//VALUES ('{$mass[0]}', '{$mass[1]}', '{$mass[2]}', '{$mass[3]}', '{$mass[4]}', '{$mass[5]}') ");
		}
		
	}
	echo '</table>';
	
	$vsego = 'Всего: ';
	$vsego = iconv('UTF-8','WINDOWS-1251', $vsego);
	echo $vsego.($sum1+$sum2).'<br>' ;
	
	$sred_rozn = $cost_rozn/count($mass);
	$sred_rozn_text = 'Cредняя стоимость розничной цены товара: ';
	$sred_rozn_text = iconv('UTF-8','WINDOWS-1251', $sred_rozn_text);
	echo $sred_rozn_text.$sred_rozn.'<br>';
	
	$sred_opt = $cost_opt/count($mass);
	$sred_opt_text = 'Cредняя стоимость оптовой цены товара: ';
	$sred_opt_text = iconv('UTF-8','WINDOWS-1251', $sred_opt_text);
	echo $sred_opt_text.$sred_opt.'<br>';
	
	echo $maxc;
	
	
//закрываем файл
	fclose($file);
//закрываем подключение к БД
	//$mysqli->close();
?>



$query1 = "SELECT cost FROM price";

$res_query1= mysqli_query($mysqli, $query1);

if($max < $row[cost]){
					$max = row[cost];
					 
					}


 while($row = mysqli_fetch_assoc($result))
        {
		if($max < $row[cost]){
					$max = row[cost];					
					}		
        if($row['cost'] == $max)
        echo ("<tr style='background:red;'>");
        else
        echo ("<tr>");
            foreach($row as $key => $column) {
if($key == 'cost' && $column == $max_cost)
echo("<td style='color:yellow;'>$column</td>");
else
                echo("<td>$column</td>");
            }
        echo("</tr>");
        }




