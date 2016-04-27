<?php

require_once "jpgraph/src/jpgraph.php";
require_once "jpgraph/src/jpgraph_line.php";

$valores = array (10,2,15,13,3,8,7,0,9,1);

$grafico = new Graph(600, 600);
$grafico->SetScale("textint");
$linhas = new LinePlot($valores);

$linhas->value->show();

$linhas->value->setColor("blue");

$grafico->add($linhas);

$grafico->img->setMargin(40,40,40,40);
$grafico->title->Set("Fiz um grafico");

$grafico->xaxis->title->Set("x");
$grafico->yaxis->title->Set("y");

$grafico->Stroke();
?>