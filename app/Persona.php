<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Persona extends Model
{
    public function save(array $options = [])
    {
        $api_key = "AIzaSyCTvT-0R3XOcphma8hBgFtb-1UA3ICKZMA";
        $direccion_e = urlencode("Bogota, Colombia ".$this->direccion);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$direccion_e."&key=".$api_key;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        $this->geocoding = $response ;
        parent::save();
    }
}
