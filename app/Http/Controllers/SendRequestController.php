<?php

namespace App\Http\Controllers;

use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SendRequestController extends Controller
{
    public function index(Request $request){

        $privateKeyContent = <<<EOD
        -----BEGIN PRIVATE KEY-----
        MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCzXfZwMvs5KEXI
        Z5tXl2P8zVicKKqtZbXH40LRKb2Y+SObOTc/sb6dm+cK7+DlC/QzQf7buMTdHrHu
        DsG6eWd/MAb4uapR8aaKesk2w+Xa/nb95hJn3qNNjyG+OSoInSuHUIo5RYzJZfOq
        27QreISQF4BpwyMuf2m9lI91QBejo369ECgouLz6pd9LRRXQU7nQXtXB7JjIT03J
        6dvbtI4g3Q0SqRVx/LgvpzOIuE4yLCpoOZj5EOxVNVUOp/1CfV6ib787Nb2J3a7x
        Sk24TBAvqO7TAjzM0jwFTlLlNUhU2M6VaDLBAo0juV29N099P+rczDL+b4dv8Cyl
        uCUZnPV3AgMBAAECggEAKrWD+aFaCnkZbKem6ItmxopKwBw6z8D5MNhfT5ilyagB
        H3PXQPZc0gCOWh9WKJPZGN9tBPqQ/anSakHfRTylNTbFYjIraQmmQzELelvY/nU6
        9ifzWAI+Vjhvq3DHHnf2Jmk6EHsME+SPya44z2UKA5lk/Un2tZqnHfoi0qNpPZBJ
        MtWyNKW1YYHGzLXmTGHz2gEXkE+jC8laYMIL6+IZQaHHZHO0AGeOuehcjFUaZdgc
        mgD2twcRgP/UQc7yCi88/tHDELse/Snh7k32XvtqQhYym6Uq6EIX7633a0ZviVM2
        /R81DYmWEAQltP3VDQpvgUEBzwSq16MerrHAlSP8MQKBgQDpKU/GgAq45hb6GG08
        f9NzupU8nq/3wC2ptMlGVggErHiguiRhimCFBkZjJAeK27R7tLhRwMiWQa2+kOIG
        iZ3T3kehXzZL0OgOwfzMZIUTxrRj+Q70GQFya/TdlkRwljmnRC4x/VZG0CY39pZG
        jtQYLTwGi8mfS8jp0RrvLrwnvwKBgQDE77g6P5ttuZcCwJ6+MT7UlGLDKR94s4pq
        vsfjM3OolFDaBptNKJCVPU8ObPbds5LsfzaGdhVwcCFhaSHqkF1djZkAVrRDxHYk
        E/DjTH86AKUQr5inWi28KsPTneJPnq9sFN6PBCq7IvadmIF4kcYwbdYba0ZAZSaM
        5vKgfHJgSQKBgDRPF12yNjWbMUZ0mnU7PEY3cunBtDrB+7yaGZnVDUF3LCzq9eSI
        NfVCHiJ539NQTSJ/veZheN705zTcrkjHMQhqUumqQbUqrhU5giyc1JpGNwxCwQ8U
        WRXBkJLx9nLH0TFsg2ylqGiEpD5j7PzxaDXwWAoj7Fz3lKCYUBGfC4ljAoGAerqR
        6ur85/KC45o603hJGZ2ntswH6uao2kEuvK6x41saz+TSH9Gp2PeuLuVFK4DfjTby
        OfWZAss+YkBsfIufQ9Aci5N9H8ZtgapTsrNXjkQcmjt0PMb8PYnBJD3+bXQNCqQu
        1p3YK2tsmWYTOZpPEptAlTHTRApFbgX3KoCjntECgYEAxD5ixVphwimXcUgl9SdI
        En0P8jwAD1EevN7Qa0d75IDES3bsIiajGPpJ9WDfwJU6x8IZa2+Qw05auOvbZDYo
        qRNG/aloX3MfkTR2x4CkAq10qXVkhVTKCP+A3jXxnIcDGs1jNLwANic9ETjdCMBx
        lOXuQDDCb43+I09HO2o1Gh8=
        -----END PRIVATE KEY-----
        EOD;

        $validated = $request->validate([
            'url' => 'required|url',
            'body' => 'nullable|array',
        ]);

        try {

            $parsedUrl = parse_url($validated['url']);
            $path = $parsedUrl['path'] ?? '/';

            $timestamp = Carbon::now()->format('Y-m-d\TH:i:sP');
            $hash = hash('sha256', json_encode($validated['body'], JSON_UNESCAPED_SLASHES));

            $data = 'POST:'.$path.':'.$hash.':'.$timestamp;
            $signature = $this->sign($data, $privateKeyContent);

            $response=  Http::timeout(120)->withoutVerifying()->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'X-TIMESTAMP' => $timestamp,
                'X-SIGNATURE' => $signature,
                'CHANNEL-ID' => '95221',
                'X-PARTNER-ID' => '123456',
                'X-EXTERNAL-ID' => Carbon::now()->timestamp * 1000,
            ])->post($validated['url'], $validated['body']);

            return response()->json(
                $response->json() ?? json_decode($response->body(), true)
            );
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function sign($data, $privateKey) {
	$signature = '';
	openssl_sign($data, $signature, $privateKey, OPENSSL_ALGO_SHA256);

	return base64_encode($signature);
}



}
