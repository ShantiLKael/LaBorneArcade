<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class Utilisateur extends Entity
{
    static $ROLE_SUPER_ADMIN    = "super_admin";
    static $ROLE_ADMIN          = "admin";
    static $ROLE_UTILISATEUR    = "utilisateur";
    protected $casts = [
        'id'        => 'integer',
        'email'     => 'string',
        'mdp'       => 'string',
        'role'      => 'string',
        'token_mdp' => 'string',
        'date_creation_token' => 'datetime',
    ];

    protected $datamap = [
        'id'                => 'id_utilisateur',
        'dateCreationToken' => 'date_creation_token',
        'tokenMdp'          => 'token_mdp',
    ];

    public function setEmail(string $email)
    {
        $this->attributes['email'] = $email;
        return $this;
    }

    public function setMdp(string $mdp)
    {
        $this->attributes['mdp'] = password_hash($mdp, PASSWORD_DEFAULT);
        return $this;
    }

    public function setRole(string $role)
    {
        $this->attributes['role'] = $role;
        return $this;
    }

    public function setTokenMdp(string $token)
    {
        $this->attributes['token_mdp'] = $token;
        return $this;
    }

    public function setCreationTokenMdp(Time $time)
    {
        $this->attributes['date_creation_token'] = $time;
        return $this;
    }
}
