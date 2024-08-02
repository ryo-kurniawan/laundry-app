<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as PaginationLengthAwarePaginator;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $client = new Client();
        $url = 'http://103.175.220.104/user/getAllUsers';

        try {
            // Mendapatkan kata kunci pencarian dari input form
            $keyword = $request->input('keyword');

            // Membuat query string untuk kata kunci pencarian jika ada
            $queryParams = [];
            if ($keyword) {
                $queryParams['keyword'] = $keyword;
            }

            // Membuat request ke API dengan query string
            $response = $client->request('GET', $url, [
                'query' => $queryParams
            ]);

            $statusCode = $response->getStatusCode(); // Mendapatkan kode status HTTP

            if ($statusCode == 200) {
                $data = json_decode($response->getBody()->getContents(), true);

                // Transformasi data ke dalam koleksi untuk pagination
                $collection = collect($data['data']);

                // Konfigurasi pagination
                $perPage = 10; // Jumlah item per halaman
                $currentPage = $request->input('page', 1); // Halaman saat ini dari query string

                // Membuat instance LengthAwarePaginator
                $paginatedItems = new \Illuminate\Pagination\LengthAwarePaginator(
                    $collection->forPage($currentPage, $perPage), // Item untuk halaman saat ini
                    $collection->count(), // Jumlah total item
                    $perPage, // Item per halaman
                    $currentPage, // Halaman saat ini
                    ['path' => $request->url(), 'query' => $request->query()] // Path untuk link pagination
                );

                // Mengirimkan data ke view bersama dengan kata kunci pencarian
                return view('pages.pelanggan.index', [
                    'pelanggan' => $paginatedItems,
                    'keyword' => $keyword // Mengirimkan kata kunci pencarian ke view
                ]);
            } else {
                return view('pages.pelanggan.index')->with('error', 'Failed to fetch data: Status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return view('pages.pelanggan.index')->with('error', 'Failed to fetch data: ' . $e->getMessage());
        }
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = new Client();
        $url = 'http://103.175.220.104/user/getById/' . $id;

        try {
            $response = $client->request('GET', $url);
            $statusCode = $response->getStatusCode(); // Mendapatkan kode status HTTP

            if ($statusCode == 200) {
                $userData = json_decode($response->getBody()->getContents(), true);
                return view('pages.pelanggan.edit', compact('userData'));
            } else {
                return back()->with('error', 'Failed to fetch user data: Status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch user data: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'namalengkap' => 'required|string',
        'telepon' => 'required|string',
        'username' => 'required|string',
        'password' => 'nullable|string',

    ]);

    $client = new Client();
    $url = 'http://127.0.0.1:5001/user/edit/' . $id;

    try {
        $response = $client->request('PUT', $url, [
            'json' => $request->all(),
        ]);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody()->getContents(), true);

        if ($statusCode >= 200 && $statusCode < 300) {
            return redirect()->route('pelanggan.index')->with('success', 'User updated successfully');
        } else {
            return back()->with('error', 'Failed to update user: Invalid status code ' . $statusCode);
        }
    } catch (RequestException $e) {
        if ($e->hasResponse()) {
            $statusCode = $e->getResponse()->getStatusCode();
            $errorBody = json_decode($e->getResponse()->getBody()->getContents(), true);
            return back()->with('error', 'Failed to update user: ' . $statusCode . ' - ' . json_encode($errorBody));
        } else {
            return back()->with('error', 'Failed to update user: ' . $e->getMessage());
        }
    } catch (\Exception $e) {
        return back()->with('error', 'Failed to update user: ' . $e->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = new Client();
        $url = 'http://103.175.220.104/user/delete/' . $id;

        try {
            $response = $client->request('DELETE', $url);
            $statusCode = $response->getStatusCode(); // Mendapatkan kode status HTTP

            if ($statusCode == 200) {
                return redirect()->route('pelanggan.index')->with('success', 'User deleted successfully');
            } else {
                return back()->with('error', 'Failed to delete user: Status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }
}
