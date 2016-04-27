<?php

namespace App\Http\Controllers\Api;

use App\Quote;
use App\Schemas\QuoteSchema;
use Illuminate\Http\Request;
use Neomerx\JsonApi\Encoder\Encoder;
use App\Http\Controllers\Api\ApiController;
use Neomerx\JsonApi\Encoder\EncoderOptions;

class QuoteController extends ApiController
{
    public function index()
    {
        $encoder = Encoder::instance([
            Quote::class => QuoteSchema::class,
        ], new EncoderOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES, url(self::API_PREFIX)));

        return response($encoder->encodeData(Quote::all()));
    }

    public function show($id)
    {
        $encoder = Encoder::instance([
            Quote::class => QuoteSchema::class,
        ], new EncoderOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES, url(self::API_PREFIX)));

        return response($encoder->encodeData(Quote::findOrFail($id)));
    }

    public function post(Request $request)
    {
        // This would be where you validate the incoming json request.
        $data  = $request->json('data');

        // We use the validated data to call the create method on the Quote class.
        // Calling create will return instance of the new Quote within the database,
        // so that we can use that new instance's data as part of the response.
        $quote = Quote::create([
            'phrase'     => $data['phrase'],
            'author'     => $data['author'],
        ]);

        $encoder = Encoder::instance([
            Quote::class => QuoteSchema::class,
        ], new EncoderOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES, url(self::API_PREFIX)));
        $data = $encoder->encodeData($quote);
        $self = array_get(json_decode($data, true), 'data.links.self');

        // You would return appropriate response information here. $quote->id is just an example.
        return response($data, 201, ['Location' => $self]);
    }
}
