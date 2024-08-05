<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    $client = new \GuzzleHttp\Client();
    $url = 'http://103.175.220.104/user/getAllUsers';
    $urlTransaksi = 'http://103.175.220.104/transaksi/getAllTransaksi';

    try {
        $response = $client->get($url);
        $responseTransaksi = $client->get($urlTransaksi);
        $statusCodeTransaksi = $responseTransaksi->getStatusCode();
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

    if ($statusCodeTransaksi == 200) {
        $responseBodyTransaksi = json_decode($responseTransaksi->getBody()->getContents(), true);

        if ($responseBodyTransaksi['msg'] == 'Berhasil Mengambil Data') {
            $transaksi = $responseBodyTransaksi['data'];

            $jumlahTransaksi = count($transaksi);

            // Hitung total pemasukan
            $totalPemasukan = 0;

            foreach ($transaksi as $trans) {
                if (isset($trans['berat']) && isset($trans['idPaket']['harga'])) {
                    $harga = (int) $trans['idPaket']['harga'];
                    $berat = (int) $trans['berat'];
                    $subtotal = $harga * $berat;

                    if (isset($trans['idPromo']['potongan'])) {
                        $potongan = (int) $trans['idPromo']['potongan'];
                        $subtotal -= $potongan;
                    }

                    $totalPemasukan += $subtotal;
                }
            }

        } else {
            return view('pages.home.index')->with('error', 'Failed to fetch data: ' . $responseBodyTransaksi['msg']);
        }
    } else {
        return view('pages.home.index')->with('error', 'Failed to fetch data: Status code ' . $statusCodeTransaksi);
    }

    return view('pages.home.index', [
        'jumlahPelanggan' => $jumlahPelangganRole1,
        'jumlahTransaksi' => $jumlahTransaksi,
        'totalPemasukan' => $totalPemasukan,
        'transaksi' => $transaksi,
    ]);
}

public function ubahStatusDriver($id, Request $request)
{
    $status = $request->input('status');
    $client = new \GuzzleHttp\Client();
    $url = 'http://103.175.220.104/user/edit-status-driver/' . $id;

    try {
        $response = $client->request('PUT', $url, [
            'json' => [
                'status' => $status
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);

        $statusCode = $response->getStatusCode();
        $responseBody = json_decode($response->getBody(), true);

        if ($statusCode == 200 && isset($responseBody['sukses']) && $responseBody['sukses'] == true) {
            // Perbarui sesi dengan status terbaru
            Session::put('status', $status);
            return redirect()->route('home.index')->with('success', 'Status updated successfully');
        } else {
            $errorMsg = isset($responseBody['msg']) ? $responseBody['msg'] : 'Failed to update status';
            return back()->with('error', 'Failed to update status: ' . $errorMsg);
        }
    } catch (\Exception $e) {
        return back()->with('error', 'Failed to update status: ' . $e->getMessage());
    }
}

function ambilOrderan($id, $idDriver)
{
    $client = new \GuzzleHttp\Client();
    $url = 'http://103.175.220.104/transaksi/ambilorderan/' . $id;

    try {
        $response = $client->request('PUT', $url, [
            'json' => [
                'idDriver' => $idDriver
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);
        $statusCode = $response->getStatusCode();
        $responseBody = json_decode($response->getBody(), true);
        if ($statusCode == 200) {
            return redirect()->route('home.index')->with('success', $responseBody['msg']);
        } else {
            $errorMsg = isset($responseBody['msg']) ? $responseBody['msg'] : 'Failed to update status';
            return back()->with('error', 'Failed to update status: ' . $errorMsg);
        }
    } catch (\Exception $e) {
        return back()->with('error', 'Failed to update status: ' . $e->getMessage());
    }
}

}
