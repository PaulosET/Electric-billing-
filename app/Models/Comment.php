<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{   
    use HasFactory;

    protected $table='comments';

    protected $fillable=[
        'post_id',
        'user_id',
        'category_id',
        'comment_body',
    ];
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
