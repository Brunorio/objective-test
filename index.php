<?php 

abstract class VerificaMultiplo {
  protected ?VerificaMultiplo $proximo = null;
  abstract public function executar(int $valor): string;

  public function setProximo(VerificaMultiplo $proximo): self {
    $this->proximo = $proximo;
    return $this;
  }

  public function obterProximo(int $valor): string {
    if(!empty($this->proximo ?? "")) return $this->proximo->executar($valor);
    return (string) $valor;
  }
}

class MultiploDeCincoETres extends VerificaMultiplo {
  public function executar(int $valor): string {
    if($valor % 3 == 0 && $valor % 5 == 0) return "BatataDoce";
    return $this->obterProximo($valor);
  }
}

class MultiploDeTres extends VerificaMultiplo {
 

  public function executar(int $valor): string {
    if($valor % 3 == 0) return "Batata";
    return $this->obterProximo($valor);
  }
}

class MultiploDeCinco extends VerificaMultiplo {
  public function executar(int $valor): string {
    if($valor % 5 == 0) return "Doce";
    return $this->obterProximo($valor);
  }
}

// Caso seja necessário adicionar mais condições
class MultiploDeSete extends VerificaMultiplo {
  public function executar(int $valor): string {
    if($valor % 7 == 0) return "Milho";
    return $this->obterProximo($valor);
  }
}

function loop(int $quantidade): void {
  $verificaMultiplo = (new MultiploDeCincoETres)
    ->setProximo( 
      (new MultiploDeTres)
        ->setProximo(
          (new MultiploDeCinco)
            ->setProximo(new MultiploDeSete)
        )
    );

  for($contador = 1; $contador <= $quantidade; $contador++) {
    echo $verificaMultiplo->executar($contador) . PHP_EOL;
  }
}


loop(100);




