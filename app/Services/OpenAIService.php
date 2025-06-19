<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    public function generateItineraryActivities($location, $date)
    {
        $prompt = "Generate a list of specific activities for a visit to {$location} on {$date}. 
                   It should be a one-day itinerary with time slots and fun or cultural activities.";

        $response = Http::withToken(config('services.openai.key'))
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a travel assistant.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => 0.7,
            ]);

        return $response['choices'][0]['message']['content'] ?? null;
    }
}
