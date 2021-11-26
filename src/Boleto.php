<?php

    // ------------------------- DADOS DINÂMICOS DO SEU CLIENTE PARA A GERAÇÃO DO BOLETO (FIXO OU VIA GET) -------------------- //
    // Os valores abaixo podem ser colocados manualmente ou ajustados p/ formulário c/ POST, GET ou de BD (MySql,Postgre,etc)   //


    // DADOS DO BOLETO PARA O SEU CLIENTE

class Boleto
{
    // DADOS DO BOLETO PARA O SEU CLIENTE
    public int $dias_de_prazo_para_pagamento;
    public float $taxa_boleto;
    public string $data_vencimento; //date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias  OU  informe data: "13/04/2006"  OU  informe "" se Contra Apresentacao;
    public string $valor_cobrado;
    public string $valor_boleto;

    public string $inicio_nosso_numero;  // Carteira SR: 80, 81 ou 82  -  Carteira CR: 90 (Confirmar com gerente qual usar)
    public string $nosso_numero;  // Nosso numero sem o DV - REGRA: Máximo de 8 caracteres!
    public string $numero_documento;    // Num do pedido ou do documento
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

    // CONSTRUTOR DA CLASSE

    function __construct()
    {
        // DADOS DO BOLETO PARA O SEU CLIENTE

        $this->dias_de_prazo_para_pagamento = 5;
        $this->taxa_boleto = 2.95;
        $this->data_vencimento = ""; //date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias  OU  informe data: "13/04/2006"  OU  informe "" se Contra Apresentacao;
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
        $this->codigo_banco_com_dv = geraCodigoBanco($this->codigobanco);
        $this->nummoeda = "9";
        $this->fator_vencimento = fator_vencimento($this->data_vencimento);

        //valor tem 10 digitos, sem virgula
        $this->valor = formataNumero($this->valor_boleto, 10, 0, "valor");
        //agencia é 4 digitos
        $this->agencia = formataNumero($this->agencia, 4, 0);
        //conta é 5 digitos
        $this->conta = formataNumero($this->conta, 5, 0);
        //dv da conta
        $this->conta_dv = formataNumero($this->conta_dv, 1, 0);

        //nosso número (sem dv) é 10 digitos
        $this->nnum = $this->inicio_nosso_numero . formataNumero($this->nosso_numero, 8, 0);
        //dv do nosso número
        $this->dv_nosso_numero = digitoVerificadorNossonumero($this->nnum);
        $this->nossonumero_dv = $this->nnum .  $this->dv_nosso_numero;

        //conta cedente (sem dv) é 11 digitos
        $this->conta_cedente = formataNumero($this->conta_cedente, 11, 0);
        //dv da conta cedente
        $this->conta_cedente_dv = formataNumero($this->conta_cedente_dv, 1, 0);

        $this->ag_contacedente = $this->agencia . $this->conta_cedente;

        // 43 numeros para o calculo do digito verificador do codigo de barras
        $this->dv = digitoVerificadorBarra("$this->codigobanco$this->nummoeda$this->fator_vencimento$this->valor$this->nnum$this->ag_contacedente");
        // Numero para o codigo de barras com 44 digitos
        $this->linha = "$this->codigobanco$this->nummoeda$this->dv$this->fator_vencimento$this->valor$this->nnum$this->ag_contacedente";

        $this->nossonumero = substr($this->Nossonumero_dv, 0, 10) . '-' . substr($this->nossonumero_dv, 10, 1);
        $this->agencia_codigo = $this->agencia . " / " . $this->conta_cedente . "-" . $this->conta_cedente_dv;


        $this->codigo_barras = $this->linha;
        $this->linha_digitavel = monta_linha_digitavel($this->linha);
    }
// FUNÇÕES

    function GerarBoleto()
    {
        
    }

    function digitoVerificadorNossonumero($numero)
    {
        $resto2 = modulo_11($numero, 9, 1);
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
        $resto2 = modulo_11($numero, 9, 1);
        if ($resto2 == 0 || $resto2 == 1 || $resto2 == 10) {
            $dv = 1;
        } else {
            $dv = 11 - $resto2;
        }
        return $dv;
    }


    // FUNÇÕES
    // Algumas foram retiradas do Projeto PhpBoleto e modificadas para atender as particularidades de cada banco

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

        $fino = 1;
        $largo = 3;
        $altura = 50;

        $barcodes[0] = "00110";
        $barcodes[1] = "10001";
        $barcodes[2] = "01001";
        $barcodes[3] = "11000";
        $barcodes[4] = "00101";
        $barcodes[5] = "10100";
        $barcodes[6] = "01100";
        $barcodes[7] = "00011";
        $barcodes[8] = "10010";
        $barcodes[9] = "01010";
        for ($f1 = 9; $f1 >= 0; $f1--) {
            for ($f2 = 9; $f2 >= 0; $f2--) {
                $f = ($f1 * 10) + $f2;
                $texto = "";
                for ($i = 1; $i < 6; $i++) {
                    $texto .=  substr($barcodes[$f1], ($i - 1), 1) . substr($barcodes[$f2], ($i - 1), 1);
                }
                $barcodes[$f] = $texto;
            }
        }


    //Desenho da barra


    //Guarda inicial
        ?>
        <img src=imagens/p.png width=<?php echo $fino ?> height=<?php echo $altura ?> border=0><img src=imagens/b.png width=<?php echo $fino ?> height=<?php echo $altura ?> border=0><img src=imagens/p.png width=<?php echo $fino ?> height=<?php echo $altura ?> border=0><img src=imagens/b.png width=<?php echo $fino ?> height=<?php echo $altura ?> border=0><img <?php
        $texto = $valor;
        if ((strlen($texto) % 2) <> 0) {
            $texto = "0" . $texto;
        }

        // Draw dos dados
        while (strlen($texto) > 0) {
            $i = round(esquerda($texto, 2));
            $texto = direita($texto, strlen($texto) - 2);
            $f = $barcodes[$i];
            for ($i = 1; $i < 11; $i += 2) {
                if (substr($f, ($i - 1), 1) == "0") {
                    $f1 = $fino;
                } else {
                    $f1 = $largo;
                }
                ?> src=imagens/p.png width=<?php echo $f1 ?> height=<?php echo $altura ?> border=0><img <?php
if (substr($f, $i, 1) == "0") {
    $f2 = $fino;
} else {
    $f2 = $largo;
}
?> src=imagens/b.png width=<?php echo $f2 ?> height=<?php echo $altura ?> border=0><img <?php
            }
        }

        // Draw guarda final
        ?> 
        src=imagens/p.png width=<?php echo $largo ?> height=<?php echo $altura ?> border=0><img src=imagens/b.png width=<?php echo $fino ?> height=<?php echo $altura ?> border=0><img src=imagens/p.png width=<?php echo 1 ?> height=<?php echo $altura ?> border=0>
        <?php
    } //Fim da função
}




// NÃO ALTERAR!

include("include/layout_cef.php");
