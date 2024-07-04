<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable implements JWTSubject, CanResetPassword
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'prenom', 'tel', 'email', 'password', 'image', 'role_id', 'agence_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Override the mail body for reset password notification mail.
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\MailResetPasswordNotification($token, $this->email));
    }

    public function professeur()
    {
        return $this->hasOne('App\Professeur', 'user_id');
    }

    public function entreprise()
    {
        return $this->belongsTo('App\Entreprise', 'entreprise_id');
    }

    public function ville()
    {
        return $this->belongsTo('App\Ville', 'ville_id');
    }

    public function banque()
    {
        return $this->belongsTo('App\Banque', 'banque_id');
    }

    public function pays()
    {
        return $this->belongsTo('App\Pays', 'pays_id');
    }

    public function getImage()
    {
        if (!$this->image)
            return 'https://image.flaticon.com/icons/png/512/149/149071.png';
        return asset('/storage/avatars/' . $this->image);
    }

    public function getNomComplet()
    {
        return $this->nom . ' ' . $this->prenom;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function sendPush($title, $details, $token)
    {

        $data = [
            "to" => $token,
            "notification" =>
            [
                "title" => $title,
                "body" => $details,
                'sound' => 'mySound',
                //"icon" => 'https://toppng.com/uploads/preview/ew-instagram-logo-transparent-related-keywords-logo-instagram-vector-2017-115629178687gobkrzwak.png'
                //"icon" => asset('/storage/logo.png')
            ],
            //'dry_run' => true,
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . config('app.firebase_server_key'),
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        return curl_exec($ch);

        //return redirect('/home')->with('message', 'Notification sent!');
    }
}
