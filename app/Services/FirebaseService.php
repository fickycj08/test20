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

    /**
     * Get the underlying Firestore client instance.
     */
    public function getFirestore()
    {
        return $this->firestore;
    }

    /**
     * Convenience helper to return all documents from a collection.
     */
    public function getCollection(string $name)
    {
        return $this->firestore->collection($name)->documents();
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
