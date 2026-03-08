<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int                             $id
 * @property string                          $nom
 * @property string                          $email
 * @property string|null                     $telephone
 * @property string|null                     $entreprise
 * @property \Illuminate\Support\Carbon      $created_at
 * @property \Illuminate\Support\Carbon      $updated_at
 */
class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;

    protected $fillable = ['nom', 'email', 'telephone', 'entreprise'];

    // --- ACCESSOR: initials for avatar display ---
    public function getInitialesAttribute(): string
    {
        $words = explode(' ', trim($this->nom));
        return strtoupper(implode('', array_map(fn($w) => $w[0] ?? '', array_slice($words, 0, 2))));
    }

    // --- SCOPE: search by nom, email, or entreprise ---
    public function scopeSearch($query, string $term)
    {
        return $query->where('nom', 'like', "%{$term}%")
                     ->orWhere('email', 'like', "%{$term}%")
                     ->orWhere('entreprise', 'like', "%{$term}%");
    }
}
