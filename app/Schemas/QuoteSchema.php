<?php

namespace App\Schemas;

use Neomerx\JsonApi\Schema\SchemaProvider;

class QuoteSchema extends SchemaProvider
{
    protected $resourceType = 'quotes';

    protected $isShowSelfInIncluded = true;

    public function getId($quote)
    {
        return $quote->id;
    }

    public function getAttributes($quote)
    {
        return [
            'phrase' => $quote->phrase,
            'author' => $quote->author,
        ];
    }
}
