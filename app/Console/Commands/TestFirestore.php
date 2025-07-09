<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google\Cloud\Firestore\FirestoreClient;

class TestFirestore extends Command
{
    // Ini command yang dipanggil di terminal
    protected $signature = 'test:firestore';

    protected $description = 'Test Firestore connection';

    public function handle()
    {
        try {
            $firestore = new FirestoreClient([
                'projectId' => 'your-project-id', // Ganti ini sesuai project id Firestore kamu
            ]);
            $collections = $firestore->collections();

            $this->info('Connected to Firestore! List of collections:');
            foreach ($collections as $collection) {
                $this->line($collection->id());
            }
        } catch (\Exception $e) {
            $this->error('Connection failed: ' . $e->getMessage());
        }
    }
}
