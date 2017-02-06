<?php 
    
    require_once 'app/init.php';
    
    // All articles
    $query = $db->query("
        SELECT articles.id, articles.title, AVG(articles_ratings.rating) AS rating
        FROM articles
        LEFT JOIN articles_ratings
        ON articles.id = articles_ratings.article
        GROUP BY articles.id
    ");

    $articles = [];

    while($row = $query->fetch_object()) {
        $articles[] = $row;
    }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Articles</title>
    </head>
    <body>
        <?php foreach($articles as $article): ?>
            <div class="article">
                <h3><a href="article.php?id=<?php echo $article->id; ?>"><?php echo $article->title; ?></a></h3>
                <div class="article-rating">Rating: <?php echo round($article->rating); ?>/5 </div>
            </div>
        <?php endforeach; ?>
    </body>
</html>