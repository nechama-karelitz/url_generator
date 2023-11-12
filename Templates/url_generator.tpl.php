<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Parameters Generator</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <form method="post" action="">
        <div class="mt-5 mb-3">
            <label for="url">URL with parameters:</label>
            <!-- Input field for entering the URL -->
            <input type="text" id="url" name="url" required class="form-control">
        </div>

        <div class="mb-4">
            <!-- Submit button for generating the URL -->
            <button type="submit" class="btn btn-primary">Generate</button>
        </div>
    </form>

    <?php if (isset($resultUrl)) { ?>
        <!-- Display the generated URL if available -->
        <p>Generated URL: <?=$resultUrl?></p>
    <?php } ?>
</div>
</body>
</html>