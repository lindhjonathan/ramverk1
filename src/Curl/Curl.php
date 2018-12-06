<?php
namespace Jodn14\Curl;

/**
 * Class for wrapping curl.
 * If time: {        implements CurlInterface       }
 */
class Curl
{
    /**
     * @var string       $weatherKey     API Key for Dark Sky.
     * @var string       $ipstackKey     API Key for ipstack.
     *
     */

    private $weatherKey;
    private $ipstackKey;
    private $mapquestKey;


    /**
     * Set the weather api key.
     *
     * @param string $weatherKey to set the weather key.
     * @param string $ipstackKey to set the ipstack key.
     * @param string $mapquestKey to set the ipstackKey key.
     *
     * @return self
     */
    public function setKeys($weatherKey, $ipstackKey, $mapquestKey)
    {
        $this->weatherKey = $weatherKey;
        $this->ipstackKey = $ipstackKey;
        $this->mapquestKey = $mapquestKey;
    }


    /**
     * Call weather service to get upcoming 7 days
     *
     * @param string $location     "latitude,longitude".
     *
     * @return self
     */
    public function getForecast($lat, $long)
    {
        $data = array();

        $url = 'https://api.darksky.net/forecast/'.$this->weatherKey.'/'.$lat.','.$long.'?units=si&lang=sv&exclude=minutely';
        array_push($data, $url);

        // Call multi-curl function with populated url array
        $res = $this->multi($data);

        // if (in_array(400, $res[0])) {
        //     if ($res[0]["code"] === 400) {
        //         return $res[0];
        //     }
        // }

        $filtered = [
            "currently" => $res[0]["currently"]["summary"] ?? null,
            "temp" => round($res[0]["currently"]["temperature"]) ?? null,
            "feels" => round($res[0]["currently"]["apparentTemperature"]) ?? null,
            "wind" => round($res[0]["currently"]["windSpeed"], 1) ?? null,
            "gust" => round($res[0]["currently"]["windGust"], 1) ?? null,
            "senare" => $res[0]["hourly"]["summary"] ?? null,
            "weekly" => $res[0]["daily"]["summary"] ?? null,
        ];

        return $filtered;
    }



    /**
     * Call weather service to get past 30 days.
     *
     * @param string $location      "latitude,longitude".
     *
     * @return self
     */
    public function getPast($lat, $long)
    {
        // Get current time in unix and add to url in for loop
        $data = array();
        $today = time();

        for ($i = 0; $i < 30; $i++) {
            $url = 'https://api.darksky.net/forecast/'.$this->weatherKey.'/'.$lat.','.$long.','.$today.'?units=si&lang=sv&exclude=minutely';
            array_push($data, $url);
            $today -= 24*60*60;
        }

        // Call multi-curl function with populated url array
        $res = $this->multi($data);

        $filtered = [];
        for ($i = 0; $i < count($res); $i++) {
            $filtered[$i]["summary"] = $res[$i]["currently"]["summary"];
            $filtered[$i]["temperature"] = round($res[$i]["currently"]["temperature"]);
            $filtered[$i]["windSpeed"] = round($res[$i]["currently"]["windSpeed"], 1);
            $filtered[$i]["time"] = date("Y-m-d", $res[$i]["currently"]["time"]);
        };

        return $filtered;
    }



    /**
     * Call weather service to get past 30 days.
     *
     * @param string $location      "latitude,longitude".
     *
     * @return self
     */
    public function multi($data)
    {
        $multiCurl = array();
        $resultSet = array();

        $mhandle = curl_multi_init();

        foreach ($data as $id => $d) {
            // Initiate curl for each id
            $multiCurl[$id] = curl_init();

            // Set options and add handle to url
            curl_setopt($multiCurl[$id], CURLOPT_URL, $d);
            curl_setopt($multiCurl[$id], CURLOPT_HEADER, 0);
            curl_setopt($multiCurl[$id], CURLOPT_RETURNTRANSFER, true);
            curl_multi_add_handle($mhandle, $multiCurl[$id]);
        }

        $running = null;
        do {
            curl_multi_exec($mhandle, $running);
        } while ($running > 0);

        foreach ($multiCurl as $id => $d) {
            $resultSet[$id] = curl_multi_getcontent($d);
            $resultSet[$id] = json_decode($resultSet[$id], true);
            curl_multi_remove_handle($mhandle, $d);
        }
        // $filtered = [
        //     "Summary" => $resultSet[$id]["daily"]["Summary"],
        // ];

        curl_multi_close($mhandle);

        return $resultSet;
    }



    /**
     * Call map API service to get long lat values out of a city name
     *
     * @param string $search     "city name".
     *
     * @return self
     */
    public function getCoordinates($search)
    {

        $url = 'http://open.mapquestapi.com/nominatim/v1/search.php?key='.$this->mapquestKey.'&format=json&q='.$search.'&limit=1';

        $apiCall = curl_init($url);
        curl_setopt($apiCall, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($apiCall);
        curl_close($apiCall);

        $apiResult = json_decode($json, true);

        if (empty($apiResult)) {
            $apiResult = [
                "code" => 400,
                "error" => "Invalid Location, could not find data",
            ];
            return $apiResult;
        }

        return $apiResult[0];
    }
}
