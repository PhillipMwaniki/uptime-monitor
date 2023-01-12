<?php

namespace App\Jobs;

use App\Models\Endpoint;
use Exception;
use Http;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PerformEndpointCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Endpoint $endpoint;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Endpoint $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // http request
        try {
            $response = Http::get($this->endpoint->url());

            \Log::info($response->status());
        }catch (Exception $e) {

        }

        //update endpoint with the new next_check
        $this->endpoint->update([
            'next_check' => now()->addSeconds($this->endpoint->frequency)
        ]);
    }
}
