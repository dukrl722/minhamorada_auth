<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddressController extends Controller
{

    /**
     * @author Eduardo da Silva
     * @since 06/12/2022
     * @param Request $request
     * @return Response
     *
     * Retornar os dados do CEP pesquisado
     */
    public function dataCEP(Request $request)
    {

        try {

            $request->validate([
                'cep' => 'required|max:8|min:8'
            ]);

            $cep = $request->cep;

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://viacep.com.br/ws/' . $cep . '/json',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'GET'
            ]);

            $response = curl_exec($curl);

            curl_close($curl);

            if (!$response) {
                return response()->json([
                    'message' => 'Erro ao buscar o CEP. Tente novamente mais tarde.'
                ], 500);
            }

            $address = json_decode($response, true);

            return response()->json([
                'cep' => $address['cep'],
                'street' => $address['logradouro'],
                'district' => $address['bairro'],
                'city' => $address['localidade'],
                'state' => $address['uf']
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }

}
