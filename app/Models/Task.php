<?php

namespace App\Models;

use App\Actions\SaveFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'text',
        'status',
        'user_id',
        'image',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function setImageAttribute($value){
        $this->attributes['image'] = app()->call(new SaveFile($value,'tasks'));
    }
}
