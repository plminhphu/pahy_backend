<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'code','name','phone','address','region','product_type','service','sale_date'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function maintenanceReminders()
    {
        return $this->hasMany(MaintenanceReminder::class);
    }
}
