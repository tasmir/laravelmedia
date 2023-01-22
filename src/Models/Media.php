<?php

namespace Tasmir\LaravelMedia\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Media extends Model
{
    use HasFactory;
    protected $guarded =['id', 'created_at', 'updated_at'];
//    public function getRouteKeyName()
//    {
//        return 'slug';
//    }
    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->slug = $model->generateSlug($model->name);
            $model->save();
        });

        static::creating(function ($model) {
            $model->created_by = Auth::check() ? Auth::id() : null;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::check() ? Auth::id() : null;
        });

        static::deleting(function ($model) {
            $model->deleted_by = Auth::check() ? Auth::id() : null;
            $model->save();
        });
    }

    public function generateSlug($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {
            $max = static::whereName($name)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }
}
