<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Rules\Status;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function getstateAttribute()
    {                
        if($this->role == 'peserta')
        {
            $da = Participant::where('users_id',$this->id)->latest()->first();   
            $val = ($da) ? $da->status : 0;
            return Status::state($val,$da->state);
            
        }
        else
        {
            return $this->role;
        }    
    }

    // status siswa
    public function getstatAttribute()
    {                
        if($this->role == 'peserta')
        {
            $da = Participant::where('users_id',$this->id)->latest()->first();
            // $da = Participant::where('users_id',$this->id)->where('status',2)->latest()->first();        
            return ($da) ? $da->status : 0;
        }
        else
        {
            return $this->role;
        }    
    }
    
    public function getlogAttribute()
    {                
        if($this->role == 'peserta')
        {
            // $par = [0,2];
            $da = Participant::where('users_id',$this->id)->latest()->first();
            return (int) $da->status;
        }
        else
        {
            return 0;
        }    
    }

    public function hasRole($role)
    {
        // $role = ['peserta','pengajar','lpk','pegawai','keuangan','admin'];       
        return $this->role === $role;
    }

    public function hasPermission($per)
    {
        if($per == 'payment')
        {
            $par = ['keuangan','admin'];       

            if(in_array($this->role,$par))
            {            
                return true;
            }     

        }

        if($per == 'kelas' || $per == 'apply')
        {
            $par = ['pegawai','admin'];       

            if(in_array($this->role,$par))
            {            
                return true;
            }     

        }
    }

    public function master()
    {
        $master = ['admin'];
        
        if(in_array($this->role,$master))
        {
            return true;
        }        
    }

    public function participant()
    {
        $master = ['peserta'];
        
        if(in_array($this->role,$master))
        {
            return true;
        }        
    }

    public function participants()
    {
        return $this->hasOne(Participant::class, 'users_id', 'id');   
    }

    public function cv()
    {
        return $this->hasOne(CV::class, 'users_id', 'id');   
    }
}
