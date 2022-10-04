<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class UserModels extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'm_user';
    protected $guard = '*';
}