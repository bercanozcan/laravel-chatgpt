<?php

namespace Bercan\ChatGPT;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class ChatGPT
{
    /**
     * OpenAI API Base URL.
     */
    const BASE_URL = 'https://api.openai.com';

    /**
     * The OpenAI API key.
     *
     * @var string
     */
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.chatgpt.api_key');
    }

    /**
     * Generate a response from ChatGPT.
     *
     * @param string $prompt The prompt to feed into ChatGPT
     * @param int $maxTokens The maximum number of tokens to generate in the response
     * @param array $parameters Additional parameters for the completion (Optional)
     * @return string The generated response from ChatGPT
     */
    public function talk($prompt, $maxTokens, $parameters = [])
    {
        $defaultParameters = [
            'model' => config('chatgpt.default_model'),
            'temperature' => config('chatgpt.default_temperature'),
            'max_tokens' => config('chatgpt.default_max_tokens'),
            'prompt' => $prompt,
        ];

        $parameters = array_merge($defaultParameters, $parameters);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post(self::BASE_URL . '/v1/completions', $parameters);

        $responseData = json_decode($response->body(), true);

        return $responseData['choices'][0]['text'];
    }
}