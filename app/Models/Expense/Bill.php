<?php

namespace App\Models\Expense;

use App\Models\Model;
use App\Traits\Currencies;
use App\Traits\DateTime;
use App\Traits\Media;
use App\Traits\Recurring;
use Bkwld\Cloner\Cloneable;
use Sofa\Eloquence\Eloquence;
use Date;

class Bill extends Model
{
    use Cloneable, Currencies, DateTime, Eloquence, Media, Recurring;

    protected $table = 'bills';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['attachment', 'discount'];

    protected $dates = ['deleted_at', 'billed_at', 'due_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'bill_number', 'order_number', 'bill_status_code', 'billed_at', 'due_at', 'amount', 'currency_code', 'currency_rate', 'vendor_id', 'vendor_name', 'vendor_email', 'vendor_tax_number', 'vendor_phone', 'vendor_address', 'notes', 'category_id', 'parent_id'];

    /**
     * Sortable columns.
     *
     * @var array
     */
    public $sortable = ['bill_number', 'vendor_name', 'amount', 'status.name', 'billed_at', 'due_at', 'bill_status_code'];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchableColumns = [
        'bill_number'    => 10,
        'order_number'   => 10,
        'vendor_name'    => 10,
        'vendor_email'   => 5,
        'vendor_phone'   => 2,
        'vendor_address' => 1,
        'notes'          => 2,
    ];

    /**
     * Clonable relationships.
     *
     * @var array
     */
    public $cloneable_relations = ['items', 'recurring', 'totals'];

    public function category()
    {
        return $this->belongsTo('App\Models\Setting\Category');
    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Setting\Currency', 'currency_code', 'code');
    }

    public function histories()
    {
        return $this->hasMany('App\Models\Expense\BillHistory');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Expense\BillItem');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Expense\BillPayment');
    }

    public function recurring()
    {
        return $this->morphOne('App\Models\Common\Recurring', 'recurable');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Expense\BillStatus', 'bill_status_code', 'code');
    }

    public function totals()
    {
        return $this->hasMany('App\Models\Expense\BillTotal');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\Expense\Vendor');
    }

    public function scopeDue($query, $date)
    {
        return $query->where('due_at', '=', $date);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('paid_at', 'desc');
    }

    public function scopeAccrued($query)
    {
        return $query->where('bill_status_code', '<>', 'draft');
    }

    public function scopePaid($query)
    {
        return $query->where('bill_status_code', '=', 'paid');
    }

    public function scopeNotPaid($query)
    {
        return $query->where('bill_status_code', '<>', 'paid');
    }

    public function onCloning($src, $child = null)
    {
        $this->bill_status_code = 'draft';
    }

    /**
     * Convert amount to double.
     *
     * @param  string  $value
     * @return void
     */
    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = (double) money($value, $this->attributes['currency_code'])->getAmount();
    }

    /**
     * Convert currency rate to double.
     *
     * @param  string  $value
     * @return void
     */
    public function setCurrencyRateAttribute($value)
    {
        $this->attributes['currency_rate'] = (double) $value;
    }

    /**
     * Convert billed_at to datetime.
     *
     * @param  string  $value
     * @return void
     */
    public function setBilledAtAttribute($value)
    {
        $this->attributes['billed_at'] = $value . ' ' . Date::now()->format('H:i:s');
    }

    /**
     * Convert due_at to datetime.
     *
     * @param  string  $value
     * @return void
     */
    public function setDueAtAttribute($value)
    {
        $this->attributes['due_at'] = $value . ' ' . Date::now()->format('H:i:s');
    }

    /**
     * Get the current balance.
     *
     * @return string
     */
    public function getAttachmentAttribute($value)
    {
        if (!empty($value) && !$this->hasMedia('attachment')) {
            return $value;
        } elseif (!$this->hasMedia('attachment')) {
            return false;
        }

        return $this->getMedia('attachment')->last();
    }

    /**
     * Get the discount percentage.
     *
     * @return string
     */
    public function getDiscountAttribute()
    {
        $percent = 0;

        $discount = $this->totals()->where('code', 'discount')->value('amount');

        if ($discount) {
            $sub_total = $this->totals()->where('code', 'sub_total')->value('amount');

            $percent = number_format((($discount * 100) / $sub_total), 0);
        }

        return $percent;
    }
}
