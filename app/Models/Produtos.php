<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $table ="produtos";
    protected $fillable =['nome', 'foto', 'descricao', 'valor', 'categorias_id'];
}
