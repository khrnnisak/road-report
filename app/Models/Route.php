<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $table = 'routes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'panjang',
        'ketinggianAwal',
        'ketinggianAkhir',
        'kategori',
        'foto',
    ];

    public function user()
	{
		return $this->belongsTo(User::class);
	} 
    public function category()
	{
		return $this->belongsTo(Category::class);
	} 
}
