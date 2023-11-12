# URL Generator

## Description

URL Generator is a simple PHP application that takes a URL with query parameters and generates a new URL by adding random parameters to it. Original parameters will not be overriten. It allows you to customize the generation of random parameters using a configuration file.

## Table of Contents

- [Features](#features)
- [Usage](#usage)
- [File Structure](#file-structure)
- [Configuration](#configuration)

## Features

- Generate a URL with random parameters.
- Customize the random parameter generation with a configuration file.
  
## Usage

1. Enter the URL with query parameters in the input field.
2. Click the "Generate" button to create a new URL with original + random parameters.
3. View the generated URL on the page.

## File Structure

- `Controllers/`: Contains PHP controller files.
- `DTO/`: Contains Data Transfer Object (DTO) files.
- `Models/`: Contains PHP model files.
- `Templates/`: Contains HTML teplate files.
- `index.php`: Main entry point of the application.

## Configuration

To customize the random parameter generation, modify the `RandomConfigDTO` class in `DTO/RandomConfigDTO.php`.
