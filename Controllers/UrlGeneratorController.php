<?php

// Include necessary files
require_once 'Models/UrlGeneratorModel.php';
require_once 'DTO/RandomConfigDTO.php';

/**
 * Controller responsible for generating URLs with random parameters.
 */
class UrlGeneratorController {
    /**
     * @var UrlGeneratorModel $urlParametersGenerator - The model responsible for generating URLs.
     */
    private UrlGeneratorModel $urlParametersGenerator;

    /**
     * UrlGeneratorController constructor.
     *
     * @param string $url - The original full URL
     * @param RandomConfigDTO $randomConfig - Configuration for generating random parameters.
     */
    public function __construct(string $url, RandomConfigDTO $randomConfig) {
        // Initialize the UrlGeneratorModel with the provided URL and configuration
        $this->urlParametersGenerator = new UrlGeneratorModel($url, $randomConfig);
    }

    /**
     * Generate a URL with a combination of random parameters and original parameters.
     *
     * This method delegates the URL generation process to the associated UrlGeneratorModel.
     *
     * @return string The generated URL.
     */
    public function generateUrl(): string {
        // Delegate the URL generation to the associated UrlGeneratorModel
        return $this->urlParametersGenerator->generateUrl();
    }
}