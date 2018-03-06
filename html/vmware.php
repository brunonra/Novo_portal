<html>
	<link href="style/logo.css" type="text/css" rel="stylesheet" />
	
<body>
	<div id="cima">
		<div id="logo"><img src='imagens/hitss.jpg' height=80px width=180px /> </div>
		<h1>Inventarios de Hosts de VMWare </h1>
        </div>
	<div id="menu">
		<ul>
                	<h4> <a href="index.php">Home</a></h4>
			<h4> <a href="windows.php">Windows</a></h4>
			<h4> <a href="#">Hosts Vmware</a></h4>
               		<h4> <a href="obsolescencia.php">Obsolescencia</a></h4>
			<h4> <a href="remotos.php">Acessos Remotos</a></h4>
                	<h4> <a href="#">Relatorios</a></h4>
                	<h4> <a href="aaa.php">Outros</a></h4>
        	</ul>
	</div>

	<div id="centro">

	
		<?php
			$strBanco = "host=localhost port=5432 dbname=portalsrv_tst user=portalusr password=P0rta1!";
			if(!@($conexao = pg_connect($strBanco))){
				print "Num deu boa";
				echo "ERRRORRR";
			}else{
				$sql = "SELECT * FROM inv_srv";
				$result = pg_query($conexao, $sql);
				$resultAll = pg_fetch_all($result);
				echo "<table border='2'>";
				/*	echo "<th colspan = " . "2 " ."></th>"; */
				echo "<tr>
					<th align='center'>HOSTNAME</th>
					<th align='center'>IP</th>
					<th align='center'>TIPO</th>
					<th align='center'>RESPONSAVEL</th>
					<th align='center'>AMBIENTE</th>
					<th align='center'>SISTEMA OPERACIONAL</th>
					<th align='center'>OBSOLESCENCIA</th>
				</tr>";

			foreach($resultAll as $key){
				echo "<tr>";
                                echo "<td align='center'>" . $key['hostname'] . "</td>"; 
                                echo "<td align='center'>" . $key['ip'] . "</td>";
				echo "<td align='center'>" . $key['tipo'] . "</td>";
				echo "<td align='center'>" . $key['responsavel'] . "</td>";
				echo "<td align='center'>" . $key['ambiente'] . "</td>";
				echo "<td align='center'>" . $key['so'] . "</td>";
				echo "<td align='center'>" . $key['obsolescencia'] . "</td>";
                                echo "</tr>";
			}

			echo "</table>";

			pg_close($conexao);
			}

		?>
	</div>



</body>
</html>
