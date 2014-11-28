<?php 

use Illuminate\Support\Facades\Config;
use Symfony\Component\Process\Exception\InvalidArgumentException;

trait HasRole
{
    public function roles()
    {
        return $this->hasMany('Roles', 'Username', 'Username');
    }

    public function hasRole($name)
    {
        foreach ($this->roles as $role) {
            if ($role->Role == $name && $role->BaseID == $this->BaseID) {
                return true;
            }
        }

        return false;
    }

}
