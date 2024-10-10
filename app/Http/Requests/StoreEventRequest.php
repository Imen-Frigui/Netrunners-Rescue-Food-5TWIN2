<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'description' => 'nullable|string|max:1000',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date|after:now',
            'max_participants' => 'nullable|integer|min:1',
            'restaurant_id' => 'nullable|exists:restaurants,id',
            'charity_id' => 'nullable|exists:charities,id',
            'published_at' => 'nullable|date',
        ];
    }

     /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The event name is required.',
            'name.string' => 'The event name must be a string.',
            'name.max' => 'The event name must not exceed 255 characters.',
            
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description must not exceed 1000 characters.',
            
            'location.required' => 'The event location is required.',
            'location.string' => 'The event location must be a string.',
            'location.max' => 'The event location must not exceed 255 characters.',
            
            'event_date.required' => 'The event date is required.',
            'event_date.date' => 'The event date must be a valid date.',
            'event_date.after' => 'The event date must be a future date.',
            
            'max_participants.integer' => 'The maximum number of participants must be an integer.',
            'max_participants.min' => 'The maximum number of participants must be at least 1.',
            
            'restaurant_id.exists' => 'The selected restaurant is invalid.',
            'charity_id.exists' => 'The selected charity is invalid.',
        ];
    }
}
