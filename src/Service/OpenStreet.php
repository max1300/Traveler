<?php
namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class OpenStreet{

    function createConn($ville)
    {

        $client = HttpClient::create(['http_version' => '2.0']);
        $reponse = $client->request('GET', 'https://nominatim.openstreetmap.org/search/?format=json&limit=1&q=' . $ville);

        if($reponse->getStatusCode() == 200){
            $content = $reponse->toArray();
            return $content;
        } else {
            throw new Exception('Bad connection my friend !!');
        }
    }
    
}