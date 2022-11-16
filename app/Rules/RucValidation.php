<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use GuzzleHttp\Client;

class RucValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function validar_ruc($number)
    {
        $token = 'apis-token-3219.52HOuOTZSpEKuapyyUsosEA21up9REF-';

        $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);

        $parameters = [
            'http_errors' => false,
            'connect_timeout' => 5,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Referer' => 'https://apis.net.pe/api-consulta-ruc',
                'User-Agent' => 'laravel/guzzle',
                'Accept' => 'application/json',
            ],
            'query' => ['numero' => $number]
        ];
        $res = $client->request('GET', '/v1/ruc', $parameters);
        $response = json_decode($res->getBody()->getContents(), true);


        if (count($response) > 2) {
            if ($response["numeroDocumento"] == $number) {
                return true;
            } else if ($response["error"] == 'RUC invalido' or $response["error"] == 'Descripción del error en el formato de ruc') {
                return false;
            }
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $val = $this->validar_ruc($value);

        if ($val === true) {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El :attribute no es valido';
    }
}
