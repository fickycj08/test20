<?php

namespace App\Services;

use Google\Cloud\Firestore\FirestoreClient;

class FirebaseService
{
    protected $firestore;

    public function __construct()
    {
        $this->firestore = new FirestoreClient([
            'keyFilePath' => storage_path('app/firebase/akastrafb.json'),
        ]);
    }

    public function testConnection()
    {
        try {
            $collection = $this->firestore->collection('test');
            $documents = $collection->documents();

            foreach ($documents as $doc) {
                echo 'Doc ID: ' . $doc->id() . '<br>';
            }

            return "Firestore berhasil terhubung!";
        } catch (\Throwable $e) {
            return "Gagal konek Firestore: " . $e->getMessage();
        }
    }
}
