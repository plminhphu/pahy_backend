<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id','device_code','model','install_date','status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function maintenanceReminders()
    {
        return $this->hasMany(MaintenanceReminder::class);
    }
}
