<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'date' => $this->date,
            'breakfast' => $this->breakfast,
            'lunch' => $this->lunch,
            'dinner' => $this->dinner,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
