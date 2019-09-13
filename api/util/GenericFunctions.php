<?php
Class GenericFunctions {


    public static function getInstance()
    {
        static $instance = null;
		if (null === $instance){
			$instance = new static();
		}
		return $instance;
    }
    function formatCel($cel) {
        return "(" .substr($cel, 0, 2). ") " . substr($cel, 2, 5) . "-" . substr($cel, 7, 4); 
    }
    function formatMoeda ( $num ) {
        return 'R$ ' . number_format($num, 2, ',', '.'); // retorna R$000.000,00
    }
    function formatCargo ( $perfil ) {
        return ($perfil==="LIDER") ? "Supervisor(a) de Vendas" : "Consultor(a) de Vendas";
    }
    function formatInteresse ( $interesse ) {
        switch ($interesse) {
            case 'AUTOMOVEL': $interesse = "Automóvel";
            case 'IMOVEL': $interesse = "Imóvel";
            case 'MOTO': $interesse = "Moto";
            case 'SERVICO': $interesse = "Serivico";
            case 'PESADO': $interesse = "Pesado";
        }
        return $interesse;
    }
    function formatNome ($nome) {
        $nome = strtolower($nome);
        $split = explode(" ", $nome);
        $array = array("de", "do", "da", "dos", "das");
        $nome = "";
        foreach ($split as $key) {
            if (array_search($key, $array)) {
                $nome .= $key . " ";
            }else{
                $nome .= ucfirst($key) . " ";
            }
        }
        return trim($nome);
    }
}

class_alias('GenericFunctions', 'GenFun');
?>