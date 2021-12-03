<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Feedbacks\StoreFeedbackRequest;
use App\Http\Requests\Feedbacks\UpdateFeedbackRequest;
use App\Http\Resources\Feedback\FeedbackCollection;
use App\Http\Resources\Feedback\FeedbackResource;
use App\Services\FeedbackService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class FeedbackController extends Controller
{
    public function __construct(
        private FeedbackService $feedbackService
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return FeedbackCollection|JsonResponse|Response
     */
    public function index(int $worklogId)
    {
        try{
            $feedbacks = $this->feedbackService->allFor($worklogId);
        }catch(Throwable $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return new FeedbackCollection($feedbacks);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreFeedbackRequest $request
    * @return FeedbackResource|JsonResponse|Response
    */
    public function store(StoreFeedbackRequest $request)
    {
        try{
            $feedback = $this->feedbackService->create($request->validated());
        }catch(Throwable $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return new FeedbackResource($feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param int $feedbackId
     * @return FeedbackResource|JsonResponse|Response
     */
    public function show(int $feedbackId)
    {
        try{
            $feedback = $this->feedbackService->get($feedbackId);
        } catch(ModelNotFoundException $exception){
            return response()->json([
                'message' => "Feedback with id:$id does not exists"
            ],
                Response::HTTP_BAD_REQUEST);
        }catch(Throwable $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ],
                Response::HTTP_BAD_REQUEST);
        }
        return new FeedbackResource($feedback);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFeedbackRequest $request
     * @param $feedbackId
     * @return FeedbackResource|JsonResponse|Response
     */
    public function update(UpdateFeedbackRequest $request, int $feedbackId)
    {
        try{
            $feedback = $this->feedbackService->update($request->validated(), $feedbackId);
        }catch(ModelNotFoundException $exception){
            return response()->json([
                'message' => "Feedback with id:$feedbackId does not exists"
            ],
                Response::HTTP_BAD_REQUEST);
        }catch(Throwable $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ],
                Response::HTTP_BAD_REQUEST);
        }
        return new FeedbackResource($feedback);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $feedbackId
     * @return JsonResponse|Response
     */
    public function destroy(int $feedbackId)
    {
        try{
            $this->feedbackService->delete($feedbackId);
        }catch(ModelNotFoundException $exception){
            return response()->json([
                'message' => "Feedback with id:$feedbackId does not exists"
            ],
                Response::HTTP_BAD_REQUEST);
        }catch(Throwable $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
