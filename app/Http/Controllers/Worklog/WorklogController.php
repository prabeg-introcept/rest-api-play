<?php

namespace App\Http\Controllers\Worklog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Worklogs\StoreWorklogRequest;
use App\Http\Resources\WorklogResource;
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
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWorklogRequest $request
     * @return WorklogResource|JsonResponse|Response
     */
    public function store(StoreWorklogRequest $request)
    {
        try{
            $worklog = $this->worklogService->create($request->validated());
        }catch(Throwable $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ],
        Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return new WorklogResource($worklog);
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