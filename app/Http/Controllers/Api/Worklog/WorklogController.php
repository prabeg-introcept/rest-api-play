<?php

namespace App\Http\Controllers\Api\Worklog;

use App\Exceptions\Worklogs\UnauthorizedActionException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Worklogs\StoreWorklogRequest;
use App\Http\Requests\Worklogs\UpdateWorklogRequest;
use App\Http\Resources\Worklog\WorklogCollection;
use App\Http\Resources\Worklog\WorklogResource;
use App\Models\Worklog;
use App\Services\WorklogService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
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
        //$this->authorize('viewAny', Worklog::class);
        try{
            $worklogs = $this->worklogService->all();
        }catch(UnauthorizedActionException $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ],
                Response::HTTP_FORBIDDEN);
        }
        catch(Throwable $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return new WorklogCollection($worklogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWorklogRequest $request
     * @return WorklogResource|JsonResponse|Response
     */
    public function store(StoreWorklogRequest $request)
    {
        $worklogData = $request->validated();
        $worklogData['user_id'] = auth()->user()->id;
        try{
            $worklog = $this->worklogService->create($worklogData);
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
     * @return WorklogResource|JsonResponse|Response
     */
    public function show($id)
    {
        try{
            $worklog = $this->worklogService->get($id);
        }catch(UnauthorizedActionException $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ],
                Response::HTTP_FORBIDDEN);
        } catch(ModelNotFoundException $exception){
            return response()->json([
                'message' => "Worklog with id:$id does not exists"
            ],
                Response::HTTP_NOT_FOUND);
        }catch(Throwable $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ],
            Response::HTTP_BAD_REQUEST);
        }
        return new WorklogResource($worklog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorklogRequest $request
     * @param int $id
     * @return WorklogResource|JsonResponse|Response
     */
    public function update(UpdateWorklogRequest $request, $id)
    {
        try{
            $worklog = $this->worklogService->update($request->validated(), $id);
        }catch(UnauthorizedActionException $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ],
                Response::HTTP_FORBIDDEN);
        }catch(ModelNotFoundException $exception){
            return response()->json([
                'message' => "Worklog with id:$id does not exists"
            ],
                Response::HTTP_BAD_REQUEST);
        }catch(Throwable $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ],
                Response::HTTP_BAD_REQUEST);
        }
        return new WorklogResource($worklog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse|Response
     */
    public function destroy($id)
    {
        try{
            $worklog = $this->worklogService->delete($id);
        }catch(UnauthorizedActionException $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ],
                Response::HTTP_FORBIDDEN);
        }catch(ModelNotFoundException $exception){
            return response()->json([
                'message' => "Worklog with id:$id does not exists"
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
