<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class RemoveOldTokens implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user_key;
    protected $date;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_key, $date)
    {
        $this->user_key = $user_key;
        $this->date = $date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $deleted = User::find($this->user_key)
            ->tokens()
            ->where('created_at', '<', $this->date)
            ->delete();

        info("User $this->user_key has too much sessions. $deleted sessions deleted.");
    }
}
