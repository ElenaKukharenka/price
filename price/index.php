<?php
$mysqli = new mysqli("localhost", "root", "", "pricelist");

$query = "SELECT * FROM price2";

$query_res = mysqli_query($mysqli, $query);
//���������� ��� ������ ���������� ������� �� ���� �������	
	$sum1 = 0;
	$sum2 = 0;
//���������� ��� �������� ������� ��������� �������
	$cost_rozn = 0;
	$cost_opt = 0;
//������� �����	
	$i=0;
//�������������� 
	$note_text = "�������� ����!! ������ ��������!!!";
	$max = 0;
	$max_i = 0;
	$idx = 0;
$query2 = "SELECT * FROM price2";	
$query_res2 = mysqli_query($mysqli, $query2);
	while($row = mysqli_fetch_assoc($query_res2))
	{
		$result_array[] = $row;
	
		// ����� ������������ ����
		if ($row['cost'] > $max) {
			$max = $row['cost'];
			$max_i = $idx;
		}
		$idx++;
	}
	
if($query_res) {
    echo ("<table  >
        <tr>          
            <th>������������ ������</th>
            <th>���������, ���</th>
            <th>��������� ���, ���</th>
            <th>������� �� ������ 1, ��</th>
            <th>������� �� ������ 2, ��</th>
            <th>������ ������������</th>
            <th>����������</th>
        </tr>");

        while($row = mysqli_fetch_assoc($query_res)){
        echo ("<tr>");
          
                echo (iconv('UTF-8','WINDOWS-1251',("<td>$row[name]</td>")));
				
				if( $i == $max_i){
				echo("<td style='color:red;'>$row[cost]</td>");				
				}
				else {
				echo("<td>$row[cost]</td>");
				}
				 
				echo("<td>$row[cost_opt]</td>");
				echo("<td>$row[stock_availability1]</td>");
				echo("<td>$row[stock_availability2]</td>");
				echo (iconv('UTF-8','WINDOWS-1251',("<td>$row[country]</td>")));
				
				//���� ������ �� ������ ���� - ������� ��������������
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
  
  $vsego = '�����: ';
	echo $vsego.($sum1+$sum2).'<br>' ;
	
	$sred_rozn = $cost_rozn/$i;
	$sred_rozn_text = 'C������ ��������� ��������� ���� ������: ';
	echo $sred_rozn_text.$sred_rozn.'<br>';
	
	$sred_opt = $cost_opt/$i;
	$sred_opt_text = 'C������ ��������� ������� ���� ������: ';
	echo $sred_opt_text.$sred_opt.'<br>';
			
$mysqli->close();

?>