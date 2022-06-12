<?php

namespace App\Module\Common\Application\Response;

use App\Module\Common\Domain\Model\PaginatedCollectionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class JsonPaginationResponse extends JsonResponse
{
    public function __construct(PaginatedCollectionInterface $collection, int $status = Response::HTTP_OK, array $headers = [], bool $json = false)
    {
        parent::__construct($this->makeResponseBody($collection), $status, $headers, $json);
    }

    private function makeResponseBody(PaginatedCollectionInterface $collection): array
    {
        return [
            'data' => $collection->all(),
            'pagination' => [
                'limit' => $collection->getLimit()->value(),
                'offset' => $collection->getOffset()->value(),
                'total' => $collection->getTotal()->value()
            ]
        ];
    }
}