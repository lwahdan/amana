<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property string|null $bio
 * @property string|null $certifications
 * @property string $gender
 * @property string|null $date_of_birth
 * @property int|null $years_of_experience
 * @property string|null $education
 * @property string|null $skills
 * @property string|null $languages_spoken
 * @property string|null $availability
 * @property string|null $hourly_rate
 * @property string|null $work_shifts
 * @property string|null $work_locations
 * @property int $background_checked
 * @property string|null $profile_picture
 * @property string|null $phone
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Blog> $blog
 * @property-read int|null $blog_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Booking> $bookings
 * @property-read int|null $bookings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\City> $cities
 * @property-read int|null $cities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Meeting> $meetings
 * @property-read int|null $meetings_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property-read int|null $services_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Provider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereAvailability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereBackgroundChecked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereCertifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereHourlyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereLanguagesSpoken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereProfilePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereWorkLocations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereWorkShifts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereYearsOfExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider withoutTrashed()
 * @mixin \Eloquent
 */
class Provider extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $guard = 'provider';
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'date_of_birth',
        'phone',
        'address',
        'profile_picture',
        'years_of_experience',
        'education',
        'certifications',
        'skills',
        'hourly_rate',
        'work_shifts',
        'availability',
        'bio',
        'background_checked',
        'languages_spoken',
    ];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_of_birth' => 'date',
    ];

    // public function user()
    // {
    // return $this->belongsToMany(User::class);
    // } 

    public function users()
    {
        return $this->hasManyThrough(
            User::class,
            Booking::class,
            'provider_id',    // Foreign key on bookings table
            'id',             // Foreign key on users table
            'id',             // Local key on providers table
            'user_id'         // Local key on bookings table
        );
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'provider_service', 'provider_id', 'service_id')
            ->withPivot('rating') // Include extra columns from the pivot table
            ->withTimestamps(); // Include timestamps from the pivot table

    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function cities()
    {
        return $this->belongsToMany(City::class, 'city_provider', 'provider_id', 'city_id');
    }

    // public function blog(){
    //     return $this->hasMany(Blog::class , 'writer_id');
    // }
    
    public function blog()
    {
        return $this->morphMany(Blog::class, 'writer');
    }
}
