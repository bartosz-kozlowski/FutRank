<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HuggingFaceService
{
    protected string $apiUrl = 'https://api-inference.huggingface.co/models/cardiffnlp/twitter-xlm-roberta-base-sentiment';

    public function analyzeSentiment(string $comment): string
    {
        $response = Http::withToken(config('services.huggingface.token'))
            ->withHeaders(['Accept' => 'application/json'])
            ->post($this->apiUrl, ['inputs' => $comment]);

        $result = $response->json();

        if (isset($result['error'])) {
            return '❌ Błąd AI: ' . $result['error'];
        }

        $label = $result[0][0]['label'] ?? 'unknown';

        return match ($label) {
            'positive' => '😊 Pozytywny',
            'neutral' => '😐 Neutralny',
            'negative' => '😠 Negatywny',
            default => '❓ Nieznany ton (' . $label . ')'
        };
    }
}
