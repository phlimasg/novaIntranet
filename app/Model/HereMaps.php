<?php

namespace App\Model;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class HereMaps extends Model
{
    public $lat, $lng, $transportMode = "car", $return = "summary", $geo,$duration,$distance,$baseDuration;
    private $at = "-22.91216,-43.17501";    
    private $url = "https://discover.search.hereapi.com/v1/discover?";
    private $url_rota = "https://router.hereapi.com/v8/routes?";
    
    public function __construct($endereco){
        try {
            //remover os espaços da string
            $end = str_replace(" ","%20",$endereco);
            $client = new Client();
            $res = $client->request('GET', $this->url, [
                'query' => [
                    'at'=>$this->at,
                    'apiKey' =>  env('HERE_API_KEY'),
                    'q' => $end
                ],                
            ]);  
            $body = json_decode($res->getBody(0)->read(1024),true)['items'][0];
            $this->lat = $body["access"][0]["lat"];
            $this->lng = $body["access"][0]["lng"];
            $this->geo = "{$this->lat},{$this->lng}";
            //$this->distance = $body["distance"];
            //dd($body);
            return $this;
            //code...
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function getTimeRoute($origin, $destination)
    {
        try {
            $client = new Client();
            $res = $client->request('GET', $this->url_rota, [
                'query' => [
                    'transportMode'=>$this->transportMode,
                    'apiKey' =>  env('HERE_API_KEY'),
                    'return' => $this->return,
                    'origin' => $origin,
                    'destination' => $destination
                ],                
            ]);  
            $body = json_decode($res->getBody(0)->read(1024),true)['routes'][0]['sections'][0]["summary"];
            $this->duration = $body["duration"];
            $this->distance = $body["length"];
            $this->baseDuration = $body["baseDuration"];
            //$this->lng = $body["access"][0]["lng"];
            //$this->distance = $body["distance"];
            //dd($body);
            return $this;
            //code...
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
    }
}
