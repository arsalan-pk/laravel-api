<?php

namespace App\Http\Controllers\Api\Feedback;

use App\Models\Feedback;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $perPage = $request->query('per_page', 10);

        $page = $request->query('page', 1);

        $feedbacks = Feedback::with('user', 'product')->paginate($perPage, ['*'], 'page', $page);

        return ApiResponse::withData($feedbacks);
    }
    /**
     * show the search .
     */
    public function search(Request $request)
    {
        $page = $request->query('page', 10);

        $search = $request->query('search');

        $query = Feedback::with('user', 'product');

        if ($search) {
            $query->search($search);
        }

        $feedbacks = $query->paginate($page);

        return ApiResponse::withData($feedbacks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeedbackRequest $request)
    {
        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        Feedback::create($data);

        return ApiResponse::withSuccess('Successfully Saved Your Feedback');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $feedback = Feedback::with('user', 'product')->findOrFail($id);

            return ApiResponse::withData($feedback);
        } catch (ModelNotFoundException $exception) {

            return ApiResponse::withError($exception->getMessage(), 'An error occurred while showing feedback');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeedbackRequest $request, string $id)
    {
        try {

            $feedback = Feedback::findOrFail($id);

            if (Auth::user()->id === $feedback->user_id) {
                $feedback->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'category' => $request->category
                ]);

                return ApiResponse::withData($feedback, 'Feedback updated successfully');
            } else {
                return ApiResponse::withError('Unauthenticated', 'An error occurred while updating feedback', 401);
            }
        } catch (ModelNotFoundException $exception) {

            return ApiResponse::withError($exception->getMessage(), 'An error occurred while updating feedback');
        } catch (\Exception $exception) {

            return ApiResponse::withError($exception->getMessage(), 'An error occurred while updating feedback');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $feedback = Feedback::findOrFail($id);

            if (Auth::user()->id === $feedback->user_id) {
                $feedback->delete();
                return ApiResponse::withSuccess('Feedback deleted successfully');
            } else {
                return ApiResponse::withError('Unauthenticated', 'An error occurred while Deleting feedback', 401);
            }
        } catch (ModelNotFoundException $exception) {

            return ApiResponse::withError($exception->getMessage(), 'An error occurred while deleting feedback');
        } catch (\Exception $exception) {

            return ApiResponse::withError($exception->getMessage(), 'An error occurred while deleting feedback');
        }
    }
}
