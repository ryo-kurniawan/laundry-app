<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.laporan.index');
    }

    public function cetak(Request $request)
{
    // Fetch data from your endpoint
    $client = new \GuzzleHttp\Client();
    $response = $client->get('http://localhost:5001/transaksi/getAllTransaksi');
    $transactions = json_decode($response->getBody()->getContents(), true);

    // Filter transactions by date if needed
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    $filteredTransactions = array_filter($transactions['data'], function ($transaction) use ($fromDate, $toDate) {
        $transactionDate = strtotime($transaction['tanggal']);
        return $transactionDate >= strtotime($fromDate) && $transactionDate <= strtotime($toDate);
    });

    // Load view with data and convert to PDF
    $pdf = PDF::loadView('pages.laporan.pdf', ['transactions' => $filteredTransactions]);

    // Download the PDF
    return $pdf->download('laporan.pdf');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
