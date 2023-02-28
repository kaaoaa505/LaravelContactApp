<?php

namespace App\Models;

use App\Scopes\FilterScope;
use App\Scopes\SearchScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'address',
        'company_id',
        'user_id',
    ];

    public $filterColumns = ['company_id'];

    public $searchColumns = ['first_name', 'last_name', 'email', 'company.name'];

    protected static function booted()
    {
        // static::addGlobalScope(new ContactSearchScope);
        static::addGlobalScope(new SearchScope);
        // static::addGlobalScope(new ContactFilterScope);
        static::addGlobalScope(new FilterScope);
    }

    public static function userContacts(){
        return auth()->user()->contacts()->latestFirst();
    }

    public function company()
    {
        return $this->belongsTo(Company::class)->withoutGlobalScopes();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('id', 'desc');
    }
    
}
