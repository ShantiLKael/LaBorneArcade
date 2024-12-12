<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;
use DateTime;

/**
 * @property int      id
 * @property string   email
 * @property string   mdp
 * @property string   role
 * @property string   token_mdp
 * @property DateTime date_creation_token
 */
class Utilisateur extends Entity
{
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

    public function setEmail(string $email): static
    {
        $this->attributes['email'] = $email;
        return $this;
    }

    public function setMdp(string $mdp): static
    {
        $this->attributes['mdp'] = password_hash($mdp, PASSWORD_DEFAULT);
        return $this;
    }

    public function setRole(string $role): static
    {
        $this->attributes['role'] = $role;
        return $this;
    }

    public function setTokenMdp(string $token): static
    {
        $this->attributes['token_mdp'] = $token;
        return $this;
    }

    public function setCreationTokenMdp(Time $time): static
    {
        $this->attributes['date_creation_token'] = $time;
        return $this;
    }
	
}
