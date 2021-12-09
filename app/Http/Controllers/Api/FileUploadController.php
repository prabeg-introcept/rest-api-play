<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Users\UserImageNotUploadedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserImage\StoreUserImageRequest;
use App\Services\UserImageUploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class FileUploadController extends Controller
{
    public function __construct(
        private UserImageUploadService $userImageUploadService
    )
    {
    }

    /**
     * Handle the incoming request.
     *
     * @param StoreUserImageRequest $request
     * @return JsonResponse|Response
     */
    public function __invoke(StoreUserImageRequest $request)
    {
        $validated = $request->safe()->only('file');
        $validated['user_id'] = $request->user()->id;

        try{
         $file = $this->userImageUploadService->upload($validated);
        }catch(UserImageNotUploadedException $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ], Reponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json($file, Response::HTTP_OK);
    }
}
