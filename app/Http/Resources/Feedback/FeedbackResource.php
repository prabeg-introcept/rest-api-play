<?php

namespace App\Http\Resources\Feedback;

use App\Http\Resources\Worklog\WorklogResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
{
    public static $wrap = 'feedback';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'worklog' => new WorklogResource($this->whenloaded('worklog')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
