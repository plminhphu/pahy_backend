<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'customer_code',
        'customer_name',
        'phone',
        'address',
        'region',
        'product_type',
        'service',
        'appointment_date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
