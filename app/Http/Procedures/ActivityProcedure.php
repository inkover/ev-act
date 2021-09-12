<?php

declare(strict_types=1);

namespace App\Http\Procedures;

use App\Http\Requests\Activity\SummaryRequest;
use App\Http\Requests\Activity\TickRequest;
use App\Services\Activity\SummaryService;
use App\Services\Activity\TickService;
use Carbon\Carbon;
use Sajya\Server\Procedure;

class ActivityProcedure extends Procedure
{

    public const DEFAULT_LIMIT = 10;

    /**
     * The name of the procedure that will be
     * displayed and taken into account in the search
     *
     * @var string
     */
    public static string $name = 'activity';

    private TickService $tickService;

    private SummaryService $summaryService;

    public function __construct(TickService $tickService, SummaryService $summaryService)
    {
        $this->tickService    = $tickService;
        $this->summaryService = $summaryService;
    }


    public function tick(TickRequest $request): void
    {
        $this->tickService->registerTick($request->get('url'), Carbon::parse($request->get('tick_timestamp', now())));
    }

    public function summary(SummaryRequest $request): array
    {

        $limit   = (int)$request->get('limit', self::DEFAULT_LIMIT);
        $offset  = (int)$request->get('offset', 0);
        $items = $this->summaryService->getSummary($limit, $offset);
        $total = $this->summaryService->getSummaryTotal();

        return [
            'limit' => $limit,
            'offset' => $offset,
            'items' => $items->toArray(),
            'total' => $total
        ];
    }
}
