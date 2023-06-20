<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    use HasFactory;

    public function mechanicAutoservice()
    {
        return $this->belongsTo(Autoservice::class, 'autoservice_id', 'id');
    }

    public function deletePhoto()
    {
        $fileName = $this->photo;
        if (file_exists(public_path().$fileName)) {
            unlink(public_path().$fileName);
        }
        $this->photo = null;
        $this->save();
    }

    //вставка ниже касается рейтинга:
    protected $fillable = [
        'rating',
    ];
    //конец вставки
}