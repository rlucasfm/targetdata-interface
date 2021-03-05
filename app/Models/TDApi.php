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
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjJlMTI4MzA0Y2NjNDdlYTRkZjZkNWU2ZmE4ZjNmMzcwYmM0ZDdlZmVmMTc5YWRkODVlYzdlOGQ0YmViZTgwYzBkZjUzY2E0ZGU4NjJkNzdhIn0.eyJhdWQiOiIyIiwianRpIjoiMmUxMjgzMDRjY2M0N2VhNGRmNmQ1ZTZmYThmM2YzNzBiYzRkN2VmZWYxNzlhZGQ4NWVjN2U4ZDRiZWJlODBjMGRmNTNjYTRkZTg2MmQ3N2EiLCJpYXQiOjE2MTQ5NjY3ODMsIm5iZiI6MTYxNDk2Njc4MywiZXhwIjoxOTMwNDk5NTgzLCJzdWIiOiI0NzE4Iiwic2NvcGVzIjpbXX0.GVaESSrA9B-h-vdMqgZ72zkT0sJAI0WifXC9MA3_3iIPtTPW80GLOmZiUPptfQlJZnn7V8U4yWVhRQDT0pLXEX9R-Q6nNCpSCZTGTZ4ddNuMyI7436IAy3ds9bo-m5YPpQFi6Ydf0CUX2uoQ8hu--g1nYRr5f6NFNe1k7KC7la4k1Pw1Tf6icAUmixv2AcXelRD0ehFGJPRXy4mam_HqRiaCRuIHD5b8y9PL7dQxlT_ncAA6sZzR4P5xasPBbrFEvpd7-c-2EPb6EEdQb3zt23S7-ljHL8PDySMgphF6CrJc5yf2Oo9sAcii5_1r-4aY7graMB95PFW8WHdYJ1hh_HUo_LCSFQLRWS_vsz6UlecP1Bd50MvPB2HXfZO8c8oK8CdS-76LxFgqyj3plDzWplEo5rmuKlUKrqB7aWI9lOHv41jJtvW36harsQ41zTFoDJMwbhe8AM7emoW4acrVw7cpNJMrJ415D3lYc4-FSZKlB7KZ-QXQetWlMCt-kFY4SyJI81HYNHfj46r1iS9gYMWLrYKaDsJFObI_4eL4glCxj22LoqFLGn1zwKiIidtcVHh1icliWiOcd1lBrF2w0s46xbyatCheDyMmUvcmb3VDx85cXKvQNmw5vy_N6GsWJSCBbsMvh7llOXG-Ic93OWXqVDFc8OBc3MevKsZgfTw';

        
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