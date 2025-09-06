<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'customer_id',
        'customer_code',
        'customer_name',
        'customer_phone',
        'customer_address',
        'customer_region',
        'device_id',
        'device_code',
        'device_name',
        'device_model',
        'device_price',
        'device_info',
        'device_imei',
        'appointment_date', //2025-09-04T20:49
        'reminder_cycle',
        'note',
        'status',
        'created_at',
        'updated_at'
    ];
}
