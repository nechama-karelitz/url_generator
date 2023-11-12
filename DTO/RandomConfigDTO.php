<?php

/**
 * Data Transfer Object (DTO) for holding configuration parameters for generating random parameters.
 */
class RandomConfigDTO {
    // Attribute constants for array keys
    const ATTR_KEY_CHARACTERS = 'keyCharacters';
    const ATTR_KEY_MIN_LENGTH = 'keyMinLength';
    const ATTR_KEY_MAX_LENGTH = 'keyMaxLength';
    const ATTR_KEY_MAX_ATTEMPTS = 'keyMaxAttempts';
    const ATTR_VALUE_CHARACTERS = 'valueCharacters';
    const ATTR_VALUE_LENGTH = 'valueLength';
    const ATTR_PARAMS_MIN_AMOUNT = 'paramsMinAmount';
    const ATTR_PARAMS_MAX_AMOUNT = 'paramsMaxAmount';

    // Default values for configuration parameters
    private string $keyCharacters;
    private int $keyMinLength = 1;
    private int $keyMaxLength = 1;
    private int $keyMaxAttempts;
    private string $valueCharacters;
    private int $valueLength;
    private int $paramsMinAmount = 5;
    private int $paramsMaxAmount = 15;

    /**
     * RandomConfigDTO constructor.
     *
     * @param array $attributes - An array of attributes to initialize the DTO.
     */
    public function __construct(array $attributes = []) {
        // Initialize key characters with default or provided value
        $this->keyCharacters = $attributes[self::ATTR_KEY_CHARACTERS] ?? 'abcdefghijklmnopqrstuvwxyz';

        // Initialize value characters with default or provided value
        $this->valueCharacters = $attributes[self::ATTR_VALUE_CHARACTERS] ?? 'abcdefghijklmnopqrstuvwxyz1234567890';

        // Initialize value length with default or provided value
        $this->valueLength = intval($attributes[self::ATTR_VALUE_LENGTH] ?? 0) > 0 ? intval($attributes[self::ATTR_VALUE_LENGTH]) : 8;

        // Initialize key max attempts with default or provided value
        $this->keyMaxAttempts = intval($attributes[self::ATTR_KEY_MAX_ATTEMPTS] ?? 0) > 0 ? intval($attributes[self::ATTR_KEY_MAX_ATTEMPTS]) : 5;

        // Validate and initialize key length range
        if (
            intval($attributes[self::ATTR_KEY_MIN_LENGTH] ?? 0) > 0 &&
            intval($attributes[self::ATTR_KEY_MAX_LENGTH] ?? 0) > 0 &&
            intval($attributes[self::ATTR_KEY_MIN_LENGTH]) <= intval($attributes[self::ATTR_KEY_MAX_LENGTH])
        ) {
            $this->keyMinLength = intval($attributes[self::ATTR_KEY_MIN_LENGTH]);
            $this->keyMaxLength = intval($attributes[self::ATTR_KEY_MAX_LENGTH]);
        }

        // Validate and initialize parameters amount range
        if (
            intval($attributes[self::ATTR_PARAMS_MIN_AMOUNT] ?? 0) > 0 &&
            intval($attributes[self::ATTR_PARAMS_MAX_AMOUNT] ?? 0) > 0 &&
            intval($attributes[self::ATTR_PARAMS_MIN_AMOUNT]) <= intval($attributes[self::ATTR_PARAMS_MAX_AMOUNT])
        ) {
            $this->paramsMinAmount = intval($attributes[self::ATTR_PARAMS_MIN_AMOUNT]);
            $this->paramsMaxAmount = intval($attributes[self::ATTR_PARAMS_MAX_AMOUNT]);
        }
    }

    /**
     * Get the characters that can be used for generating random parameter keys.
     *
     * @return string The characters for keys.
     */
    public function getKeyCharacters(): string {
        return $this->keyCharacters;
    }

    /**
     * Get the minimum length allowed for random parameter keys.
     *
     * @return int The minimum key length.
     */
    public function getKeyMinLength(): int {
        return $this->keyMinLength;
    }

    /**
     * Get the maximum length allowed for random parameter keys.
     *
     * @return int The maximum key length.
     */
    public function getKeyMaxLength(): int {
        return $this->keyMaxLength;
    }

    /**
     * Get the maximum number of attempts to generate a unique random parameter key.
     *
     * @return int The maximum attempts for key generation.
     */
    public function getKeyMaxAttempts(): int {
        return $this->keyMaxAttempts;
    }

    /**
     * Get the characters that can be used for generating random parameter values.
     *
     * @return string The characters for values.
     */
    public function getValueCharacters(): string {
        return $this->valueCharacters;
    }

    /**
     * Get the length of random parameter values.
     *
     * @return int The length of values.
     */
    public function getValueLength(): int {
        return $this->valueLength;
    }

    /**
     * Get the minimum number of random parameters to generate.
     *
     * @return int The minimum number of parameters.
     */
    public function getParamsMinAmount(): int {
        return $this->paramsMinAmount;
    }

    /**
     * Get the maximum number of random parameters to generate.
     *
     * @return int The maximum number of parameters.
     */
    public function getParamsMaxAmount(): int {
        return $this->paramsMaxAmount;
    }
}