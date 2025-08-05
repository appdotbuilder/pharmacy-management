<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\PrescriptionItem
 *
 * @property int $id
 * @property int $prescription_id
 * @property int $drug_id
 * @property int $quantity_prescribed
 * @property int $quantity_dispensed
 * @property string $dosage_instructions
 * @property int|null $duration_days
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Prescription $prescription
 * @property-read \App\Models\Drug $drug
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SaleItem> $saleItems
 * @property-read int $remaining_quantity
 * @property-read bool $is_fully_dispensed
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionItem query()

 * 
 * @mixin \Eloquent
 */
class PrescriptionItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'prescription_id',
        'drug_id',
        'quantity_prescribed',
        'quantity_dispensed',
        'dosage_instructions',
        'duration_days',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'prescription_id' => 'integer',
        'drug_id' => 'integer',
        'quantity_prescribed' => 'integer',
        'quantity_dispensed' => 'integer',
        'duration_days' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the prescription that owns the prescription item.
     */
    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class);
    }

    /**
     * Get the drug that owns the prescription item.
     */
    public function drug(): BelongsTo
    {
        return $this->belongsTo(Drug::class);
    }

    /**
     * Get the sale items for the prescription item.
     */
    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    /**
     * Get the remaining quantity to be dispensed.
     *
     * @return int
     */
    public function getRemainingQuantityAttribute(): int
    {
        return $this->quantity_prescribed - $this->quantity_dispensed;
    }

    /**
     * Check if the prescription item is fully dispensed.
     *
     * @return bool
     */
    public function getIsFullyDispensedAttribute(): bool
    {
        return $this->quantity_dispensed >= $this->quantity_prescribed;
    }
}