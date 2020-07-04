<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
  protected $fillable = [
    'name',
    'default',
    'permissions'
  ];

  public function users()
  {
    return $this->belongsToMany(User::class)->withPivot('user_id');
  }

  /**
  * @method bool
  */
  public function has_permission($permission)
  {
    return $this->permissions & $permission == $permission;
  }

  /**
   * @method generate_roles
   */
  public static function generate_roles()
  {
    $roles = [
      'User' => [true, Permissions::FOLLOWER | Permissions::USER | Permissions::WRITE_POST],
      'Moderator' => [false, Permissions::MODERATOR_COMMENTS | Permissions::MODERATOR_POSTS],
      'Admin' => [false, Permissions::ADMINISTER],
    ];
    foreach ($roles as $role => $permission) {
      static::create([
        'name' => $role,
        'default' => $permission[0],
        'permissions' => $permission[1],
      ]);
    }
  }
}

class Permissions
{
  const USER = 0x01;
  const FOLLOWER = 0x02;
  const WRITE_POST = 0x03;
  const MODERATOR_COMMENTS = 0x17;
  const MODERATOR_POSTS = 0x18;
  const ADMINISTER = 0xff;
}
