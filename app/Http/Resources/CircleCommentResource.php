<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class CircleCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'user'      => self::getUser($this->user_id),
            'text'      => $this->text,
        ];
    }

    public static function getUser($user_id)
    {
        $user = User::find($user_id);

        return [
            'id'=> $user->id,
            'name'=> $user->name,
            'email'=> $user->email,
            'profile_pic'=> $user->profile_pic,
            'created_at'=> $user->created_at,
        ];
    }
}
