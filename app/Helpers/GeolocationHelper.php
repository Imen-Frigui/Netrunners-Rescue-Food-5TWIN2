// app/Helpers/GeolocationHelper.php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class GeolocationHelper
{
    public static function getCoordinates($address)
    {
        $apiKey = env('GOOGLE_MAPS_API_KEY');
        $response = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
            'address' => $address,
            'key' => $apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data['results'][0]['geometry']['location'])) {
                return [
                    'latitude' => $data['results'][0]['geometry']['location']['lat'],
                    'longitude' => $data['results'][0]['geometry']['location']['lng'],
                ];
            }
        }

        return null;
    }
}
