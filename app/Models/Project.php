<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'tech_stack', 'image_url',
        'github_url', 'live_url', 'featured', 'sort_order'
    ];

    protected $casts = [
        'featured' => 'boolean',
    ];

    public function getTechArrayAttribute(): array
    {
        return array_map('trim', explode(',', $this->tech_stack));
    }
}
