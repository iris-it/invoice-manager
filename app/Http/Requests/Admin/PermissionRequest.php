<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Illuminate\Contracts\Auth\Guard;

class PermissionRequest extends Request
{
    /**
     * @var Guard
     */
    private $auth;

    /**
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        $rules = [
            'name' => 'required|max:255|unique:permissions,name,' . $this->id,
            'label' => 'required|max:255',
            'description' => 'required|max:255',
        ];

        return $rules;
    }
}