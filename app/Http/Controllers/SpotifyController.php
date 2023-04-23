<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spotify;
use GuzzleHttp\Client;

class SpotifyController extends Controller
{
    private $clientId;
    private $clientSecret;
    private $redirectUri = 'http://deposito.test/profile_spotify/';

    public function __construct(){
        $this->clientId = '94e4209c9f45474eb3c656673505d6e1';
        $this->clientSecret = '6863b8326f1e4addbec96a6b49abacc5';   
    }

    public function login()
    {
        $scopes = 'user-read-private user-read-email';
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
        $code = $_GET['code'];
       
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret)            
            ])->asForm()
            ->post('https://accounts.spotify.com/api/token', [
            'code' => trim($code),
            'redirect_uri' => $this->redirectUri,
            'grant_type' => 'authorization_code',
        ]);

        $jumper_c = json_decode($response->getBody(),true);

        $client = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret)            
            ])->asForm()
            ->post('https://api.spotify.com/v1/albums', [
            'id' => '4aawyAB9vmqN3uQ7FjRGTy'
        ]);


        dd(json_decode($client->getBody(),true));

     

        //$cate=Spotify::categories()->get();

        //dd($cate);
        
        
        return $jumper_c['access_token'];

    }

    public function getUser() {
        $token = $this->getToken();

        $profile = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token])
            ->get('https://api.spotify.com/v1/me');
        
        return view('profile_spotify')->with(['profile' => $profile->json()]); 
    }

}
