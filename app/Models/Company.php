<?php

namespace App\Models;

use App\Scopes\SearchScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // protected $guarded = [];

    protected $fillable = [
        'name',
        'email',
        'address',
        'website',
    ];

    public $searchColumns = [
        'name',
        'email',
        'address',
        'website',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new SearchScope);
    }

    public static function userCompanies()
    {
        // return auth()->user()->companies()->orderBy('name', 'asc')->pluck('name', 'id');
        return self::where('user_id', auth()->id())->with('company')->orderBy('name', 'asc')->pluck('name', 'id')->prepend('All Companies', '');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class)->withoutGlobalScope(SearchScope::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
