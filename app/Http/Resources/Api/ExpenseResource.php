<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type_expense_id' => $this->type_expense_id,
            'user_id' => $this->user_id,
            'register' => $this->register,
            'title' => $this->title,
            'slug' => $this->slug,
            'source' => $this->source,
            'current_balance' => $this->current_balance,
            'blocked_balance' => $this->blocked_balance,
            'used_balance' => $this->used_balance,
            'available_balance' => $this->available_balance,
            'status' => $this->status,
            'notes' => $this->notes,
        ];
    }
}
