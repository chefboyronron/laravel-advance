<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Company;

class Customer extends Model
{
    /**
     * @Mass Assignments
     */

    /**
     * @fillable - Allowed fields to interact in the database
     * @value = field names
     */

    // protected $fillable = ['name', 'email', 'status'];

    /**
     * @guarded - Disallowed fields to interact in the database
     * @value - field names
     */

    protected $guarded = [];

    /**
     * Default attributes
     */
    protected $attributes = [
        // Field name
        'status' => 0
    ];

    /**
     * Accessor and Mutator
     * Approach change in laravel 9
     */
    public function getStatusAttribute($attribute)
    {
        return $this->statusOptions()[$attribute];
    }

    /**
     * @Scopes
     */
    
    public function scopeActive($query, $field, $order)
    {
        return $query->where('status', 1)->orderBy($field, $order);
    }

    public function scopeInactive($query, $field, $order)
    {
        return $query->where('status', 0)->orderBy($field, $order);
    }

    /**
     * Has Many Relationship
     * Customers to company relations
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function statusOptions()
    {
        return [
            1 => 'Active',
            0 => 'Inactive',
            2 => 'In Progress'
        ];
    }
}
