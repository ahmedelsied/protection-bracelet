<?php

namespace App\Support\Traits;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;

trait WithPagination
{
    public static function paginate($resource, $wrapper = 'items')
    {
        if (! ($resource instanceof AbstractPaginator)) {
            return self::collection($resource);
        }

        return new class($resource, self::class, $wrapper) extends ResourceCollection
        {
            public string $wrapper;

            public function __construct($resource, string $collects, $wrapper = 'items')
            {
                $this->collects = $collects;
                parent::__construct($resource);
                $this->wrapper = $wrapper;
            }

            public function toArray($request): array
            {
                return [
                    $this->wrapper => $this->collection,
                    'paginate' => [
                        'total' => $this->total(),
                        'count' => $this->count(),
                        'per_page' => $this->perPage(),
                        'next_page_url' => $this->nextPageUrl() ?? '',
                        'prev_page_url' => $this->previousPageUrl() ?? '',
                        'current_page' => $this->currentPage(),
                        'total_pages' => $this->lastPage(),
                    ],
                ];
            }
        };
    }
}
