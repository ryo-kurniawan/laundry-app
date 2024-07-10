<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    $client = new \GuzzleHttp\Client();
    $url = 'http://127.0.0.1:5001/user/getAllUsers';


    try {
        $response = $client->get($url);
        $statusCode = $response->getStatusCode();

        if ($statusCode == 200) {
            $responseBody = json_decode($response->getBody()->getContents(), true);

            if ($responseBody['sukses']) {
                $pelanggan = $responseBody['data'];

                // Filter pelanggan dengan role = 1
                $pelangganRole1 = array_filter($pelanggan, function($pelanggan) {
                    return $pelanggan['role'] == 1;
                });

                // Menghitung jumlah pelanggan dengan role = 1
                $jumlahPelangganRole1 = count($pelangganRole1);


            } else {
                return view('pages.home.index')->with('error', 'Failed to fetch data: ' . $responseBody['msg']);
            }
        } else {
            return view('pages.home.index')->with('error', 'Failed to fetch data: Status code ' . $statusCode);
        }
    } catch (\Exception $e) {
        return view('pages.home.index')->with('error', 'Failed to fetch data: ' . $e->getMessage());
    }

    return view('pages.home.index', [
        'jumlahPelanggan' => $jumlahPelangganRole1,
    ]);
}

}
