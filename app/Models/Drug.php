<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Drug
 *
 * @property int $id
 * @property string $name
 * @property string|null $generic_name
 * @property string|null $brand
 * @property string $category
 * @property string|null $description
 * @property float $price
 * @property int $stock_quantity
 * @property int $minimum_stock
 * @property string $unit
 * @property \Illuminate\Support\Carbon|null $expiry_date
 * @property string|null $batch_number
 * @property bool $requires_prescription
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrescriptionItem> $prescriptionItems
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SaleItem> $saleItems
 * @property-read bool $is_low_stock
 * @property-read bool $is_expired
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Drug newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Drug newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Drug query()
 * @method static \Illuminate\Database\Eloquent\Builder|Drug active()
 * @method static \Illuminate\Database\Eloquent\Builder|Drug lowStock()
 * @method static \Illuminate\Database\Eloquent\Builder|Drug expired()
 * @method static \Database\Factories\DrugFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Drug extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'generic_name',
        'brand',
        'category',
        'description',
        'price',
        'stock_quantity',
        'minimum_stock',
        'unit',
        'expiry_date',
        'batch_number',
        'requires_prescription',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'stock_quantity' => 'integer',
        'minimum_stock' => 'integer',
        'expiry_date' => 'date',
        'requires_prescription' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the prescription items for the drug.
     */
    public function prescriptionItems(): HasMany
    {
        return $this->hasMany(PrescriptionItem::class);
    }

    /**
     * Get the sale items for the drug.
     */
    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    /**
     * Scope a query to only include active drugs.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include drugs with low stock.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLowStock($query)
    {
        return $query->whereRaw('stock_quantity <= minimum_stock');
    }

    /**
     * Scope a query to only include expired drugs.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExpired($query)
    {
        return $query->where('expiry_date', '<', now());
    }

    /**
     * Check if the drug has low stock.
     *
     * @return bool
     */
    public function getIsLowStockAttribute(): bool
    {
        return $this->stock_quantity <= $this->minimum_stock;
    }

    /**
     * Check if the drug is expired.
     *
     * @return bool
     */
    public function getIsExpiredAttribute(): bool
    {
        return $this->expiry_date && $this->expiry_date->isPast();
    }
}