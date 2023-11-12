<?php

require_once 'DTO/RandomConfigDTO.php';

/**
 * Represents a model for generating URLs with random parameters.
 */
class UrlGeneratorModel {
    /**
     * @var string $baseUrl - The original URL without query parameters.
     */
    private string $baseUrl;

    /**
     * @var array $parameters - The query parameters as a key-value array, keys are lower-cased.
     */
    private array $parameters = [];

    /**
     * @var RandomConfigDTO $randomConfig - Configuration for random parameters.
     */
    private RandomConfigDTO $randomConfig;

    /**
     * UrlGeneratorModel constructor.
     *
     * @param string $fullUrl - The original full URL.
     * @param RandomConfigDTO $randomConfig - Configuration for generating random parameters.
     */
    public function __construct(string $fullUrl, RandomConfigDTO $randomConfig) {
        $this->randomConfig = $randomConfig;

        // Get URL without query parameters
        $urlParts = explode("?", $fullUrl);
        $this->baseUrl = $urlParts[0] ?? '';

        // Get query parameters
        $urlParts = parse_url($fullUrl);
        parse_str($urlParts['query'] ?? '', $parameters);

        // Ensure given query parameters are in lowercase
        $this->parameters = array_change_key_case($parameters, CASE_LOWER);
    }

    /**
     * Generate a URL with a combination of random parameters and original parameters.
     *
     * This function generates a URL for a given base URL by combining random parameters
     * with the original parameters provided during the object's initialization.
     *
     * @return string The generated URL.
     */
    public function generateUrl(): string {
        // Combine random parameters with original parameters
        $queryParams = array_merge($this->generateRandomParameters(), $this->parameters);

        // Build query parameters string
        $urlQuery = http_build_query($queryParams);

        // Combine base URL with query parameters
        return $this->baseUrl . "?" . $urlQuery;
    }

    /**
     * Get a random parameter key while avoiding conflicts with existing keys.
     *
     * @param array $currentRandomParams - The current set of random parameters.
     * @return string The random parameter key.
     */
    protected function getRandomParameterKey(array $currentRandomParams): string {
        // Check for key conflict with original parameters
        $attempts = 1;
        $min = $this->randomConfig->getKeyMinLength();
        $max = $this->randomConfig->getKeyMaxLength();
        $characters = $this->randomConfig->getKeyCharacters();
        $maxAttempts = $this->randomConfig->getKeyMaxAttempts();

        do {
            $keyLength = ($min == $max) ? $min : rand($min, $max);
            $key = substr(str_shuffle($characters), 0, $keyLength);
            $attempts++;
        } while (
            (
                array_key_exists($key, $this->parameters) ||
                array_key_exists($key, $currentRandomParams)
            ) && $attempts < $maxAttempts
        );

        if ($attempts === $maxAttempts) {
            $key = ''; // Unable to find a unique key after maximum attempts.
        }
        return $key;
    }

    /**
     * Get a random parameter value based on the configured length and characters.
     *
     * @return string The random parameter value.
     */
    protected function getRandomParameterValue(): string {
        return substr(str_shuffle($this->randomConfig->getValueCharacters()), 0, $this->randomConfig->getValueLength());
    }

    /**
     * Generate a set of random parameters based on the configuration.
     *
     * @return array The generated random parameters.
     */
    private function generateRandomParameters(): array {
        $min = $this->randomConfig->getParamsMinAmount();
        $max = $this->randomConfig->getParamsMaxAmount();
        $paramsAmount = ($min == $max) ? $min : rand($min, $max);
        $randomParams = [];

        for ($i = 0; $i < $paramsAmount; $i++) {
            $key = $this->getRandomParameterKey($randomParams);

            // Break the loop if unable to find a unique key
            if (empty($key)) {
                break;
            }

            $value = $this->getRandomParameterValue();
            $randomParams[$key] = $value;
        }

        return $randomParams;
    }
}