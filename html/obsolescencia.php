<html>
        <link href="style/logo.css" type="text/css" rel="stylesheet" />	
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script src="https://www.gstatic.com/charts/loader.js" type="text/javascript"></script>

<body>
        <div id="cima">
		
                <h1>Obsolescencia 2018 </h1>
        </div>
        <div id="menu">
                <ul>
		        <h4> <a href="index.php">Home</a></h4>
                        <h4> <a href="windows.php">Windows</a></h4>
                        <h4> <a href="vmware.php">Hosts Vmware</a></h4>
                        <h4> <a href="#">Obsolescencia</a></h4>
                        <h4> <a href="remotos.php">Acessos Remotos</a></h4>
                        <h4> <a href="#">Relatorios</a></h4>
                        <h4> <a href="aaa.php">Outros</a></h4>
                </ul>
        </div>

        <div id="centro">

		<?php
	//		echo "Inicio: <br>";
	$strBanco = "host=localhost port=5432 dbname=portalsrv_tst user=portalusr password=P0rta1!";
	
		if(!@($conexao = pg_connect($strBanco))){
		print "Não foi possível estabelecer uma conexão com o banco de dados.";
		echo "ERRO: <BR>";
	}else{
		$sql = "SELECT * FROM inv_srv";
		$result = pg_query($conexao, $sql);
		$resultAll = pg_fetch_all($result);
		
		//echo "Funciona";
		
		$total = array(
					"ATUALIZAR" => 0,
					"ATUALIZADOS" => 0,
					"MIGRAR" => 0);
		foreach($resultAll as $key){
			if($key['obsolescencia'] == "SIM") $total["ATUALIZAR"]++;
			else if($key['obsolescencia'] == "NAO") $total["ATUALIZADOS"]++;
			else if($key['obsolescencia'] == "MIGRAR") $total["MIGRAR"]++;
		
		
		}
		$tudo = $total["ATUALIZAR"] + $total["ATUALIZADOS"] + $total["MIGRAR"]; // Total de servidores.
		
		echo "<table border='2' align='center'>";
		echo "<tr><th> Total </th> <th>" . $tudo . "</th>";
		foreach($total as $chave => $value){
			//echo $chave . ": " . $value . " <br> ";
				
			//echo "<table border='2'> <tr> <td align='center'> " . $chave ."</td> <td> " . $value . "</td> </tr> </table>";
		//echo "<tr><td>" . $chave . "</td> <td>" . $value . "</td> </tr>";
		echo "<tr><th>" . $chave . "</th>";
		echo "<td>" . $value . "</td></tr>";

		}
		echo "</table>";
		pg_close($conexao);
	}
	
	//echo "<br> FIM <br>";
	?>


	<div id="GraficoColunas" style="height: 500px; width: 900px;">
        <script type="text/javascript">


      //carrega o pacote dos gráficos
      google.charts.load('current', {'packages':['corechart']});

      //define a função para criar o gráfico
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Pizzas', 'Grafico de Obsolescencia'],
          ['ATUALIZAR',   <?php echo $total['ATUALIZAR']; ?>],
          ['NAO ATUALIZAR', <?php echo $total['ATUALIZADOS']; ?>],
          ['MIGRAR',	<?php echo $total['MIGRAR']; ?>],
        ]);
        // criar a variavel options para definir as opções do gráfico
        var options = {
          title: 'Obsolescencia'
        };
        //aloca o tipo de gráfico na div GraficoColunas
    var chart = new google.visualization.ColumnChart(document.getElementById('GraficoColunas'));

        chart.draw(data, options);
      }

      //carrega o grafico na página
      google.charts.setOnLoadCallback(drawChart);

    </script>




       </div>



</body>
</html>



