<?php

namespace App\Http\Requests;

use App\Http\Controllers\EventController;
use App\Http\Requests\Traits\AuthorizationViaController;
use App\Models\Event;
use App\Options\Visibility;
use App\Policies\EventPolicy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * @property ?Event $event
 */
class EventRequest extends FormRequest
{
    /** {@see EventPolicy} in {@see EventController} */
    use AuthorizationViaController;

    protected function prepareForValidation(): void
    {
        $this->merge([
            // Replace whitespace etc. with "-"
            'slug' => isset($this->slug) ? Str::slug($this->slug) : null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('events', 'slug'),
            ],
            'description' => [
                'required',
                'string',
            ],
            'visibility' => [
                'required',
                Visibility::rule(),
            ],
            'started_at' => [
                'nullable',
                'date_format:Y-m-d\TH:i',
            ],
            'finished_at' => [
                'nullable',
                'date_format:Y-m-d\TH:i',
            ],
            'website_url' => [
                'nullable',
                'string',
                'max:255',
            ],
            'location_id' => [
                'required',
                Rule::exists('locations', 'id'),
            ],
            'organization_id' => [
                'sometimes',
                'array',
            ],
            'organization_id.*' => [
                Rule::exists('organizations', 'id'),
            ],
        ];
    }
}