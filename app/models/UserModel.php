<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model
{
    protected $table = 'users';
    protected $primary_key = 'id';

    public function find_by_identity($identity)
    {
        $user = $this->db
            ->table($this->table)
            ->where('email', $identity)
            ->where('is_active', 1)
            ->get();

        if ($user) {
            return $user;
        }

        return $this->db
            ->table($this->table)
            ->where('username', $identity)
            ->where('is_active', 1)
            ->get();
    }
}
