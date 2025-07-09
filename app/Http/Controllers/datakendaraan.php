<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Services\FirebaseService;
use Illuminate\Http\Request;

class datakendaraan extends Controller
{
    public function index ()
    {
        return view('datakendaraan.index');

    $documents = $firebase->getCollection('vehicles'); 

        $data = [];

        foreach ($documents as $doc) {
            $data[] = [
                'userId' => $doc['userId'],
                'model' => $doc['model'],
                'nomor_polisi' => $doc['nomor_polisi'],
                'tipe_bensin' => $doc['tipe_bensin'],
                'transmisi' => $doc['transmisi'],
                'kilometer' => $doc['kilometer'],
            ];
        }

        return view('firebase.index', compact('data'));
    }
}
