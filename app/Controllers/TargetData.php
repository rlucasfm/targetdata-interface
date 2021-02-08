<?php

namespace App\Controllers;
use App\Models\TDApi;

class TargetData extends BaseController
{
	public function index()
	{
        
    }

    public function cpf($cpf)
    {
        $api = new TDApi();

        $data = [
            'title' => 'Busca por CPF'
        ];
        // Recupera o JSON e o Objeto do resultado
		$response_raw = $api->localizarCPF($cpf);
        $response = json_decode($response_raw)->result[0];        
        
        // Informações cruas
        $data['raw'] = utf8_decode($response_raw);

        // Dados Cadastrais
        $data['cadastro'] = $response->pessoa->cadastral;

        // Contatos
        $data['contato'] = $response->pessoa->contato;

        echo view('buscacpf', $data);
    }
}
