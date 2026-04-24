<?php
namespace App\Jobs;

use App\Models\Clients;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportClientsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $path;

    // ✅ FIX: accept $path properly
    public function __construct($path)
    {
        $this->path = $path;
    }

    public function handle(): void
    {
       // $file = storage_path('app/' . $this->path);
        $file = storage_path('app/imports/' . basename($this->path));

        if (!file_exists($file)) {
            throw new \Exception("File not found: " . $file);
        }

        $rows = array_map('str_getcsv', file($file));

        if (empty($rows)) {
            throw new \Exception("CSV file is empty");
        }

        unset($rows[0]);

        $batch = [];

        foreach ($rows as $row) {

            if (!isset($row[0], $row[1])) {
                continue;
            }

            $batch[] = [
                'name' => trim($row[0]),
                'mobile_no' => trim($row[1]),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($batch) === 1000) {
                Clients::insert($batch);
                $batch = [];
            }
        }

        if (!empty($batch)) {
            Clients::insert($batch);
        }
    }
}