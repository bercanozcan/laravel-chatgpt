<?php

/*
 * You can place the Laravel ChatGPT configuration in here.
 * This configuration file will be published to config/chatgpt.php
 * You can override the default configuration values here.
 * Please note that the API key should be set in the .env file.
 */

return [
    'api_key' => env('OPENAI_API_KEY'),
    'default_model' => 'text-davinci-003', // Default model
    'default_temperature' => 0.7, // Default temperature
    'default_max_tokens' => 150, // Default max tokens
];