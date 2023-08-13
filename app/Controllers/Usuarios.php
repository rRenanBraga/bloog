<?php

class Usuarios extends Controller
{
    public function cadastrar()
    {

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $pattern_email = '/^[a-zA-z0-9,+]+@[a-zA-z0-9,]+\.[a-zA-Z]{2,}$/';
        $pattern_nome = '/^[a-zA-Z\s\-\'\.]+$/';
        if(isset($formulario) && preg_match($pattern_email, $formulario['email']) && preg_match($pattern_nome, $formulario['username'])):
            $dados=[
                'nome' => trim($formulario['nome']),
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                'confirma_senha' => trim($formulario['confirma_senha']),
            ]
            if (in_array("", $formulario)) :

                if (empty($formulario['nome'])) :
                    $dados['nome_erro'] = 'Preencha o campo nome';
                endif;

                if (empty($formulario['email'])) :
                    $dados['email_erro'] = 'Preencha o campo e-mail';
                endif;

                if (empty($formulario['senha'])) :
                    $dados['senha_erro'] = 'Preencha o campo senha';
                endif;

                if (empty($formulario['confirma_senha'])) :
                    $dados['confirma_senha_erro'] = 'Confirme a Senha';
                endif;
            else :
                if (strlen($formulario['senha']) < 6) :
                    $dados['senha_erro'] = 'A senha deve ter no minimo 6 caracteres';
                elseif ($formulario['senha'] != $formulario['confirma_senha']) :
                    $dados['confirma_senha_erro'] = 'As senhas são diferentes';
                else :
                   echo 'Cadastro realizado com sucesso<hr>';
                endif;

            endif;
            var_dump($formulario);
        else :
            $dados = [
                'nome' => '',
                'email' => '',
                'senha' => '',
                'confirma_senha' => '',
            ];

        endif;


        $this->view('usuarios/cadastrar', $dados);
    }
}
