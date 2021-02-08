<?php namespace App\Models;

use CodeIgniter\Model;

class TDApi extends Model
{

    /**
     * 
     * @method void
     * 
     * Realiza a busca por CPF na API TargetData Smart
     */
    public function localizarCPF($cpf)
    {
        $client = new \CodeIgniter\HTTP\CURLRequest(
            new \Config\App(),
            new \CodeIgniter\HTTP\URI(),
            new \CodeIgniter\HTTP\Response(new \Config\App())
        );

        // Token de autorização, pode ser modificado se necessário.
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjYwMDU2MTdmY2FmYjE1NTk5MDMzZjlmZDNhMzI2MTc3NTEwOTJiZTcwZDU4NjI0NDVjZjI0ZDUyZjg5YTU2ZjE5NmQxMmRkNjFkZmM4YzU3In0.eyJhdWQiOiIyIiwianRpIjoiNjAwNTYxN2ZjYWZiMTU1OTkwMzNmOWZkM2EzMjYxNzc1MTA5MmJlNzBkNTg2MjQ0NWNmMjRkNTJmODlhNTZmMTk2ZDEyZGQ2MWRmYzhjNTciLCJpYXQiOjE2MTIzODI2NzMsIm5iZiI6MTYxMjM4MjY3MywiZXhwIjoxOTI3OTE1NDczLCJzdWIiOiI0MTM0Iiwic2NvcGVzIjpbXX0.mcUnyXYZCgpp46XrSaQb9BKNmrAEUeSq_-RsLtfHZFnZ-be0zwoKpMUUUY1vyazhAPcXYnwhK9idMAzT8IpkCadeFI7tVgLjJkLy6nIjicfGNmQgYZs-0PcQHq_1M8pzfWzz9atrD8Hz3HXiHMXCIM-Itewak7mAcRWgE-w94FJ7GcRSxZNWjKdXpLCDoLcPSlhpTEGBdQNGw7bJyMQ7_qEEc6txxvkgdC9yqmZAAY6VdL6FeGiqwT14DV8v_cZDziaSUqcfQLQJSnVFc0NGltphObBTDUg5J6PtDvHpSWQ6UWWY83LqMqFLXvOxPSlqmTemQ1_asDU6H5kmEUmv0VI8KlXOvBkSZqeXE-v9VFaibGEGdl_wi-dCpoFzhHnP8_vJD52OHIAnfl_PWT749k55LF65jsaqfM1YMhVHP_1VEiQuA0hFhkOCQt39jRv-HqDBG6ASl3sEwsO7BHwy03qFkv7EaYm3wmA5e5Mlw1fFhinGZbzfjkyAjxTgtFosJwMxUH17tcfuLp0kCmMAAFNydsbYGCm3ELRN4iSmTWw0pf9kB2NW1bJuPo_Jh8N3mvBB3fVuvUhCcAw3I70VFTxVLKFWrtZ6U5kw8hyCq0laQmpYjFJb-zeDqUkDT9E4rEdFvVihWM9uxFtdCVUB03wgt0ZzgOBkfSkGnVc44Jg';

        
        $body = '["'.$cpf.'"]';
        $headers = [
            'Authorization' => 'Bearer '.$token,
            'Content-type' => 'application/json',
            'Accept' => 'application/json'
        ];

        // Realiza a requisição para a API
        try {
            $response = $client->setBody($body)->request('post', 'https://targetdatasmart.com/api/PF/CPF', ['headers' => $headers, 'verify' => false]);
        } catch (\Exception $err) {
            $response = $err->getMessage();
        }        
        
        return $response->getBody();    
    }

    /**
     * 
     * @method void
     * 
     * Realiza a autenticação na API, com as informações cadastrais e recupera o token bearer
     */
    private function get_auth()
    {
        $client = \Config\Services::curlrequest();

        $auth_body = [
            'grant_type'        => 'password',
            'client_id'         => '2',
            'client_secret'     => 'j3vEKMI37i75gFC7LabWIfgJiUmZBj1H7gRCI0En',
            'username'          => 'backoffice',
            'password'          => 'FiGadRdQ4b',
            'empresa'           => '1465'
        ];

       return $client->request('post', 'https://targetdatasmart.com/api/token', ['form_params' => $auth_body, 'verify' => false, 'headers' => ['Content-type' => 'multipart/form-data']]);       
    }
}