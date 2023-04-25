<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spotify;
use GuzzleHttp\Client;
use SpotifyWebAPI\SpotifyWebAPI;

class SpotifyController extends Controller
{
    private $clientId;
    private $clientSecret;
    private $code;
    private $token;
    private $redirectUri = 'http://deposito.test/profile_spotify/';

    public function __construct(){
        $this->clientId = '94e4209c9f45474eb3c656673505d6e1';
        $this->clientSecret = '6863b8326f1e4addbec96a6b49abacc5';   

        
    }

    public function login()
    {
        $scopes = 'user-read-private user-read-email';
        $scopes = 'user-read-playback-state';
        $scopes = 'user-read-currently-playing';
        $scopes = 'user-read-playback-state';

        return redirect(
            'https://accounts.spotify.com/authorize' .
                            '?response_type=code' .
                            '&client_id=' . $this->clientId .
                            ($scopes ? '&scope=' . urlencode($scopes) : '') .
                            '&redirect_uri=' . urlencode($this->redirectUri)
        );
    }

    public function getToken()
    {
        $this->code = $_GET['code'];
       
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret)            
            ])->asForm()
            ->post('https://accounts.spotify.com/api/token', [
            'code' => trim($this->code),
            'redirect_uri' => $this->redirectUri,
            'grant_type' => 'authorization_code',
        ]);

        $jumper_c = json_decode($response->getBody(),true);

       
        return $jumper_c['access_token'];

    }

    public function getUser() {
        $this->token = $this->getToken();

        $profile = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token])
            ->get('https://api.spotify.com/v1/me');


       // dd(SpotifyWebAPI::next());

            

        $reproduce = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->token])
                ->get('https://api.spotify.com/v1/me/player/play',[
                    'ID' => '23fd3e7bcdbd442510274fa5956e772051374a0d',
                   //'market' => 'US',
                ]);
        $dispositivos = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $this->token])
                    ->get('https://api.spotify.com/v1/me/player/devices',[
                       // 'ID' => '147ef03b1e9a4736f63276f344c5b757f5f3e68d',
                       //'market' => 'US',
                    ]);

        $pista_reproduciendo = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token])
            ->get('https://api.spotify.com/v1/me/player/currently-playing',[
               // 'ID' => '147ef03b1e9a4736f63276f344c5b757f5f3e68d',
               'market' => 'US',
            ]);


                /*->get('https://api.spotify.com/v1/artists/0EmeFodog0BfCgMzAIvKQp/top-tracks',[
                    'country' => 'US',
                ]);*/

                //dd(json_decode($pista_reproduciendo->getBody(),true));
        
        return view('profile_spotify')->with(['profile' => $pista_reproduciendo->json()]); 
    }

    public function getMusic() {


        $profile = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token])
            ->post('https://api.spotify.com/v1/me/player/play', [
                'id' => '0d1841b0976bae2a3a310dd74c0f3df354899bc8'
            ]);

        dd(json_decode($profile->getBody(),true));
        
        return view('vendor.adminlte.partials.footer.footer')->with(['profile' => $profile->json()]); 
    }

}
