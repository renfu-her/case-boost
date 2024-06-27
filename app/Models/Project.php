<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug', // 添加 slug 字段
        'contact_person',
        'phone',
        'mobile',
        'email',
        'department',
        'title',
        'description',
        'work_content',
        'schedule',
        'location',
        'budget',
        'notes',
        'start_date',
        'inquiry_deadline',
        'required_skills',
        'budget_range',
        'target_audience',
        'work_location',
        'status',
        'experience_years',
        'issuer_website',
        'category_id'
    ];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'inquiry_deadline' => 'date:Y-m-d',
        'status' => 'boolean',
        'experience_years' => 'integer',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $hidden = [
        'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            $project->slug = Str::slug($project->name, '-');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }
}
