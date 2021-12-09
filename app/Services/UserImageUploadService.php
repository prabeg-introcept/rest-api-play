<?php


namespace App\Services;


use App\Constants\Messages;
use App\Exceptions\Users\UserImageNotUploadedException;
use App\Models\UserImage;
use Illuminate\Support\Facades\Storage;

class UserImageUploadService
{
    public function __construct(
        private UserImage $userImage)
    {
    }

    public function upload(array $data)
    {
        $file = $this->imageStore($data);
        if(!$file){
            throw new UserImageNotUploadedException(Messages::ERROR_UPLOAD_USER_IMAGE);
        }
        return $this->userImage->updateOrCreate($file);
    }

    private function imageStore(array $data)
    {
        if (Storage::disk('local')->exists("user_image/{$data['user_id']}")) {
            Storage::delete("user_image/{$data['user_id']}");
        }
        $filePath = '/storage/' . $data["file"]->storeAs('user_image', $data['user_id']);
        return array(
            "file_path" => $filePath,
            "user_id" => $data['user_id']
        );
    }
}
