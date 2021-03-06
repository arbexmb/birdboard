<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class ProjectInvitationRequest extends FormRequest
{
    protected $errorBag = 'invitations';

    public function authorize()
    {
        return Gate::allows('administer', $this->route('project'));
    }

    public function rules()
    {
        return [
            'email' => ['required', 'exists:users,email']
        ];
    }

    public function messages()
    {
        return ['email.exists' => 'The user you are inviting must have a Birdboard account.'];
    }
}
