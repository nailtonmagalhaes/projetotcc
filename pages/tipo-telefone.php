<?php
    include_once 'valida-sessao.php';
    class ETipoTelefone{
        const none = 0;
        const residencial = 1;
        const celular = 2;
        const comercial = 3;

        public function getTipos(){
            $tipos = array();
            $tipos[] = ETipoTelefone::residencial;
            $tipos[] = ETipoTelefone::celular;
            $tipos[] = ETipoTelefone::comercial;
            return $tipos;
        }
    }
?>