<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'topic_id', 
        'user_id', 
        'title', 
        'slug_title', 
        'seo_title', 
        'description', 
        'content_post', 
        'meta_des', 
        'meta_keyword', 
        'active', 
        'url_img', 
        'view', 
        'type', 
        'parent', 
        'rate', 
        'created_at', 
        'updated_at',
    ];

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function validComments()
    {
        return $this->comments()->whereHas('user', function ($query) {
            $query->whereValid(true);
        });
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function parentComments()
    {
        return $this->validComments()->whereParentId(null);
    }

    /**
     * Many to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
