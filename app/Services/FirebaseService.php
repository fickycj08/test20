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

    public function getFireStore()
    {
        return $this->firestore;
    }

    public function getCollection(string $collection)
    {
        return $this->firestore->collection($collection)->documents();
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
