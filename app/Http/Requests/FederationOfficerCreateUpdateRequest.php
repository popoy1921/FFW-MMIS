<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class FederationOfficerCreateUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $oUser = User::firstwhere('guid', $this->input('guid'));
        $sSuffixUserId = '';
        if ($oUser) {
            $sSuffixUserId .= ',' . $oUser->id;
        }
        return [
            'name'           => ['required', 'regex:/^[\p{L}\'\s-]+$/u', 'max:50'],
            'position_id'    => ['required'],
            'federation_id'  => ['required'],
            'local_union_id' => ['required'],
            'gender_id'      => ['required'],
            'age'            => ['required'],
        ];
    }

    public function messages()
    {
        $sNameError = 'Enter a valid name with only letters, hyphens, apostrophes, spaces, and up to 50 characters.';
        return [
            'name.regex' => $sNameError,
            'name.max' => $sNameError,
        ];
    }
}
