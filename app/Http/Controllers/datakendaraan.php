<?php

namespace App\Http\Controllers;


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
        // Fetching documents just to ensure Firestore connection is used.
        $documents = $this->firebase->getCollection('vehicles');

        $data = [];
        foreach ($documents as $doc) {
            if ($doc->exists()) {
                $data[] = $doc->data();
            }
        }

        return view('datakendaraan.index', compact('data'));
    }
}
