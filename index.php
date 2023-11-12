<?php

// Include necessary files
require_once 'Controllers/UrlGeneratorController.php';
require_once 'DTO/RandomConfigDTO.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the URL from the form submission
    $baseUrl = $_POST['url'];

    // Create a new RandomConfigDTO with default values
    $randomConfig = new RandomConfigDTO();

    // Create an instance of the UrlGeneratorController
    $controller = new UrlGeneratorController($baseUrl, $randomConfig);

    // Generate the URL with random parameters
    $resultUrl = $controller->generateUrl();
}

// Include the template
require_once 'Templates/url_generator.tpl.php';