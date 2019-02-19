<?php

class Veiculo{

    protected $nome;
    protected $marca;
    protected $cor;

    function __construct(){
        
    }

    function veiculo($nome, $marca, $cor){
        $this->nome = $nome;
        $this->marca = $marca;
        $this->cor = $cor;
    }

    function ligarVeiculo(){
        //Execução do código para ligar o Veículo
    }
    function desligarVeiculo(){
        //Execução do código para desligar o Veículo
    }
    function acelerarVeiculo(){
        //Execução do código para acelerar o Veículo
    }
    function frearVeiculo(){
        //Execução do código para frear o Veículo
    }
}

class Carro extends Veiculo{

    function __construct(){
        
    }
    function carro($nome, $marca, $cor){
        $carro = (new Veiculo)->veiculo($nome, $marca, $cor);
        //$carro->ligarVeiculo();
        //$carro->desligarVeiculo();
        //$carro->acelerarVeiculo();
        //$carro->frearVeiculo();
        return $carro;
    }

}

class Moto extends Veiculo{

    function __construct(){
        
    }
    function moto($nome, $marca, $cor){
        $moto = (new Veiculo)->veiculo($nome, $marca, $cor);
        //$moto->ligarVeiculo();
        //$moto->desligarVeiculo();
        //$moto->acelerarVeiculo();
        //$moto->frearVeiculo();
        return $moto;
    }
}

class Estacionamento{

    private $nomeEstacionemto;
    private $localizacao;
    private $veiculos = [];

    function estacionamento($nomeEstacionamento, $localizacao){
        $this->nomeEstacionemto = $nomeEstacionamento;
        $this->localizacao = $localizacao;
        
        $veiculos = [
            'moto' => (new Moto)->moto($nomeMoto, $marcaMoto, $modeloMoto),
            'carro'=> (new Carro)->carro($nomeCarro, $marcaCarro, $modeloCarro)
        ];
    }
}
