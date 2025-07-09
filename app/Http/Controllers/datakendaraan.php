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
        // Komentar dari branch 'codex' dipertahankan untuk kejelasan.
        // Fetching documents just to ensure Firestore connection is used.
        $documents = $this->firebase->getCollection('vehicles');

        $data = [];
        foreach ($documents as $doc) {
            // Menggunakan metode dari branch 'codex' karena lebih aman dan robust.
            // Ini memeriksa apakah dokumen ada sebelum mengambil datanya.
            if ($doc->exists()) {
                $data[] = $doc->data();
            }
        }

        return view('datakendaraan.index', compact('data'));
    }
}