<?php

namespace App\Repositories;

use App\Models\ActivityUrl;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ActivityUrlRepository
{

    /**
     * @param string $url
     * @return ActivityUrl|Model
     */
    public function findOrCreateActivityByUrl(string $url): ActivityUrl
    {

        return ActivityUrl::query()->firstOrCreate(
            ['url_hash' => $this->getUrlHash($url)],
            ['url' => $url]
        );

    }

    public function incrementTicks(ActivityUrl $activityUrl, \DateTime $tickTimestamp): void
    {
        $activityUrl->increment('ticks');
        $activityUrl->last_tick_at = $tickTimestamp;
        $activityUrl->save();
    }

    public function getUrlHash(string $url): string
    {
        return sha1($url);
    }

    public function getList(int $limit, int $offset = 0): Collection
    {
        return ActivityUrl::query()->limit($limit)->offset($offset)->get();
    }

    public function getTotal(): int
    {
        return ActivityUrl::query()->count();
    }

}
