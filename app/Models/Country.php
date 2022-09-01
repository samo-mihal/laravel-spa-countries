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
     * @return BelongsTo
     */
    public function continent(): BelongsTo
    {
        return $this->belongsTo(Continent::class, 'continent_code', 'code');
    }
}
