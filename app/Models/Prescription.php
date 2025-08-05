<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Prescription
 *
 * @property int $id
 * @property string $prescription_number
 * @property int $customer_id
 * @property string $doctor_name
 * @property string|null $doctor_license
 * @property \Illuminate\Support\Carbon $prescription_date
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrescriptionItem> $prescriptionItems
 * @property-read \App\Models\Sale|null $sale
 * @property-read bool $is_fully_filled
 * @property-read float $total_amount
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription query()
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription pending()

 * 
 * @mixin \Eloquent
 */
class Prescription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'prescription_number',
        'customer_id',
        'doctor_name',
        'doctor_license',
        'prescription_date',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'customer_id' => 'integer',
        'prescription_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the customer that owns the prescription.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the prescription items for the prescription.
     */
    public function prescriptionItems(): HasMany
    {
        return $this->hasMany(PrescriptionItem::class);
    }

    /**
     * Get the sale for the prescription.
     */
    public function sale(): HasOne
    {
        return $this->hasOne(Sale::class);
    }

    /**
     * Scope a query to only include pending prescriptions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Check if the prescription is fully filled.
     *
     * @return bool
     */
    public function getIsFullyFilledAttribute(): bool
    {
        return $this->prescriptionItems->every(function ($item) {
            return $item->quantity_dispensed >= $item->quantity_prescribed;
        });
    }

    /**
     * Get the total amount for the prescription.
     *
     * @return float
     */
    public function getTotalAmountAttribute(): float
    {
        return $this->prescriptionItems->sum(function ($item) {
            return $item->drug->price * $item->quantity_prescribed;
        });
    }
}