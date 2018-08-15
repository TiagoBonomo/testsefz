<?php
ini_set('max_execution_time', 20000);
include("bancoClasse.php");



$arquivo = "dados.json";

$info = file_get_contents('dados.json');
$contents = utf8_encode($info);
$resul = json_decode($contents); 

$contai = 0;
$contac = 0;

echo 'arquivo<br/>';
var_dump($arquivo);

echo 'info<br/>';
var_dump($info);

echo ' resultato<br/> ';


$db1 = new bancoClasse();
$db2 = new bancoClasse();
$db3 = new bancoClasse();

if(!$db1 & !$db2) {
   
    echo $db1->lastErrorMsg();
    echo $db2->lastErrorMsg();

} else {
    
   echo "Opened database successfully<br/>\n";

}

$sql1 =<<<EOF
      CREATE TABLE aidebito
      (tipo INT,
      numero INT,
      nd INT,
      inscricaoEstaudal TEXT,
      dataEmissao TEXT,
      dataPagamento TEXT,
      vlrImposto REAL);
EOF;

$sql2 =<<<EOF
      CREATE TABLE acdebito
      (tipo INT,
      numero INT,
      nd INT,
      inscricaoEstaudal TEXT,
      dataEmissao TEXT,
      dataPagamento TEXT,
      vlrImposto REAL);
EOF;

            $ret1 = $db1->exec($sql1);
            $ret2 = $db2->exec($sql2);
            
   if(!$ret1 & !$ret2){
      echo $db1->lastErrorMsg();
      echo $db2->lastErrorMsg();
   } else {
      echo "Table created successfully<br/>\n";
   }

   $db1->close();
   $db2->close();

  foreach ($resul as $key => $value)
    {

        
        if(!$db3){
        echo $db3->lastErrorMsg();
        } else {
        echo "Opened database successfully<br/>\n";
        }


        $c1 = $value->tipo;
        $c2 = $value->numero;
        $c3 = $value->inscricaoEstaudal;
        $c4 = $value->dataEmissao;
        $c5 = $value->dataPagamento;
        $c6 = $value->vlrImposto;

        if($c1 == "AI" ){
            $contai=$contai+1;

            echo " AI<br/>\n ";       
            $ins = "INSERT INTO aidebito (tipo,numero,nd,inscricaoEstaudal,dataEmissao,dataPagamento,vlrImposto) VALUES ('{$c1}','{$c2}','','{$c3}','{$c4}','{$c5}','{$c6}' )"; 
            $ret = $db3->exec($ins);
            if(!$ret) {
                echo $db3->lastErrorMsg();
                } else {
                    echo "Records created successfully<br/>\n";
                }
            

        }else{
            $contac=$contac+1;
            echo " AC<br/>\n ";
            $ins = "INSERT INTO acdebito (tipo,numero,nd,inscricaoEstaudal,dataEmissao,dataPagamento,vlrImposto) VALUES ('{$c1}','{$c2}','','{$c3}','{$c4}','{$c5}','{$c6}' )"; 
            $ret = $db3->exec($ins);
            if(!$ret) {
                echo $db3->lastErrorMsg();
                } else {
                    echo "Records created successfully<br/>\n";
                }
            
        }


        

    }

    echo " FIM SCRIPT !!! <br/>";
    echo " debito AI !!! ".$contai;
    echo "<br/> debito AC !!! ".$contac;

  

