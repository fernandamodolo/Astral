<?php

require('fpdf.php');        

class PDF extends FPDF
{    
	// Cabeçalho
	function Header()
	{
		$this->Image('logo_preta.jpg',10,10,60);
        $this->Image('logo_cti.jpg',170,5,30);
		$this->SetFont('Arial','',11);
		$this->Cell(80);
		$this->Cell(60,10,'Colégio Técnico Industrial "Prof. Isaac Portal Roldán"',0,0,'C');         
		$this->Ln(20);
	}

	// Rodapé
	function Footer()
	{
		$this->SetY(-25); // Position from bottom

		$this->SetFont('Arial','',10);
        $this->Cell(0,10,'Astral - astralbauru2020@gmail.com',0,0,'C');
        $this->Ln(5);
        
        $this->Cell(0,10,'08 - Bruna | 12 - Eduardo | 14 - Fernanda | 18 - Jean | 21 - José Henrique | 27 - Marcela',0,0,'C');
        $this->Ln(5);

        $this->Cell(0,10,'Projeto de Loja Virtual - 2020',0,0,'C');
	}

    function Title($data_compra, $id_compra, $endereco)
    {

        $this->SetFont('Arial','B',20);
        $this->Cell(0,10,'RELATÓRIO DE COMPRA - ASTRAL LTDA.',1,0,'C');
        $this->Ln(20);

        // id da compra
        $this->SetFont('Arial','B',14);
        if($id_compra<10)
            $this->Cell(0,10,'Código da Compra: 0'.$id_compra,0,0,'L');
        else
            $this->Cell(0,10,'Código da Compra: '.$id_compra,0,0,'L');

        $this->Ln(15);

        // data da compra
        $this->SetFont('Arial','B',14);
        $this->Cell(0,10,'Data da Compra: '.$data_compra,0,0,'L');
        $this->Ln(15);

        // endereço de entrega
        $this->SetFont('Arial','B',14);
        $this->Cell(0,10,'Endereço de Entrega: '.$endereco,0,0,'L');
        $this->Ln(15);

        // itens da compra
        $this->SetFont('Arial','B',14);
        $this->Cell(0,10,'Itens da Compra: ',0,0,'L');
        $this->Ln(15);
    }
    
    function ReceiptHeader($header)
    {
        $this->SetFont('Arial','B',16);

        $this->SetFillColor(255,255,255);
        $this->Cell(20, 8, "", 0, 0, 'C', true);

        // Header
        $this->SetFillColor(135,206,235);

        foreach($header as $column)
            $this->Cell(50, 8, $column, 1, 0, 'C', true);

        $this->Ln(8);
    }
  
    function ReceiptData($dados_compra, $total, $pagamento)
    {
        $this->SetFont('Arial','',13);

        for($i=0; $i<count($dados_compra); $i++)
        {
            //Quebra pagina?
            if(($i%29) == 0 && $i != 0)
            {
                $this->AddPage();
                $this->Ln(26);
            }

            //Color
            if($i%2 == 1)
            {
                $this->SetFillColor(255,255,255);
                $this->Cell(20, 8, "", 0, 0, 'C', true);
                $this->SetFillColor(220,220,220);
            }
            else
            {
                $this->SetFillColor(255,255,255);
                $this->Cell(20, 8, "", 0, 0, 'C', true);
                $this->SetFillColor(255,255,255);
            }

            for($j=0; $j<3; $j++)
            {
                $this->Cell(50, 8, $dados_compra[$i][$j], 1, 0, 'C', true);
            }

            $this->Ln();
        }

        // total da compra
        $this->Ln(15);
        $this->SetFont('Arial','B',14);
        $this->Cell(0,10,'Total da compra: R$ '.$total,0,0,'');
        $this->Ln(15);

        // forma de pagamento
        $this->SetFont('Arial','B',14);
        $this->Cell(0,10,'Forma de pagamento: '.$pagamento,0,0,'');
    }
}

//*******************************************************************************************************//

        session_start();
        
        
        /*$id_cliente = $_SESSION['id_cliente'];
        $pagamento = $_SESSION['pagamento'];
        $data = $_SESSION['data'];
        $endereco = $_SESSION['endereco'];*/

        $id_cliente = 5;
        $pagamento = "Boleto";
        $data = "06-11-2020";
        $endereco = $_SESSION['endereco'];
        $id_compra = 5;


        include("./conexao.php");

        //$id_compra = $_GET["id_compra"];

        // PEGAR DADOS DA COMPRA ------------------------------------------------------------------

        /*$sql = "SELECT * FROM compra WHERE id_cliente = $id_cliente ORDER BY id_compra DESC;";

        $resultado = pg_query($conecta, $sql);
        $qtde = pg_num_rows($resultado);

        if ($qtde < 0)
        {
            return;
        }

        $linha = pg_fetch_array($resultado);
        
        $id_compra = $linha['id_compra'];
        $data_compra = $linha['data_compra'];
        //$endereco = $linha['endereco'];*/

        // PEGAR DADOS DOS ITENS_COMPRA ------------------------------------------------------------
        /*$sql2 = "SELECT compra.id_compra, produtos.descricao, itens_compra.quantidade, produtos.preco                FROM itens_compra
                 JOIN compra ON itens_compra.id_compra=compra.id_compra
                 INNER JOIN produtos ON itens_compra.id_prod=produtos.id_prod
                 WHERE id_cliente = $id_cliente AND compra.id_compra = $id_compra ORDER BY data_compra;";

        $resultado2 = pg_query($conecta, $sql2);
        $qtde2 = pg_num_rows($resultado2);

        if ($qtde2 < 0)
        {
            return;
        }*/

        $i = 0;
        $total = 0;

        //while ($linha2 = pg_fetch_array($resultado2))
        //{
            //$descricao = $linha2['descricao'];
            $quantidade = $linha2['quantidade'];
            //$preco = $linha2['preco'];

            $subtotal = $preco * $quantidade;
            //$total += $subtotal;

            if($i == 0)
            {
                $dados_compra = array(array("$descricao", "$quantidade", "$subtotal"));
            }
            else
            {
                array_push($dados_compra, array("$descricao", "$quantidade", "$subtotal"));
            }

            //$i++;
        //}

        pg_close($conecta);

//*******************************************************************************************************//

$tableHeader = ['Produto','Quantidade','Preço (R$)'];

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();

$pdf->AddPage();
    $pdf->Title($data_compra, $id_compra, $endereco);
    $pdf->ReceiptHeader($tableHeader);
    $pdf->ReceiptData($dados_compra, $total, $pagamento);

// Saída
$pdf->Output('I','relatorio_compra_astral.pdf');
?>