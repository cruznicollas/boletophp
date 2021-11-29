<?php

    // ------------------------- DADOS DINÂMICOS DO SEU CLIENTE PARA A GERAÇÃO DO BOLETO (FIXO OU VIA GET) -------------------- //
    // Os valores abaixo podem ser colocados manualmente ou ajustados p/ formulário c/ POST, GET ou de BD (MySql,Postgre,etc)   //


    // DADOS DO BOLETO PARA O SEU CLIENTE

use JetBrains\PhpStorm\Pure;

class Boleto
{
    // DADOS DO BOLETO PARA O SEU CLIENTE
    public $dias_de_prazo_para_pagamento;
    public $taxa_boleto;
    public $data_vencimento; //date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias  OU  informe data: "13/04/2006"  OU  informe "" se Contra Apresentação;
    public $valor_cobrado;
    public $valor_boleto;

    public $inicio_nosso_numero;  // Carteira SR: 80, 81 ou 82  -  Carteira CR: 90 (Confirmar com gerente qual usar)
    public $nosso_numero;  // Nosso numero sem o DV - REGRA: Máximo de 8 caracteres!
    public $numero_documento;    // Num do pedido ou do documento
    public $data_documento; // Data de emissão do Boleto
    public $data_processamento; // Data de processamento do boleto (opcional)

    // DADOS DO SEU CLIENTE
    public $sacado;
    public $endereco1;
    public $endereco2;

    // INFORMACOES PARA O CLIENTE
    public $demonstrativo1;
    public $demonstrativo2;
    public $demonstrativo3;

    // INSTRUÇÕES PARA O CAIXA
    public $instrucoes1;
    public $instrucoes2;
    public $instrucoes3;
    public $instrucoes4;

    // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
    public $quantidade;
    public $valor_unitario;
    public $aceite;
    public $especie;
    public $especie_doc;


    // ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


    // DADOS DA SUA CONTA - CEF
    public $agencia; // Num da agencia, sem digito
    public $conta;     // Num da conta, sem digito
    public $conta_dv;     // Digito do Num da conta

    // DADOS PERSONALIZADOS - CEF
    public $conta_cedente; // ContaCedente do Cliente, sem digito (Somente Números)
    public $conta_cedente_dv; // Digito da ContaCedente do Cliente
    public $carteira;  // Código da Carteira: pode ser SR (Sem Registro) ou CR (Com Registro) - (Confirmar com gerente qual usar)

    // SEUS DADOS
    public $identificacao;
    public $cpf_cnpj;
    public $endereco ;
    public $cidade_uf;
    public $cedente;
    public $codigobanco;
    public $codigo_banco_com_dv;
    public $nummoeda;
    public $fator_vencimento;

    //valor tem 10 digitos, sem virgula
    public $valor;

    //nosso número (sem dv) é 10 digitos
    public $nnum;
    //dv do nosso número
    public $dv_nosso_numero;
    public $nossonumero_dv;
    public $ag_contacedente;

    // 43 numeros para o calculo do digito verificador do codigo de barras
    public $dv;
    // Numero para o codigo de barras com 44 digitos
    public $linha;

    public $codigo_barras;
    public $linha_digitavel;
    public $agencia_codigo;
    public $data_venc;

    // CONSTRUTOR DA CLASSE

    function __construct()
    {
        // DADOS DO BOLETO PARA O SEU CLIENTE

        $this->dias_de_prazo_para_pagamento = 5;
        $this->taxa_boleto = 2.95;
        $this->data_venc = "30/11/2021";
        $this->data_vencimento = $this->data_venc; //date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias  OU  informe data: "13/04/2006"  OU  informe "" se Contra Apresentacao;
        $this->valor_cobrado = "2950,00"; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
        $this->valor_cobrado = str_replace(",", ".", $this->valor_cobrado);
        $this->valor_boleto = number_format($this->valor_cobrado + $this->taxa_boleto, 2, ',', '');

        $this->inicio_nosso_numero = "80";  // Carteira SR: 80, 81 ou 82  -  Carteira CR: 90 (Confirmar com gerente qual usar)
        $this->nosso_numero = "19525086";  // Nosso numero sem o DV - REGRA: Máximo de 8 caracteres!
        $this->numero_documento = "27.030195.10";    // Num do pedido ou do documento
        $this->data_documento = date("d/m/Y"); // Data de emissão do Boleto
        $this->data_processamento = date("d/m/Y"); // Data de processamento do boleto (opcional)

        // DADOS DO SEU CLIENTE
        $this->sacado = "Nome do seu Cliente";
        $this->endereco1 = "Endereço do seu Cliente";
        $this->endereco2 = "Cidade - Estado -  CEP: 00000-000";

        // INFORMACOES PARA O CLIENTE
        $this->demonstrativo1 = "Pagamento de Compra na Loja Nonononono";
        $this->demonstrativo2 = "Mensalidade referente a nonon nonooon nononon<br>Taxa bancária - R$ " . number_format($this->taxa_boleto, 2, ',', '');
        $this->demonstrativo3 = "BoletoPhp - http://www.boletophp.com.br";

        // INSTRUÇÕES PARA O CAIXA
        $this->instrucoes1 = "- Sr. Caixa, cobrar multa de 2% após o vencimento";
        $this->instrucoes2 = "- Receber até 10 dias após o vencimento";
        $this->instrucoes3 = "- Em caso de dúvidas entre em contato conosco: xxxx@xxxx.com.br";
        $this->instrucoes4 = "&nbsp; Emitido pelo sistema Projeto BoletoPhp - www.boletophp.com.br";

        // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
        $this->quantidade = "";
        $this->valor_unitario = "";
        $this->aceite = "";
        $this->especie = "R$";
        $this->especie_doc = "";


        // ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


        // DADOS DA SUA CONTA - CEF
        $this->agencia = "1565"; // Num da agencia, sem digito
        $this->conta = "13877";     // Num da conta, sem digito
        $this->conta_dv = "4";     // Digito do Num da conta

        // DADOS PERSONALIZADOS - CEF
        $this->conta_cedente = "87000000414"; // ContaCedente do Cliente, sem digito (Somente Números)
        $this->conta_cedente_dv = "3"; // Digito da ContaCedente do Cliente
        $this->carteira = "SR";  // Código da Carteira: pode ser SR (Sem Registro) ou CR (Com Registro) - (Confirmar com gerente qual usar)

        // SEUS DADOS
        $this->identificacao = "BoletoPhp - Código Aberto de Sistema de Boletos";
        $this->cpf_cnpj = "";
        $this->endereco = "Coloque o endereço da sua empresa aqui";
        $this->cidade_uf = "Cidade / Estado";
        $this->cedente = "Coloque a Razão Social da sua empresa aqui";

        $this->codigobanco = "104";
        $this->codigo_banco_com_dv = $this->geraCodigo_Banco($this->codigobanco);
        $this->nummoeda = "9";
        $this->fator_vencimento = $this->fator_vencimento($this->data_vencimento);

        //valor tem 10 digitos, sem virgula
        $this->valor = $this->formataNumero($this->valor_boleto, 10, 0, "valor");
        //agencia é 4 digitos
        $this->agencia = $this->formataNumero($this->agencia, 4, 0);
        //conta é 5 digitos
        $this->conta = $this->formataNumero($this->conta, 5, 0);
        //dv da conta
        $this->conta_dv = $this->formataNumero($this->conta_dv, 1, 0);

        //nosso número (sem dv) é 10 digitos
        $this->nnum = $this->inicio_nosso_numero . $this->formataNumero($this->nosso_numero, 8, 0);
        //dv do nosso número
        $this->dv_nosso_numero = $this->digitoVerificadorNossonumero($this->nnum);
        $this->nossonumero_dv = $this->nnum .  $this->dv_nosso_numero;

        //conta cedente (sem dv) é 11 digitos
        $this->conta_cedente = $this->formataNumero($this->conta_cedente, 11, 0);
        //dv da conta cedente
        $this->conta_cedente_dv = $this->formataNumero($this->conta_cedente_dv, 1, 0);

        $this->ag_contacedente = $this->agencia . $this->conta_cedente;

        // 43 numeros para o calculo do digito verificador do codigo de barras
        $this->dv = $this->digitoVerificadorBarra("$this->codigobanco$this->nummoeda$this->fator_vencimento$this->valor$this->nnum$this->ag_contacedente");
        // Numero para o codigo de barras com 44 digitos
        $this->linha = "$this->codigobanco$this->nummoeda$this->dv$this->fator_vencimento$this->valor$this->nnum$this->ag_contacedente";

        $this->nossonumero = substr($this->nossonumero_dv, 0, 10) . '-' . substr($this->nossonumero_dv, 10, 1);
        $this->agencia_codigo = $this->agencia . " / " . $this->conta_cedente . "-" . $this->conta_cedente_dv;


        $this->codigo_barras = $this->linha;
        $this->linha_digitavel = $this->monta_linha_digitavel($this->linha);
        // $this->codigo_de_barras_impresso = $this->fbarcode($this->codigo_barras);
    }
    // FUNÇÕES

    function digitoVerificadorNossonumero($numero)
    {
        $resto2 = $this->modulo_11($numero, 9, 1);
        $digito = 11 - $resto2;
        if ($digito == 10 || $digito == 11) {
            $dv = 0;
        } else {
            $dv = $digito;
        }
        return $dv;
    }


    function digitoVerificadorBarra($numero)
    {
        $resto2 = $this->modulo_11($numero, 9, 1);
        if ($resto2 == 0 || $resto2 == 1 || $resto2 == 10) {
            $dv = 1;
        } else {
            $dv = 11 - $resto2;
        }
        return $dv;
    }

    function formataNumero($numero, $loop, $insert, $tipo = "geral")
    {
        if ($tipo == "geral") {
            $numero = str_replace(",", "", $numero);
            while (strlen($numero) < $loop) {
                $numero = $insert . $numero;
            }
        }
        if ($tipo == "valor") {
        /*
            retira as virgulas
            formata o numero
            preenche com zeros
            */
            $numero = str_replace(",", "", $numero);
            while (strlen($numero) < $loop) {
                $numero = $insert . $numero;
            }
        }
        if ($tipo == "convenio") {
            while (strlen($numero) < $loop) {
                $numero = $numero . $insert;
            }
        }
        return $numero;
    }


    function fbarcode($valor)
    {

        $fino = 1 ;
        $largo = 3 ;
        $altura = 50 ;

        $barcodes[0] = "00110" ;
        $barcodes[1] = "10001" ;
        $barcodes[2] = "01001" ;
        $barcodes[3] = "11000" ;
        $barcodes[4] = "00101" ;
        $barcodes[5] = "10100" ;
        $barcodes[6] = "01100" ;
        $barcodes[7] = "00011" ;
        $barcodes[8] = "10010" ;
        $barcodes[9] = "01010" ;
        for ($f1 = 9; $f1 >= 0; $f1--) {
            for ($f2 = 9; $f2 >= 0; $f2--) {
                $f = ($f1 * 10) + $f2 ;
                $texto = "" ;
                for ($i = 1; $i < 6; $i++) {
                    $texto .=  substr($barcodes[$f1], ($i - 1), 1) . substr($barcodes[$f2], ($i - 1), 1);
                }
                $barcodes[$f] = $texto;
            }
        }


//Desenho da barra


//Guarda inicial
        ?><img src=imagens/p.png width=<?php echo $fino?> height=<?php echo $altura?> border=0><img
                src=imagens/b.png width=<?php echo $fino?> height=<?php echo $altura?> border=0><img
                src=imagens/p.png width=<?php echo $fino?> height=<?php echo $altura?> border=0><img
                src=imagens/b.png width=<?php echo $fino?> height=<?php echo $altura?> border=0><img
        <?php
        $texto = $valor ;
        if ((strlen($texto) % 2) <> 0) {
            $texto = "0" . $texto;
        }

// Draw dos dados
        while (strlen($texto) > 0) {
            $i = round($this->esquerda($texto, 2));
            $texto = $this->direita($texto, strlen($texto) - 2);
            $f = $barcodes[$i];
            for ($i = 1; $i < 11; $i += 2) {
                if (substr($f, ($i - 1), 1) == "0") {
                    $f1 = $fino ;
                } else {
                    $f1 = $largo ;
                }
                ?>
                src=imagens/p.png width=<?php echo $f1?> height=<?php echo $altura?> border=0><img
                    <?php
                    if (substr($f, $i, 1) == "0") {
                        $f2 = $fino ;
                    } else {
                        $f2 = $largo ;
                    }
                    ?>
                        src=imagens/b.png width=<?php echo $f2?> height=<?php echo $altura?> border=0><img
                <?php
            }
        }

// Draw guarda final
        ?>
        src=imagens/p.png width=<?php echo $largo?> height=<?php echo $altura?> border=0><img
                src=imagens/b.png width=<?php echo $fino?> height=<?php echo $altura?> border=0><img
                src=imagens/p.png width=<?php echo 1?> height=<?php echo $altura?> border=0>
        <?php
    } //Fim da função

    function esquerda($entra, $comp)
    {
        return floatval(substr($entra, 0, $comp));
    }

    function direita($entra, $comp)
    {
        return substr($entra, strlen($entra) - $comp, $comp);
    }

    function fator_vencimento($data)
    {
        if ($data != "") {
            $data = explode("/", $data);
            $ano = $data[2];
            $mes = $data[1];
            $dia = $data[0];
            return(abs(($this->dateToDays("1997", "10", "07")) - ($this->dateToDays($ano, $mes, $dia))));
        } else {
            return "0000";
        }
    }

    function dateToDays($year, $month, $day)
    {
        $century = substr($year, 0, 2);
        $year = substr($year, 2, 2);
        if ($month > 2) {
            $month -= 3;
        } else {
            $month += 9;
            if ($year) {
                $year--;
            } else {
                $year = 99;
                $century--;
            }
        }
        return ( floor((  146097 * $century)    /  4) +
                floor(( 1461 * $year)        /  4) +
                floor(( 153 * $month +  2) /  5) +
                    $day +  1721119);
    }

    function modulo_10($num)
    {
            $numtotal10 = 0;
            $fator = 2;

            // Separacao dos numeros
        for ($i = strlen($num); $i > 0; $i--) {
            // pega cada numero isoladamente
            $numeros[$i] = substr($num, $i - 1, 1);
            // Efetua multiplicacao do numero pelo (falor 10)
            $temp = $numeros[$i] * $fator;
            $temp0 = 0;
            foreach (preg_split('//', $temp, -1, PREG_SPLIT_NO_EMPTY) as $k => $v) {
                $temp0 += $v;
            }
            $parcial10[$i] = $temp0; //$numeros[$i] * $fator;
            // monta sequencia para soma dos digitos no (modulo 10)
            $numtotal10 += $parcial10[$i];
            if ($fator == 2) {
                $fator = 1;
            } else {
                $fator = 2; // intercala fator de multiplicacao (modulo 10)
            }
        }

            // várias linhas removidas, vide função original
            // Calculo do modulo 10
            $resto = $numtotal10 % 10;
            $digito = 10 - $resto;
        if ($resto == 0) {
            $digito = 0;
        }

            return $digito;
    }

    function modulo_11($num, $base = 9, $r = 0)
    {
        /**
         *   Autor:
         *           Pablo Costa <pablo@users.sourceforge.net>
         *
         *   Função:
         *    Calculo do Modulo 11 para geracao do digito verificador
         *    de boletos bancarios conforme documentos obtidos
         *    da Febraban - www.febraban.org.br
         *
         *   Entrada:
         *     $num: numérica para a qual se deseja calcularo digito verificador;
         *     $base: valor maximo de multiplicacao [2-$base]
         *     $r: quando especificado um devolve somente o resto
         *
         *   Saída:
         *     Retorna o Digito verificador.
         *
         *   Observações:
         *     - Script desenvolvido sem nenhum reaproveitamento de código pré existente.
         *     - Assume-se que a verificação do formato das variáveis de entrada é feita antes da execução deste script.
         */

        $soma = 0;
        $fator = 2;

        /* Separacao dos numeros */
        for ($i = strlen($num); $i > 0; $i--) {
            // pega cada numero isoladamente
            $numeros[$i] = substr($num, $i - 1, 1);
            // Efetua multiplicacao do numero pelo falor
            $parcial[$i] = $numeros[$i] * $fator;
            // Soma dos digitos
            $soma += $parcial[$i];
            if ($fator == $base) {
                // restaura fator de multiplicacao para 2
                $fator = 1;
            }
            $fator++;
        }

        /* Calculo do modulo 11 */
        if ($r == 0) {
            $soma *= 10;
            $digito = $soma % 11;
            if ($digito == 10) {
                $digito = 0;
            }
            return $digito;
        } elseif ($r == 1) {
            $resto = $soma % 11;
            return $resto;
        }
    }

    function monta_linha_digitavel($codigo)
    {

            // Posição  Conteúdo
            // 1 a 3    Número do banco
            // 4        Código da Moeda - 9 para Real
            // 5        Digito verificador do Código de Barras
            // 6 a 9   Fator de Vencimento
            // 10 a 19 Valor (8 inteiros e 2 decimais)
            // 20 a 44 Campo Livre definido por cada banco (25 caracteres)

            // 1. Campo - composto pelo código do banco, código da moéda, as cinco primeiras posições
            // do campo livre e DV (modulo10) deste campo
            $p1 = substr($codigo, 0, 4);
            $p2 = substr($codigo, 19, 5);
            $p3 = $this->modulo_10("$p1$p2");
            $p4 = "$p1$p2$p3";
            $p5 = substr($p4, 0, 5);
            $p6 = substr($p4, 5);
            $campo1 = "$p5.$p6";

            // 2. Campo - composto pelas posiçoes 6 a 15 do campo livre
            // e livre e DV (modulo10) deste campo
            $p1 = substr($codigo, 24, 10);
            $p2 = $this->modulo_10($p1);
            $p3 = "$p1$p2";
            $p4 = substr($p3, 0, 5);
            $p5 = substr($p3, 5);
            $campo2 = "$p4.$p5";

            // 3. Campo composto pelas posicoes 16 a 25 do campo livre
            // e livre e DV (modulo10) deste campo
            $p1 = substr($codigo, 34, 10);
            $p2 = $this->modulo_10($p1);
            $p3 = "$p1$p2";
            $p4 = substr($p3, 0, 5);
            $p5 = substr($p3, 5);
            $campo3 = "$p4.$p5";

            // 4. Campo - digito verificador do codigo de barras
            $campo4 = substr($codigo, 4, 1);

            // 5. Campo composto pelo fator vencimento e valor nominal do documento, sem
            // indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
            // tratar de valor zerado, a representacao deve ser 000 (tres zeros).
            $p1 = substr($codigo, 5, 4);
            $p2 = substr($codigo, 9, 10);
            $campo5 = "$p1$p2";

            return "$campo1 $campo2 $campo3 $campo4 $campo5";
    }

    function geraCodigo_Banco($numero)
    {
        $parte1 = substr($numero, 0, 3);
        $parte2 = $this->modulo_11($parte1);
        return $parte1 . "-" . $parte2;
    }
}

// NÃO ALTERAR!

$bol = new Boleto();
// echo $bol->gerarBoleto();






//echo $bol->dias_de_prazo_para_pagamento . "     <br>     ";
//echo $bol->taxa_boleto . "     <br>     ";
//echo $bol->data_vencimento . "     <br>     ";
//echo $bol->valor_cobrado . "     <br>     ";
//echo $bol->valor_boleto . "     <br>     ";
//echo $bol->codigobanco . "     <br>     ";
//echo $bol->codigo_banco_com_dv . "     <br>     ";
//echo $bol->nummoeda . "     <br>     ";
//echo $bol->fator_vencimento . "     <br>     ";
//echo $bol->valor . "     <br>     ";
//echo $bol->nnum . "     <br>     ";
//echo $bol->dv_nosso_numero . "     <br>     ";
//echo $bol->nossonumero_dv . "     <br>     ";
//echo $bol->ag_contacedente . "     <br>     ";
//echo $bol->dv . "     <br>     ";
//echo $bol->linha . "     <br>     ";
//echo $bol->codigo_barras . "     <br>     ";
//echo $bol->linha_digitavel . "     <br>     ";
//echo $bol->agencia_codigo . "     <br>     ";