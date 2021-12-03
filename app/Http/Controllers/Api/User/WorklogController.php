<?php

namespace App\Http\Controllers\Api\User;

use App\Constants\FlashMessages;
use App\Http\Controllers\Controller;
use App\Http\Resources\Worklog\WorklogCollection;
use App\Services\WorklogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class WorklogController extends Controller
{
    public function __construct(
        private WorklogService $worklogService
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return WorklogCollection|JsonResponse|Response
     */
    public function index()
    {
        try{
            return new WorklogCollection($this->worklogService->getLoggedInUserWorklogs());
        }catch(Throwable $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
