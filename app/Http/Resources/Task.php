<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Task extends JsonResource
{
    /**
     * Transform the Task resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //get user name from user_id for each instance
        $user = \App\Models\User::where('id', $this->user_id)->first();
        $name = $user->first_name . ' ' . $user->last_name;
        return [
            'task_id' => (int) $this->id,
            'author' => (string) $name,
            'body' => (string) $this->text,
            'completed' => (bool) $this->is_completed,
            'created_date' => $this->created_at,
            //'updated_date' => $this->updated_at
        ];
    }
}
