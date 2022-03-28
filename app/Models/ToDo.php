<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\UsesUuid;

class ToDo extends Model
{
    use HasFactory, UsesUuid;

    protected $table = "todos";
    protected $casts = [
        "done" => "boolean"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

}
