<?php 

namespace App\Models;

use CodeIgniter\Model;

class Formvalid extends Model
{
  protected $table = 'users';
  protected $primaryKey = 'id';
  protected $allowedFields = ['username', 'password'];

  public function getUser($uname)
  {
    return $this->where(['username' => $uname])->first();
  }
}

?>