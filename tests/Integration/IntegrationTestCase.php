<?php

namespace Tests\Integration;

use Tests\TestCase;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use App\Events\ActivityLogged;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Tests\Assertions\AssertsActivityLogged;
use Tests\Traits\Integration\CreatesTestModels;
use App\Transformers\Api\Application\BaseTransformer;

abstract class IntegrationTestCase extends TestCase
{
    use CreatesTestModels;
    use AssertsActivityLogged;
    use DatabaseTruncation;

    protected $defaultHeaders = [
        'Accept' => 'application/json',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake(ActivityLogged::class);
    }

    /**
     * Return an ISO-8601 formatted timestamp to use in the API response.
     */
    protected function formatTimestamp(string $timestamp): string
    {
        return CarbonImmutable::createFromFormat(CarbonInterface::DEFAULT_TO_STRING_FORMAT, $timestamp)
            ->setTimezone(BaseTransformer::RESPONSE_TIMEZONE)
            ->toAtomString();
    }

    /**
     * Return the database connections that should be wrapped in a transaction for each test.
     *
     * @return array
     */
    protected function connectionsToTransact()
    {
        return [DB::getDriverName()];
    }
}
