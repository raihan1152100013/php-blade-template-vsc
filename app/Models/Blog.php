<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Blog extends Model{
    protected $fillable = [
        'title', #judul
        'content', #konten
        'image', #cover
        'tags', #tag
        'author', #penulis
    ];

    public function up()
    {
        
    }
}