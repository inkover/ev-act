<?php

namespace App\Services\Activity;

use App\Jobs\ActivityTickJob;
use App\Repositories\ActivityUrlRepository;
use Carbon\Carbon;

class TickService
{

    /**
     * @var ActivityUrlRepository
     */
    private $activityRepository;

    /**
     * @param ActivityUrlRepository $activityRepository
     */
    public function __construct(ActivityUrlRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function registerTick(string $url, \DateTime $tickTimestamp): void
    {
        ActivityTickJob::dispatch($url, $tickTimestamp);
    }

    public function tickActivity(string $url, \DateTime $tickTimestamp): void
    {
        $activity = $this->activityRepository->findOrCreateActivityByUrl($url);

        $this->activityRepository->incrementTicks($activity, $tickTimestamp);
    }

}
