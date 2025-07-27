<?php
namespace App\Mail;

use App\Models\Project;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $project;

    public function __construct(User $user, Project $project)
    {
        $this->user = $user;
        $this->project = $project;
    }

    public function build()
    {
        return $this->markdown('emails.project_created')
            ->with([
                'userName' => $this->user->name,
                'projectName' => $this->project->name,
                'projectUrl' => url('/projects/'.$this->project->id)
            ]);
    }
}
