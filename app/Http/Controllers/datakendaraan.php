<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Services\FirebaseService;

class datakendaraan extends Controller
{
    protected FirebaseService $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function index()
    {
        $documents = $this->firebase->getCollection('vehicles');

        $data = [];
        foreach ($documents as $doc) {
            $data[] = [
                'userId'       => $doc['userId'],
                'model'        => $doc['model'],
                'nomor_polisi' => $doc['nomor_polisi'],
                'tipe_bensin'  => $doc['tipe_bensin'],
                'transmisi'    => $doc['transmisi'],
                'kilometer'    => $doc['kilometer'],
            ];
        }

        return view('datakendaraan.index', compact('data'));
    }
}
