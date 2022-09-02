<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Country
 * @package App\Models
 */
class Country extends Model
{
    /**
     * @var string
     */
    protected $primaryKey = 'country_id';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'full_name',
        'code',
        'number',
        'iso3',
        'display_order',
        'continent_code'
    ];

    /**
     * @return BelongsTo
     */
    public function continent(): BelongsTo
    {
        return $this->belongsTo(Continent::class, 'continent_code', 'code');
    }
}
