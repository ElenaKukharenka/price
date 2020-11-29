<?php
$mysqli = new mysqli("localhost", "root", "", "pricelist");
$query = "SELECT * FROM price";
$query_res = mysqli_query($mysqli, $query);

//переменные для общего количества товаров на двух складах	
	$sum1 = 0;
	$sum2 = 0;
//переменные для подсчета средней стоимости товаров
	$cost_rozn = 0;
	$cost_opt = 0;
//счетчик строк	
	$i=0;
//предупреждение 
	$note_text = "Осталось мало!! Срочно докупите!!!";
//для нахождения максимальной цены	
	$max = 0;
	$max_i = 0;
	$idx = 0;
//для нахождения минимальной цены
	$min = 999999999999999;
	$min_i = 0;	
	
$query_res2 = mysqli_query($mysqli, $query);

	while($row = mysqli_fetch_assoc($query_res2)){
		$result_array[] = $row;
	
		if (!$row['cost'] == (string)(float)($row['cost'])){
			$row['cost'] = 0;
		} else {
			$row['cost'] = (float)($row['cost']);
		}
	
		// нахождение максимальной цены
		if ($row[cost] > $max) {
			$max = $row[cost];
			$max_i = $idx;
		}		
		if (!$row['cost_opt'] == (string)(float)($row['cost_opt'])){
			$row['cost_opt'] = 0; //здесь можно изменить на любое число
		} else {
			$row['cost_opt'] = (float)($row['cost_opt']);
		}
	// нахождение минимальной цены
		
		if ($row[cost_opt] < $min) {
			$min = $row[cost_opt];
			$min_i = $idx;
		}	
		$idx++;	
		
	}

	
if($query_res) {
    echo ("<table  >
        <tr>          
            <th>Наименование товара</th>
            <th>Cтоимость, руб</th>
            <th>Cтоимость опт, руб</th>
            <th>Наличие на складе 1, шт</th>
            <th>Наличие на складе 2, шт</th>
            <th>Cтрана производства</th>
            <th>Примечание</th>
        </tr>");

        while($row = mysqli_fetch_assoc($query_res)){
        echo ("<tr>");
          
                echo (iconv('UTF-8','WINDOWS-1251',("<td>$row[name]</td>")));
				//если в ячейке не цена , то выводим 0
				if (!$row[cost] == (string)(float)($row[cost])){
				$row[cost] = 0;
				}
				else{
				$row['cost'] = (float)($row['cost']);
				}
				//if($i == $max_i){
				if($row['cost'] == $max){
				echo("<td style='color:red;'>$row[cost]</td>");				
				}
				else {
				echo("<td>$row[cost]</td>");
				}
				 
				//если в ячейке не цена , то выводим 0
				if (!$row[cost_opt] == (string)(float)($row[cost_opt])){
				$row[cost_opt] = 0;
				}
				else{
				$row['cost_opt'] = (float)($row['cost_opt']);
				}
				if($row['cost_opt'] == $min){
				echo("<td style='color:green;'>$row[cost_opt]</td>");
				}
				else {
				echo("<td>$row[cost_opt]</td>");
				}
				
				echo("<td>$row[stock_availability1]</td>");
				echo("<td>$row[stock_availability2]</td>");
				echo (iconv('UTF-8','WINDOWS-1251',("<td>$row[country]</td>")));
				
				//если товара на складе мало - вывести предупреждение
				if($row[stock_availability1]<= 20 || $row[stock_availability2]<= 20){
					$row[note] = $note_text;
					echo ("<td>$row[note]</td>");
					}
					else {
				echo ("<td>$row[note]</td>");
		}
		
		$sum1 += $row[stock_availability1];
		$sum2 += $row[stock_availability2];
		
		$cost_rozn += $row[cost];
		$cost_opt += $row[cost_opt];
		$i++;
        
		echo("</tr>");
		}
}

  echo ("</table>"); 
  
  $vsego = 'Всего: ';
	echo $vsego.($sum1+$sum2).'<br>' ;
	
	$sred_rozn = $cost_rozn/$i;
	$sred_rozn_text = 'Cредняя стоимость розничной цены товара: ';
	echo $sred_rozn_text.$sred_rozn.'<br>';
	
	$sred_opt = $cost_opt/$i;
	$sred_opt_text = 'Cредняя стоимость оптовой цены товара: ';
	echo $sred_opt_text.$sred_opt.'<br>';
	
	echo $max.'<br>';
	echo $min.'<br>';
	

$mysqli->close();
?>