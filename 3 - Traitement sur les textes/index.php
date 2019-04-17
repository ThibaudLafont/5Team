<!-- PHP logic: split a text document by space -->
<?php
    // Get content of article file
    $article = file_get_contents('article.txt');

    // Replace punctuation [. , ; : ! ? ( ) - _ "] and line breaks by whitespaces
    // Explode string by whitespaces characters
    // $words may contain empty entries (preg_replace could return several followed whitespaces), so apply array_filter to remove them
    $words = array_filter(
        explode(' ', preg_replace('/[.,;:!?\(\)\-\_"\n\r]/', ' ', $article))
    );
?>

<!-- Render the result -->
<html>
<head>
    <style>
        section {
            width: 50%;
            float: left;
            padding: 1rem;
            box-sizing: border-box
        }
    </style>
</head>
<body>

    <h1>Text treatment</h1>

    <!-- Echo the file_get_content for info (no layout work) -->
    <section>
        <h2>Article</h2>
        <p><?= $article ?></p>
    </section>

    <!-- Display every word of article in a paragraph -->
    <section>
        <h2>Words of article (<?=count($words)?>)</h2>
        <?php foreach ($words as $i=>$word) {
            echo '<p>' . ($i+1) . ": {$word}</p>";
        } ?>
    </section>

</body>
</html>