<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'device_id',
        'device_code',
        'device_name',
        'device_model',
        'device_price',
        'device_info',
        'device_imei',
        'created_at',
        'updated_at'
    ];
}