<?php

namespace App\WebCrawler;

use App\User;
//use GuzzleHttp\Client;
use Goutte\Client;
//use GuzzleHttp\Client as GuzzleClient;

class SearchVehicle{
    
    public function __construct()
    {
    }
    public static function findBrands()
    {
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://www.seminovosbh.com.br/',
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        //Extraindo informação para receber as marcas dos carros disponíves no site
        $first_explode = explode('<label for="marca">Marca</label>', $resp)[1];
        $second_explode = explode('<select name="marca" id="marca" title="Marca">', $first_explode)[1];
        $third_explode = explode('<div class="', $second_explode)[0];
        $fourth_explode = explode('<option value="">Escolha uma marca</option>', $third_explode)[1];
        $fifty_explode = explode('<option value="', $fourth_explode);
        unset($fifty_explode[0]);
        $count_of_brands = count($fifty_explode);
        unset($fifty_explode[$count_of_brands]);
        $all_brands = [];
        foreach ($fifty_explode as $key => $value) {
            $brand_aux = trim(explode('">', $value)[1]);
            if (strlen($brand_aux) >= 2 && !empty($brand_aux)) {
                //$aux = explode('">', $value)[1];
                //$brands[$key] = explode('</option>', $aux)[0];
                $aux = explode('">', $value);
                $aux_1 = explode('</option>', $aux[1])[0];
                $brand = [
                    'id' => $aux[0],
                    'brand' => $aux_1
                ];
                array_push($all_brands, $brand);
            }
        }
        return $all_brands;
    }
    public static function findModels($model, $id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "https://www.seminovosbh.com.br/json/modelos/buscamodelo/marca/$id/data.js?v3.47.1-lf",
        ));
        // execute!
        $resp = curl_exec($curl);
        // close the connection, release resources used
        curl_close($curl);
        $models = json_decode($resp, 1);
        if(!empty($models)){
            foreach($models as $key){
                if($key['modelo'] == ucfirst(strtolower($model))){
                    $result_model = $key['idModelo'];
                }
            }
            return $result_model;
        }
    }
    public function searchVehicle($result_model, $brand)
    {
        print_r($result_model);
        exit;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "https://www.seminovosbh.com.br/resultadobusca/index/veiculo/carro/marca/$brand/modelo/$result_model/usuario/todos",
        ));
        // execute!
        $resp = curl_exec($curl);
        // close the connection, release resources used
        curl_close($curl);
        print_r($resp);
        exit;
        //https://www.seminovosbh.com.br/resultadobusca/index/veiculo/carro/marca/BMW/modelo/1301/usuario/todos
    }
}


class ConsultaSeminovos
{
    
}