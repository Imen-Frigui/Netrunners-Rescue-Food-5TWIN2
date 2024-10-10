<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'event_date' => 'required|date',
            'max_participants' => 'required|integer|min:1',
            'restaurant_id' => 'exists:restaurants,id',
            'charity_id' => 'exists:charities,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages() // Changed from 'protected' to 'public'
    {
        return [
            'name.required' => 'The event name is required.',
            'name.max' => 'The event name cannot exceed 255 characters.',
            'description.required' => 'Please provide a description for the event.',
            'location.required' => 'The event location is required.',
            'event_date.required' => 'The event date is required.',
            'event_date.after' => 'The event date must be a future date.',
            'max_participants.required' => 'Please specify the maximum number of participants.',
            'max_participants.integer' => 'The number of participants must be a valid integer.',
            'restaurant_id.exists' => 'The selected restaurant is invalid.',
            'charity_id.exists' => 'The selected charity is invalid.',
        ];
    }

}
