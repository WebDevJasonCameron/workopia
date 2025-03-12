<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    // USEs
    use HasFactory;

    // PROPs
    protected $table = 'job_listings';              // Lets me rename the table if not same as model

    protected $fillable = [
        'title',
        'description',
        'salary',
        'tags',
        'job_type',
        'remote',
        'requirements',
        'benefits',
        'address',
        'city',
        'state',
        'zipcode',
        'contact_email',
        'contact_phone',
        'company_name',
        'company_description',
        'company_logo',
        'company_website',
        'user_id',
    ];

    // METHs
    // Relation to user (one to one)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relation to bookmarks (one to many)
    public function bookmarkedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'job_user_bookmarks')->withTimestamps();
    }

    // Relation to applicants (manny to many)
    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class);
    }
}
