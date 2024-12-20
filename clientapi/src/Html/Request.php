<?php
 
namespace App\Html;
 
use App\RestApiClient\Client;
 
class Request{
 
    static function handle()
    {
        switch($_SERVER["REQUEST_METHOD"]){
            case "POST":
                self::postRequest();
                break;
            case "GET":
                self::getCounties();
                break;
            case "DELETE":
                self::deleteCounty();
                break;
            default:
                self::getCounties();
                break;
        }
    }
 
    private static function postRequest()
    {
        $request = $_REQUEST;
        switch ($request) {
            case isset($request['btn-home']):
                echo 'Ez itt a kezdőlap.';
                break;
            case isset($request['btn-counties']):
                PageCounties::table(self::getCounties());
                break;
            case isset($request['btn-del-county']):
                self::deleteCounty();
            break;
            case isset($request['btn-save-county']):
                $data = ['name' => $_POST['name']];
                //var_dump($_POST);
                self::createCounty($data);
            break;
            case isset($request['btn-update-county']):
                self::editor();
                self::updateCounty( );
            break;
        }
    }
 
    private static function getCounties(): array
    {
        $client = new Client();
        $response = $client->get('counties');
 
        return $response['data'];
    }

    private static function createCounty($data)
    {
    $name = $_POST['name']; 
    
    $client = new Client();
    $response = $client->post('counties', ['name' => $name]);

    if ($response && isset($response['data'])) {
        
        PageCounties::table(self::getCounties());
    }
    }


    private static function updateCounty($id, $data)
    {
        $client = new Client();
        $response = $client->put('counties/' . $id, $data);

        return $response;
    }

    private static function deleteCounty()
    {
        $requestData = $_POST["btn-del-county"];
        $client = new Client();
        $response = $client->delete('counties', $requestData);

        header("refresh:0");
    }
 
}
 
?>