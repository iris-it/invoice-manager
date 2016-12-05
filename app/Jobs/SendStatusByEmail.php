<?php

namespace App\Jobs;

use App\Document;
use App\User;
use App\Vault;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendStatusByEmail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $user;

    private $vault;

    private $document;

    private $status;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param Vault $vault
     * @param Document $document
     * @param $status
     */
    public function __construct(User $user, Vault $vault, Document $document, $status)
    {
        $this->user = $user;
        $this->vault = $vault;
        $this->document = $document;
        $this->status = $status;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $owner = $this->vault->owner;
        $user = $this->user;

        $status = $this->status;

        $vault = $this->vault;
        $document = $this->document;

        $link = action('Manager\VaultController@show', $vault->id);

        Mail::send('emails.vault-hasvalidate', ['owner' => $owner, 'user' => $user, 'document' => $document, 'status' => $status, 'vault' => $vault, 'link' => $link], function ($message) use ($owner) {
            $message->to($owner->email, $owner->name);
            $message->subject('Status de validation');

            $swiftMessage = $message->getSwiftMessage();
            $headers = $swiftMessage->getHeaders();

            $message_id = $message->getHeaders()->get('Message-ID');
            $message_id->setId(time() . '.' . uniqid() . env('MAIL_USERNAME'));
            $headers->addTextHeader('X-Mailer', 'PHP v' . phpversion());

        });
    }
}
