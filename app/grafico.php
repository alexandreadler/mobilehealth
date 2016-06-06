<?php

//chamamos a class phpLOT
require_once 'phplot/phplot.php';

$plot = new PHPlot();
$m = 0;



// Aqui nos definimos o título do gráfico
if($_GET['t'] == 0){
	
	$plot->SetTitle("Glicose");
	$records = Bloodglucose::select(DB::raw('measure as data, datetime'))->where("id_person",'=',$_GET['p'])->orderBy('datetime', 'desc')->take(15)->get();
	$m = 10;
	# Y Tick marks are off, but Y Tick Increment also controls the Y grid lines:
	$plot->SetYTickIncrement(10);
	
} else if($_GET['t'] == 1){
	
	$plot->SetTitle("Pressão Sanguínia");
	$records = Bloodpressure::select(DB::raw('pulse as data, datetime'))->where("id_person",'=',$_GET['p'])->orderBy('datetime', 'desc')->take(15)->get();
	# Y Tick marks are off, but Y Tick Increment also controls the Y grid lines:
	$plot->SetYTickIncrement(2);
	
	
} else if($_GET['t'] == 2){
	
	$plot->SetTitle("Peso (Kg)");
	$records = Weight::select(DB::raw('weight as data, datetime'))->where("id_person",'=',$_GET['p'])->orderBy('datetime', 'desc')->take(15)->get();
	$m = 40;
	# Y Tick marks are off, but Y Tick Increment also controls the Y grid lines:
	$plot->SetYTickIncrement(10);
	$m = 40;
	
} else if($_GET['t'] == 3){
	
	$plot->SetTitle("Altura (cm)");
	$records = Height::select(DB::raw('height as data, datetime'))->where("id_person",'=',$_GET['p'])->orderBy('datetime', 'desc')->take(15)->get();
	# Y Tick marks are off, but Y Tick Increment also controls the Y grid lines:
	$plot->SetYTickIncrement(10);
	$m = 100;
	
}


for($i = count($records)-1; $i >=0; $i--){
	$d = date('d/M ', strtotime($records[$i]['datetime']));
	$data[] = array($d, $records[$i]['data']);
			
}


//$data = $_GET['data']; //recebo
//$data = urldecode($data); //agora a ordem inversa, uso url decode para transforma no modo serializado
//$data = stripslashes($data); // retira as barras que vem depois de decodificado
//$data = unserialize($data);//e finalmente faço o unserialize, aqui ele volta a ser o array original.


//Aqui nos temos a propriedades da class phplot, podemos definir a cor dos textos de nosso gráfico
$plot->SetTextColor('blue');

// Cor dos valores da escala em y
//$plot->SetTickLabelColor('green');

//Aqui nos temos a propriedades da class phplot, podemos definir a cor do título de nosso gráfico
$plot->SetTitleColor('blue');

// Cor dos valores da escala em X
//$plot->SetDataLabelColor('red');

//aqui nos definimos a cor da exibição da quantidade de votos, coloquei vermelho
$plot->SetDataValueLabelColor('red');


//tipo da borda da imagem
$plot->SetImageBorderType('plain');


//Aqui os definimos qual o tipo de gráfico que nos queremos, se pizza ou barras, ou linhas etc.
$plot->SetPlotType('lines');


$plot->SetDataType('text-data');

// Array com os valores -> a = [("Texto em x"), valor em y]
$plot->SetDataValues($data);


# Turn off X tick labels and ticks because they don't apply here:
#$plot->SetXTickLabelPos('none');
$plot->SetXTickPos('none');

# Make sure Y=0 is displayed:
$plot->SetPlotAreaWorld(NULL, $m);


# Turn on Y data labels:
$plot->SetYDataLabelPos('plotin');

# With Y data labels, we don't need Y ticks or their labels, so turn them off.
#$plot->SetYTickLabelPos('none');
#$plot->SetYTickPos('none');
//Gerando o gráfico
$plot->DrawGraph();


?>