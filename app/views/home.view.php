<?php require("header.inc.php")?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/home.css">
</head>
<body>



    <?php if ($is_search): ?>
        <!-- Search Results Section -->
        <section class="cat1">
            <h1 class="category" style="color: aliceblue;">Search Results</h1>
            <div class="book-list">
                <button class="fa fa-angle-left pre-btn"></button>
                <button class="fa fa-angle-right nxt-btn"></button>
                <div class="container">
                    <?php if (!empty($search_results)): ?>
                        <?php foreach ($search_results as $book): ?>
                            <a href="<?=ROOT?>/bookrent?id=<?= htmlspecialchars($book['b_id']) ?>" class="card" data-id="<?= htmlspecialchars($book['b_id']) ?>">
                                <img class="card-img" src="<?= htmlspecialchars($book['b_book_cover']) ?>" alt="<?= htmlspecialchars($book['b_title']) ?>">
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No books found for the search term.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php else: ?>
        
        <!-- Fantasy Section -->
        <section class="cat1">
            <h1 class="category" style="color: aliceblue;">Fantasy</h1>
            <div class="book-list">
                <button class="fa fa-angle-left pre-btn"></button>
                <button class="fa fa-angle-right nxt-btn"></button>
                <div class="container">
                    <?php if ($fantasy_books): ?>
                        <?php foreach ($fantasy_books as $book): ?>
                            <a href="<?=ROOT?>/bookrent?id=<?= htmlspecialchars($book['b_id']) ?>" class="card" data-id="<?= htmlspecialchars($book['b_id']) ?>">
                                <img class="card-img" src="<?= htmlspecialchars($book['b_book_cover']) ?>" alt="<?= htmlspecialchars($book['b_title']) ?>">
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No books found in this genre.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Mystery Section -->
        <section class="cat2">
            <h1 class="category" style="color: aliceblue;">Mystery</h1>
            <div class="book-list">
                <button class="fa fa-angle-left pre-btn"></button>
                <button class="fa fa-angle-right nxt-btn"></button>
                <div class="container">
                    <?php if ($mystery_books): ?>
                        <?php foreach ($mystery_books as $book): ?>
                            <a href="<?=ROOT?>/bookrent?id=<?= htmlspecialchars($book['b_id']) ?>" class="card" data-id="<?= htmlspecialchars($book['b_id']) ?>">
                                <img class="card-img" src="<?= htmlspecialchars($book['b_book_cover']) ?>" alt="<?= htmlspecialchars($book['b_title']) ?>">
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No books found in this genre.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Manga Section -->
        <section class="cat3">
            <h1 class="category" style="color: aliceblue;">Manga</h1>
            <div class="book-list">
                <button class="fa fa-angle-left pre-btn"></button>
                <button class="fa fa-angle-right nxt-btn"></button>
                <div class="container">
                    <?php if ($manga_books): ?>
                        <?php foreach ($manga_books as $book): ?>
                            <a href="<?=ROOT?>/bookrent?id=<?= htmlspecialchars($book['b_id']) ?>" class="card" data-id="<?= htmlspecialchars($book['b_id']) ?>">
                                <img class="card-img" src="<?= htmlspecialchars($book['b_book_cover']) ?>" alt="<?= htmlspecialchars($book['b_title']) ?>">
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No books found in this genre.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <script src="<?=ROOT?>/assets/js/home.js"></script>
</body>
</html>