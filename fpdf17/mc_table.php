<?php
require('fpdf.php');

class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;


var $tipo;

function cambiaTipo($tipo) {
 $this->tipo = $tipo;
}

function Header()
{
	if($this->header==1){
		// Logo
		// Logo
		$this->Image('imagenes/solo_hcm.png',10,8,15);
		// Arial bold 15
		$this->SetFont('Arial','B',8);
		$this->Cell(68,10,'HOSPITAL CLÍNICO DE MAGALLANES',0,0,'R');
		$this->SetFont('Arial','B',15);
		// Movernos a la derecha
		// Título
		$this->Cell(100,10,'INFORME DE ALTA (EPICRISIS)',0,0,'L');
		
		// Salto de línea
		$this->Ln(15);
	}
	if($this->header==2){
		// Logo
		$this->Image('imagenes/solo_hcm.png',10,8,15);
		// Arial bold 15
		$this->SetFont('Arial','B',8);
		$this->Cell(83,10,'HOSPITAL CLÍNICO DE MAGALLANES',0,0,'C');
		$this->SetFont('Arial','B',15);
		// Movernos a la derecha
		// Título
		$this->Cell(30,10,'RECETA DE ALTA',0,0,'C');
		$this->Image('imagenes/pediatria.png',135,8,25);
		$this->Cell(110,10,'Nº '.$this->nro_receta,0,0,'C');
		// Salto de línea
		$this->Ln(15);
	}
	if($this->header==3){
		// Logo
		$this->Image('imagenes/solo_hcm.png',10,8,15);
		// Arial bold 15
		$this->SetFont('Arial','B',8);
		$this->Cell(83,10,'HOSPITAL CLÍNICO DE MAGALLANES',0,0,'C');
		$this->SetFont('Arial','B',15);
		// Movernos a la derecha
		// Título
		$this->Cell(30,10,'RECETA DE ALTA',0,0,'C');

		$this->Cell(110,10,'Nº '.$this->nro_receta,0,0,'C');
		// Salto de línea
		$this->Ln(15);
	}
	if($this->header==4){
		// Logo
		// Logo
		$this->Image('imagenes/solo_hcm.png',10,8,15);
		// Arial bold 15
		$this->SetFont('Arial','B',8);
		$this->Cell(68,10,'HOSPITAL CLÍNICO DE MAGALLANES',0,0,'R');
		$this->SetFont('Arial','B',15);
		// Movernos a la derecha
		// Título
		$this->Cell(100,10,'INFORME DE ALTA (EPICRISIS)',0,0,'L');
		$this->Image('imagenes/pediatria.png',170,8,25);
		// Salto de línea
		$this->Ln(15);
	}
}

function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','B',10);

	$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');

}

function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		$this->Rect($x,$y,$w,$h);
		//Print the text
		$this->MultiCell($w,5,$data[$i],0,$a);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}
}
?>
