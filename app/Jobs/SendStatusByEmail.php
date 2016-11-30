<?php

namespace App\Jobs;

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

    private $status;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param Vault $vault
     */
    public function __construct(User $user, Vault $vault, $status)
    {
        $this->user = $user;
        $this->vault = $vault;
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
        $link = action('VaultController@show', $vault->id);

        Mail::send('emails.vault-hasvalidate', ['owner' => $owner->name, 'user' => $user->name, 'status' => $status, 'vault' => $vault, 'link' => $link], function ($message) use ($owner) {
            $message->to($owner->email, $owner->name);
            $message->subject('Invitation');
        });
    }
}
