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

class PerformEndpointCheck implements ShouldQueue, ShouldBeUnique
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

    public function uniqueId()
    {
        return 'endpoint_' . $this->endpoint->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        // http request
        try {
            $response = Http::get($this->endpoint->url());

            $this->endpoint->checks()->create([
                'response_code' => $response->status(),
                'response_body' => !$response->successful() ? $response->body() : null,
            ]);
        }catch (Exception $e) {
            \Log::warning('http issue');
            \Log::warning($e->getMessage());
        }

        //update endpoint with the new next_check
        $this->endpoint->update([
            'next_check' => now()->addSeconds($this->endpoint->frequency)
        ]);
    }
}
