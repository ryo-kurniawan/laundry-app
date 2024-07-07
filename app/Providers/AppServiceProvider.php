<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $client = new Client();
    $url = 'http://127.0.0.1:5001/transaksi/getAllTransaksi';

    try {
        $response = $client->request('GET', $url);
        $data = json_decode($response->getBody(), true);

        if ($data['status'] == 200) {
            $transaksi = $data['data'];

            // Sort data by tanggal descending
            usort($transaksi, function($a, $b) {
                return strtotime($b['tanggal']) - strtotime($a['tanggal']);
            });

            // Take the first 5 entries
            $transaksi = array_slice($transaksi, 0, 5);

            // Share data to all views
            View::share('transaksis', $transaksi);
        } else {
            View::share('transaksis', []);
        }
    } catch (\Exception $e) {
        View::share('transaksis', []);
    }
    }
}
