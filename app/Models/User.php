<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Les champs qu'on peut remplir automatiquement.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Les champs cachés quand on affiche un utilisateur.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les conversions automatiques.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Vérifie si l'utilisateur est admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Vérifie si l'utilisateur est agent.
     */
    public function isAgent(): bool
    {
        return $this->role === 'agent';
    }

    /**
     * Vérifie si l'utilisateur est client.
     */
    public function isClient(): bool
    {
        return $this->role === 'client';
    }

    /**
     * Les biens immobiliers gérés par un agent.
     */
    public function properties()
    {
        return $this->hasMany(Property::class, 'agent_id');
    }

    /**
     * Les visites du client.
     */
    public function clientVisits()
    {
        return $this->hasMany(Visit::class, 'client_id');
    }

    /**
     * Les visites gérées par l'agent.
     */
    public function agentVisits()
    {
        return $this->hasMany(Visit::class, 'agent_id');
    }

    /**
     * Les transactions du client.
     */
    public function clientTransactions()
    {
        return $this->hasMany(Transaction::class, 'client_id');
    }

    /**
     * Les transactions gérées par l'agent.
     */
    public function agentTransactions()
    {
        return $this->hasMany(Transaction::class, 'agent_id');
    }
}