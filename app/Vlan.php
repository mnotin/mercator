<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Vlan
 */
class Vlan extends Model
{
    use HasFactory, SoftDeletes, Auditable;

    public $table = 'vlans';

    public static $searchable = [
        'name',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'vlan_id',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function physicalRouters(): BelongsToMany
    {
        return $this->belongsToMany(PhysicalRouter::class)->orderBy('name');
    }

    public function subnetworks(): HasMany
    {
        return $this->hasMany(Subnetwork::class, 'vlan_id', 'id')->orderBy('name');
    }
}
