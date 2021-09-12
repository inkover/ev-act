<?php

namespace App\Services\Activity;

use App\Repositories\ActivityUrlRepository;
use Illuminate\Database\Eloquent\Collection;

class SummaryService
{

    private ActivityUrlRepository $activityUrlRepository;

    public function __construct(ActivityUrlRepository $activityUrlRepository)
    {
        $this->activityUrlRepository = $activityUrlRepository;
    }


    public function getSummary(int $limit, int $offset = 0): Collection
    {
        return $this->activityUrlRepository->getList($limit, $offset);
    }

    public function getSummaryTotal(): int
    {
        return $this->activityUrlRepository->getTotal();
    }

}
