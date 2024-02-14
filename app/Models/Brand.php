<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'Brand';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_brand'];

    public function sepedalistrik(): HasMany
    {
        return $this->hasMany(SepedaListrik::class);
    }
}