<?php

namespace App\Http\Resources\Worklog;

use App\Http\Resources\Feedback\FeedbackCollection;
use App\Http\Resources\User\UserResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class WorklogResource extends JsonResource
{
    //public static $wrap = 'worklog';
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'created_by' => new UserResource($this->user),
            'feedbacks' => new FeedbackCollection($this->whenLoaded('feedbacks')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];

    }
}
