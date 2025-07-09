<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\FirebaseService;

class FirestoreController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function index()
    {
        $firestore = $this->firebase->getFireStore();
        $collection = $firestore->collection('users');
        $documents = $collection->documents();

        foreach ($documents as $document) {
            if ($document->exists()) {
                echo 'User: ' . json_encode($document->data()) . '<br>';
            }
        }
    }
}

