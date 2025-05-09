<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Network
 */
class Network extends Model
{
    use HasFactory, SoftDeletes, Auditable;

    public $table = 'networks';

    public static $searchable = [
        'name',
        'description',
        'protocol_type',
        'responsible',
        'responsible_sec',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'protocol_type',
        'responsible',
        'responsible_sec',
        'security_need_c',
        'security_need_i',
        'security_need_a',
        'security_need_t',
        'security_need_auth',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function externalConnectedEntities(): HasMany
    {
        return $this->hasMany(ExternalConnectedEntity::class, 'network_id', 'id')->orderBy('name');
    }

    public function subnetworks(): HasMany
    {
        return $this->hasMany(Subnetwork::class, 'network_id', 'id')->orderBy('name');
    }
}
