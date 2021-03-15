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
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjMwMzNlOTY3YTdkZDMyMDhkMWMyYTNmZTdlNGMyNzM4MzAzMGUxZWNlNGY3NjgzNzMzMDE5NDM4YTZjMzllMzQ4M2NjYWI5YWNiOGZmZWYzIn0.eyJhdWQiOiIyIiwianRpIjoiMzAzM2U5NjdhN2RkMzIwOGQxYzJhM2ZlN2U0YzI3MzgzMDMwZTFlY2U0Zjc2ODM3MzMwMTk0MzhhNmMzOWUzNDgzY2NhYjlhY2I4ZmZlZjMiLCJpYXQiOjE2MTU4MTg0NzksIm5iZiI6MTYxNTgxODQ3OSwiZXhwIjoxOTMxMzUxMjc5LCJzdWIiOiI0NzE4Iiwic2NvcGVzIjpbXX0.VNlvZj6cpLKD_Y3BGgeKklO1yx91E1t4ngwFppUiLm8hFDtQ4EM_NIcui3ID1GSyGWjb4tKJpcxdmAkA6Y2FZavjcZJn177HqS2kZm_rN8Q6knsE132YdZQioA77JJy3tbkxxPJejAEE6MCmNmO1BCD72jjiIKYCiu-k5OmB7XD8Hg7ychE34LRYFxe7YnT5DazXRaXjDXXcc1w4SyCsgSMCLnbNhgj80X0PmuPCqCKQ0CWXZ_StKuvAkhI0ktg2YTPesW7ARJZVnZq_Djq8Z_z8K_wkRHENtS5CWK2DQHtBpkLYwQ55pAsKB0uARvX9g6pSlyiLIxXxZ3nGbekwpHBl_wpnhr4_pP-a0Iy0y9VHeW6efoHtIJ4R1CG-sLcwEZc1R_Vj_0EdUFZ5psC9zVpS5my6mp4BqLVMbTT81ZrCcvuMseEuVU9YH5l4GS-EBooK9feNtVFZa94R49o46On14DzdvFSDUJFkuXsys4XTSx66hEpmfg-kTtIfgmG09-M0pbcFgWrPmk6sElPkM3DrwtasHdlPLDmcQTuKsmwX8C6alXwXaCh8wvrop5IAsY4kHzSSSzB9cuPOnHFgIM0CSy4ctb5GwVrE2pzr8DDwVsec7Tu009hPQuUq3UMaBNIf0-2nRj0g916owUWaSwrclBhC9h63laTCi1ksXOc';

        
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
        
        if(gettype($response) == 'string')
        {
            return $response;
        } else {
            return $response->getBody();
        }
    }

    /**
     * 
     * @method void
     * 
     * Realiza a busca por CNPJ na API TargetData Smart
     */
    public function localizarCNPJ($cnpj)
    {
        $client = new \CodeIgniter\HTTP\CURLRequest(
            new \Config\App(),
            new \CodeIgniter\HTTP\URI(),
            new \CodeIgniter\HTTP\Response(new \Config\App())
        );

        // Token de autorização, pode ser modificado se necessário.
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjYwMDU2MTdmY2FmYjE1NTk5MDMzZjlmZDNhMzI2MTc3NTEwOTJiZTcwZDU4NjI0NDVjZjI0ZDUyZjg5YTU2ZjE5NmQxMmRkNjFkZmM4YzU3In0.eyJhdWQiOiIyIiwianRpIjoiNjAwNTYxN2ZjYWZiMTU1OTkwMzNmOWZkM2EzMjYxNzc1MTA5MmJlNzBkNTg2MjQ0NWNmMjRkNTJmODlhNTZmMTk2ZDEyZGQ2MWRmYzhjNTciLCJpYXQiOjE2MTIzODI2NzMsIm5iZiI6MTYxMjM4MjY3MywiZXhwIjoxOTI3OTE1NDczLCJzdWIiOiI0MTM0Iiwic2NvcGVzIjpbXX0.mcUnyXYZCgpp46XrSaQb9BKNmrAEUeSq_-RsLtfHZFnZ-be0zwoKpMUUUY1vyazhAPcXYnwhK9idMAzT8IpkCadeFI7tVgLjJkLy6nIjicfGNmQgYZs-0PcQHq_1M8pzfWzz9atrD8Hz3HXiHMXCIM-Itewak7mAcRWgE-w94FJ7GcRSxZNWjKdXpLCDoLcPSlhpTEGBdQNGw7bJyMQ7_qEEc6txxvkgdC9yqmZAAY6VdL6FeGiqwT14DV8v_cZDziaSUqcfQLQJSnVFc0NGltphObBTDUg5J6PtDvHpSWQ6UWWY83LqMqFLXvOxPSlqmTemQ1_asDU6H5kmEUmv0VI8KlXOvBkSZqeXE-v9VFaibGEGdl_wi-dCpoFzhHnP8_vJD52OHIAnfl_PWT749k55LF65jsaqfM1YMhVHP_1VEiQuA0hFhkOCQt39jRv-HqDBG6ASl3sEwsO7BHwy03qFkv7EaYm3wmA5e5Mlw1fFhinGZbzfjkyAjxTgtFosJwMxUH17tcfuLp0kCmMAAFNydsbYGCm3ELRN4iSmTWw0pf9kB2NW1bJuPo_Jh8N3mvBB3fVuvUhCcAw3I70VFTxVLKFWrtZ6U5kw8hyCq0laQmpYjFJb-zeDqUkDT9E4rEdFvVihWM9uxFtdCVUB03wgt0ZzgOBkfSkGnVc44Jg';

        
        $body = '["'.$cnpj.'"]';
        $headers = [
            'Authorization' => 'Bearer '.$token,
            'Content-type' => 'application/json',
            'Accept' => 'application/json'
        ];

        // Realiza a requisição para a API
        try {
            $response = $client->setBody($body)->request('post', 'https://targetdatasmart.com/api/PJ/CNPJ', ['headers' => $headers, 'verify' => false]);
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