<?php
//Cargar composer
require 'vendor/autoload.php';

//Funcion principal que nos genera la url que necesitamos
//Pasar como parametros el tipo de configuracion que queremos utilizar de nuestro json y la url de la imagen a modificar.
function thumb_url($selected_type, $image)
{
    //Guardamos nuestro archivo Json con toda la configuracion en la variable $config_json
    $config_raw_json = file_get_contents("conf.json");

    //Transformamos a $config_json en un array PHP
    //json_decode-> Decodifica el String del archivo Json en un Array con el que PHP puede trabajar.
    $config_decoded_array = json_decode($config_raw_json, TRUE);

    //Server configuration
    $server = $config_decoded_array['server'];
    $secret = $config_decoded_array['secret'];

    //Iteramos por la primera dimension del array $config_decoded_array buscando una configuracion que coincida con $selected_type.
    foreach ($config_decoded_array as $key => $val) {

        if ((string)$key == $selected_type) {
            //Encontramos la configuracion coincidente y creamos un objeto Thumbor con la direccion de nuestro servidor, clave secreta e imagen que queremos tratar.
            $thumbor_instance = Thumbor\Url\Builder::construct($server, $secret, $image);

            //Iteramos por la configuracion elegida de nuestro array ejecutando los comandos de la libreria dando forma con cada iteracion a los atributos del objeto Thumbor.
            foreach ($config_decoded_array[$selected_type] as $key => $val) {

                execute_commands($thumbor_instance, $key, $config_decoded_array[$selected_type]);
            }

            //Una vez hemos terminado de moldear nuestro objeto Thumbor utilizamos su metodo "build()" para que nos genera la url deseada.
            echo $thumbor_instance->build();
        }
    }
}

//Funcion para acceder a los atributos de nuestro array y pasarlos como parametros de los metdodos de moldeado del objeto thumbor que vienen por defecto.
function execute_commands($thumbor, $string, $array)
{

    switch ($string) {
        case "smartCrop":
            $thumbor->smartCrop($array[$string]);
            break;
        case "trim":
            $thumbor->trim($array[$string]['colorSource'], $array[$string]['tolerance']);
            break;
        case "crop":
            $thumbor->crop($array[$string]['topLeftX'], $array[$string]['topLeftY'], $array[$string]['bottomRightX'], $array[$string]['bottomRightY']);
            break;
        case "fullFitIn":
            $thumbor->fullFitIn($array[$string]['width'], $array[$string]['height']);
            break;
        case "fitIn":
            $thumbor->fitIn($array[$string]['width'], $array[$string]['height']);
            break;
        case "resize":
            $thumbor->resize($array[$string]['width'], $array[$string]['height']);
            break;
        case "halign":
            $thumbor->halign($array[$string]);
            break;
        case "valign":
            $thumbor->valign($array[$string]);
            break;
        case "filters":
            foreach ($array[$string] as $filter) {
                $thumbor->addFilter($filter['name'], $filter['value']);
            }
            break;
    }
}



