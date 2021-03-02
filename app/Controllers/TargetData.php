<?php

namespace App\Controllers;
use App\Models\TDApi;

class TargetData extends BaseController
{
	public function index()
	{
        
    }

    /**
     * 
     * @method view    
     * Responsável por controlar as requisições de informações de CPF
     */
    public function cpf($cpf)
    {
        $api = new TDApi();

        $data = [
            'title' => 'Busca por CPF'
        ];
        // Recupera o JSON e o Objeto do resultado
		$response_raw = $api->localizarCPF($cpf);
        try {
            $response = json_decode($response_raw)->result[0]; 
            
            // Informações cruas
            $data['raw'] = utf8_decode($response_raw);

            // Dados Cadastrais
            $data['cadastro'] = $response->pessoa->cadastral;

            // Contatos
            $data['contato'] = $response->pessoa->contato;

            echo view('buscacpf', $data); 

        } catch (\Exception $err) {

            echo view('production_err', ['errorcode' => $err->getCode(), 'error' => $err->getMessage()]);
            
        }                         
    }

    /**
     * 
     * @method view    
     * Responsável por controlar as requisições de informações de CNPJ
     */
    public function cnpj($cnpj)
    {
        $api = new TDApi();

        $data = [
            'title' => 'Busca por CNPJ'
        ];
        // Recupera o JSON e o Objeto do resultado
		$response_raw = $api->localizarCNPJ($cnpj);
        try {
            $response = json_decode($response_raw)->result[0]; 
            
            // Informações cruas
            $data['raw'] = utf8_decode($response_raw);

            // Dados Cadastrais
            $data['cadastro'] = $response->empresa->cadastral;

            // Contatos
            $data['contato'] = $response->empresa->contato;

            echo view('buscacpf', $data); 

        } catch (\Exception $err) {

            echo view('production_err', ['errorcode' => $err->getCode(), 'error' => $err->getMessage()]);
            
        }   
    }
}
