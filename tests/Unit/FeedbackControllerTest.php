<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Api\Feedback\FeedbackController;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


class FeedbackControllerTest extends TestCase
{
    public function testIndexMethod()
    {
        $controller = new FeedbackController();

        // Mock the request
        $request = Request::create('/api/index-feedback', 'GET');

        // Call the index method
        $response = $controller->index($request);

        // Assert that the response is an instance of LengthAwarePaginator
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getData()->data);
    }

    public function testStoreMethod()
    {
        $controller = new FeedbackController();

        // Mock the request data
        $requestData = [
            'title' => 'Test Feedback',
            'description' => 'This is a test feedback.',
            'category' => 'Test Category'
            // Add more data as needed
        ];

        // Mock the request
        $request = Request::create('/api/store-feedback', 'POST', $requestData);

        // Call the store method
        $response = $controller->store($request);

        // Assert that the response is successful
        $this->assertEquals(200, $response->getStatusCode());
    }
}
