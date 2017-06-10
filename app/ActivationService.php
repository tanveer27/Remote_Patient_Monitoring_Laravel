<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 9/17/2016
 * Time: 9:02 PM
 */

namespace App;

use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use App\Patient;
use App\Doctor;
use App\User;

class ActivationService
{

    protected $mailer;

    protected $activationRepo;

    protected $resendAfter = 24;

    public function __construct(Mailer $mailer, ActivationRepository $activationRepo)
    {
        $this->mailer = $mailer;
        $this->activationRepo = $activationRepo;
    }

    public function sendActivationMail($user)
    {

        if ($user->activated || !$this->shouldSend($user)) {
            return;
        }

        $token = $this->activationRepo->createActivation($user);

        $link = route('user.activate', $token);
        $message = sprintf('Activate account <a href="%s">%s</a>', $link, $link);

        $this->mailer->raw($message, function (Message $m) use ($user) {
            $m->to($user->email)->subject('Activation mail');
        });


    }
     public function sendActivationMailDoctor($user)
    {

        if ($user->activated || !$this->shouldSend($user)) {
            return;
        }

        $token = $this->activationRepo->createActivation($user);

        $link = route('user.activate', $token);
        $message = sprintf('Activate account <a href="%s">%s</a>', $link, $link);

        $this->mailer->raw($message, function (Message $m) use ($user) {
            $m->to('monirkhan.qmul@gmail.com')->subject('Activation mail for Doctor'.$user->email);
        });


    }
     public function sendContactUs($name,$email,$comments)
    {

        

        
        $message = $comments;

        $this->mailer->raw($message, function (Message $m) use($name,$email) {
            $m->to('monirkhan.qmul@gmail.com')->subject("Name:".$name. " Email:".$email);
        });
        return;


    }

    public function activateUser($token)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);

        $user->activated = true;

        $user->save();

        $this->activationRepo->deleteActivation($token);
        
        if($user->type=="pat"){
        	 $patient=new Patient();
            $user->patient()->save($patient);
        }
        else{
        	 $doctor=new Doctor();
            $user->doctor()->save($doctor);
        }

        return $user;

    }

    private function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

}