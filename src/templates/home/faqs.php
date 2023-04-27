<!DOCTYPE html>
<html>

<head>
    <title>FAQS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/positioning.css">
</head>

<body>
<?php $currentPage = 'faqs'; ?>
<?php require(__DIR__.'/../common/header.php'); ?>
    <div class="wrapper">
        
        <?php require(__DIR__.'/../common/sidebar.php'); ?>
        <main class="container w_aside">
            <?php
            require_once(__DIR__.'/../../database/faqs.php');
            // Get the faqs data from the database
            $faqs = get_faqs();
            // Loop through the faqs and display the question and answer
            foreach ($faqs as $faq) {
                echo '<h2>' . $faq['question'] . '</h2>';
                echo '<p>' . $faq['answer'] . '</p>';
            }
            ?>
        </main>

    </div>

    <script src="/scripts/script.js"></script>
</body>

</html>