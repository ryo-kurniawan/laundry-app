<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        $url = 'http://127.0.0.1:5001/transaksi/getAllTransaksi'; // Sesuaikan URL dengan route di Express.js

        try {
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody(), true);

            if ($data['status'] == 200) {
                return view('pages.transaksi.index', ['transaksis' => $data['data']]);
            } else {
                return back()->with('error', 'Gagal Mengambil Data');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal Mengambil Data: ' . $e->getMessage());
        }
    }

    public function riwayat()
    {
        return view('pages.transaksi.riwayat');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Mengambil data transaksi dari API menggunakan GuzzleHTTP
        $client = new Client();
        $response = $client->request('GET', 'http://127.0.0.1:5001/transaksi/getbyid/' . $id);
        $transaksi = json_decode($response->getBody()->getContents(), true);

        // Jika data transaksi tidak ditemukan, redirect ke halaman sebelumnya
        if ($response->getStatusCode() !== 200) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
        }

        // Tampilkan halaman edit dengan data transaksi yang didapat dari API
        return view('pages.transaksi.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Fungsi untuk mengupdate transaksi
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'berat' => 'required|numeric',
            'detail' => 'required|string',
            'status' => 'required|integer',
        ]);

        // Inisialisasi GuzzleHttp Client
        $client = new Client();
        $url = 'http://127.0.0.1:5001/transaksi/update/' . $id;

        try {
            // Data yang akan dikirim ke API
            $data = [
                'berat' => $request->input('berat'),
                'detail' => $request->input('detail'),
                'status' => $request->input('status'),
            ];

            // Mengirim request ke API
            $response = $client->put($url, [
                'json' => $data
            ]);

            // Mendapatkan status code dari response
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                return redirect()->route('transaksi.index')->with('success', 'Transaksi updated successfully');
            } else {
                return back()->with('error', 'Failed to update transaksi: Status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update transaksi: ' . $e->getMessage());
        }
    }

    // Fungsi untuk cetak nota
    public function cetakNota($id)
    {
        // Lakukan validasi atau verifikasi terlebih dahulu sesuai kebutuhan
        // Misalnya, memastikan ID transaksi valid atau pengguna memiliki hak akses, dst.

        // Mengambil data transaksi dari API atau database
        $client = new Client();
        $url = 'http://127.0.0.1:5001/transaksi/getbyid/' . $id;

        try {
            // Mengirim request ke API untuk mendapatkan data transaksi berdasarkan ID
            $response = $client->get($url);
            $transaksi = json_decode($response->getBody(), true);

            // Lakukan validasi atau manipulasi data transaksi jika diperlukan

            // Mengembalikan view untuk tampilan cetak nota
            return view('pages.transaksi.cetak-nota', compact('transaksi'));

        } catch (\Exception $e) {
            // Menangani jika gagal mengambil data dari API atau terjadi kesalahan lainnya
            return back()->with('error', 'Failed to fetch transaction data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = new Client();

        try {
            // Memanggil endpoint API untuk menghapus transaksi
            $response = $client->delete('http://127.0.0.1:5001/transaksi/delete/' . $id);

            if ($response->getStatusCode() == 200) {
                return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
            } else {
                return redirect()->route('transaksi.index')->with('error', 'Gagal menghapus transaksi');
            }
        } catch (\Exception $e) {
            return redirect()->route('transaksi.index')->with('error', 'Gagal menghapus transaksi: ' . $e->getMessage());
        }
    }
}
