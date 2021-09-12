<?php

namespace App\Jobs;

use App\Services\Activity\TickService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ActivityTickJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $url;

    /**
     * @var \DateTime
     */
    private $tickTimestamp;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $url, \DateTime $tickTimestamp)
    {
        $this->queue = 'activity';
        $this->url = $url;
        $this->tickTimestamp = $tickTimestamp;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(TickService $tickService): void
    {
        $tickService->tickActivity($this->url, $this->tickTimestamp);
    }
}
