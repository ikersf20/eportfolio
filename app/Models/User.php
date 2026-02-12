<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
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

    protected $appends = ['roles'];

    public function getRolesAttribute(){
        $roles = [];
        if($this->esAdministrador()){
            $roles[] = 'administrador';
        }
        if($this->esDocente()){
            $roles[] = 'docente';
        }
        if($this->esEstudiante()){
            $roles[] = 'estudiante';
        }
        return $roles;
    }



    public function esAdministrador(): bool
    {
        if ($this) {
            return $this->email === env('ADMIN_EMAIL');

        }else{
            return true;
        }

    }

    public function evidencias(){
        return $this->hasMany(Evidencia::class, 'estudiante_id');
    }

    public function modulosImpartidos(){
        return $this-> hasMany(ModuloFormativo::class, 'docente_id');
    }

    public function esDocente(){
        return $this->modulosImpartidos()->exists();
    }

    public function esDocenteModulo(ModuloFormativo $modulo){
        return $this->id == $modulo->docente_id;
    }

    public function modulosMatriculados(){
        return $this->belongsToMany(ModuloFormativo::class, 'matriculas', 'estudiante_id', 'modulo_formativo_id');
    }

    public function esEstudiante(){
        return $this->modulosMatriculados()->exists();
    }

    public function esEstudianteModulo(ModuloFormativo $modulo){
        return $this->modulosMatriculados->contains($modulo->id);
    }

}
