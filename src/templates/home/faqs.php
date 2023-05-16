<!DOCTYPE html>
<html>

<head>
    <title>FAQS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/positioning.css">
</head>

<body class="with-aside">


    <?php $currentPage = 'faqs'; ?>
    <?php require(__DIR__.'/../common/header.php'); ?>
    <div class="wrapper">
        <?php require(__DIR__.'/../common/sidebar.php'); ?>

        
        <div class="container w_aside">
        <h1>Frequently Asked Questions</h1>
            <?php
            require_once(__DIR__.'/../../database/faqs.php');
            // Get the faqs data from the database
            $faqs = get_faqs();
            // Loop through the faqs and display the question and answer
            foreach ($faqs as $faq) {
                echo '<div class="faq-item">';
                echo '<h2 class="faq-title" id="' . $faq['id'] . '">' . $faq['question'] . '</h2>';
                echo '<div class="answer-container">';
                echo '<p class="faq-answer">' . $faq['answer'] . '</p>';
                echo '</div>';
                if($_SESSION['user_type'] === 'admin') {
                    echo '<button class="delete-button" data-id="' . $faq['id'] . '">Delete</button>';
                }
                echo '</div>';
            }
            
            ?>
            <?php if($_SESSION['user_type'] === 'admin') { ?>
            <h2>Submit a question</h2>
            <form id="submit_faq" action="../actions/action_submit_faq.php" method="post" required>
                <textarea id="question" name="question" form="submit_faq" placeholder="Question" rows="4" cols="20"
                    required></textarea>
                <textarea id="answer" name="answer" form="submit_faq" placeholder="Answer" rows="4" cols="20"
                    required></textarea>
                <button type="submit" value="Next">Submit</button>
            </form>
            <?php } ?>
        </main>
    </div>

    <script src="/scripts/script.js"></script>
</body>

</html>


