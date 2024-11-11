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
                self::deleteCounty($id);
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
                break;
            case isset($request['btn-counties']):
                PageCounties::table(self::getCounties());
                break;
            case isset($request['btn-del-county']):
                self::deleteCounty($id);
            break;
            case isset($request['btn-save-county']):
                self::createCounty($id);
            break;
            case isset($request['btn-update-county']):
                self::updateCounty($id, $data);
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
        $client = new Client();
        $response = $client->post('counties', $data);

        return $response;
    }

    private static function updateCounty($id, $data)
    {
        $client = new Client();
        $response = $client->put('counties/' . $id, $data);

        return $response;
    }

    private static function deleteCounty($id)
    {
        $client = new Client();
        $response = $client->delete('counties', $id);

        header("refresh:0");
    }
 
}
 
?>