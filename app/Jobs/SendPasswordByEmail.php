<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendPasswordByEmail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $user;

    /**
     * Create a new job instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->user;

        $password = str_random(10);

        $user->update(['password' => bcrypt($password)]);

        Mail::send('emails.password-reset', ['name' => $user->name, 'email' => $user->email, 'password' => $password, 'url' => url('/')], function ($message) use ($user) {
            $message->to($user->email, $user->name);
            $message->subject('Identifiants de connexion');

            $swiftMessage = $message->getSwiftMessage();
            $headers = $swiftMessage->getHeaders();
            $headers->addIdHeader('Message-ID', time() . '.' . uniqid() . env('MAIL_USERNAME'));
            $headers->addTextHeader('MIME-Version', '1.0');
            $headers->addTextHeader('X-Mailer', 'PHP v' . phpversion());
            $headers->addParameterizedHeader('Content-type', 'text/html', ['charset' => 'utf-8']);
        });
    }
}
