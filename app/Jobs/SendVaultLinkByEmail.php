<?php

namespace App\Jobs;

use App\User;
use App\Vault;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendVaultLinkByEmail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $user;

    private $vault;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param Vault $vault
     */
    public function __construct(User $user, Vault $vault)
    {
        $this->user = $user;
        $this->vault = $vault;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->user;
        $vault = $this->vault;
        $link = action('VaultController@show', $vault->id);

        Mail::send('emails.vault-invitation', ['user' => $user, 'vault' => $vault, 'link' => $link], function ($message) use ($user) {
            $message->to($user->email, $user->name);
            $message->subject('Invitation porte document');

            $swiftMessage = $message->getSwiftMessage();
            $headers = $swiftMessage->getHeaders();

            $message_id = $message->getHeaders()->get('Message-ID');
            $message_id->setId(time() . '.' . uniqid() . env('MAIL_USERNAME'));

            $headers->addTextHeader('MIME-Version', '1.0');
            $headers->addTextHeader('X-Mailer', 'PHP v' . phpversion());
            $headers->addParameterizedHeader('Content-type', 'text/html', ['charset' => 'utf-8']);
        });
    }
}
