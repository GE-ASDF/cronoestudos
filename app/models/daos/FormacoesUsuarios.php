<?php
namespace app\models\daos;

use app\models\CursosFormacoes;
use app\models\FindBy;
use app\models\FindAll;
use app\models\tables\Formacoes;
use app\models\FormacoesPorUsuarios;
use app\models\tables\Cursos;

class FormacoesUsuarios{
    
    public function usuariosPorFormacao(){
        $objFormacoes = new Formacoes;
        $objUsuariosFormacoes = new FormacoesPorUsuarios;
        $objCursosFormacoes = new CursosFormacoes;
        $formacoes = $objFormacoes->execute(new FindAll());
        $formacoesMatriculado = [];
        foreach($formacoes as $key => $formacao){
            $matriculado = $objUsuariosFormacoes->formacoesPorUsuarios($formacao->idformacao, IDUSUARIO);
            if($matriculado){
                $idformacao = $formacao->idformacao;
                $curso = $objCursosFormacoes->cursosFormacoes($formacao->idformacao);
                $nomeFormacao = $formacao->nome;
                $data = $matriculado[0]->data_cadastro;                
            }else{
                $curso = '';
                $idformacao = '';
                $nomeFormacao = '';
                $data = '00/00/0000';
            }
            $formacoesMatriculado[] = [
                "idformacao"=>$idformacao,
                "formacao" => $nomeFormacao,
                "curso" => $curso,
                "data"=> $data
            ];
           
        }
        
        return $formacoesMatriculado;
       
    }

}