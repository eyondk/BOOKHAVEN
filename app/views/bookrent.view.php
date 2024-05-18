<?php require("header.inc.php")?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!--for icons -->
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/bookrent.css">
</head>
<body>

<section class="rent">
    <div class="book-info-container">
        <div class="book-img">
            <?php if (isset($book)): ?>
                <img class="book-cover" src="<?= htmlspecialchars($book['b_book_cover']) ?>" alt="<?= htmlspecialchars($book['b_title']) ?>">
            <?php else: ?>
                <p>Book not found.</p>
            <?php endif; ?>
        </div>
        <div class="button-container">
            <a href="https://www.amazon.com/" class="button rent-now" onclick="toggleRentNow(event)">
                <i class="fas fa-money-check-dollar"></i> Rent Now
            </a>
            <a href="<?= ROOT ?>/home" class="button button-want-to-read">
                Back
            </a>
        </div>
    </div>
    <div class="book-details-container">
        <?php if (isset($book)): ?>
            <div class="bookinfo">
                <h2 class="book-title"><?= htmlspecialchars($book['b_title']) ?></h2>
                <p class="book-author">by <?= htmlspecialchars($book['b_author']) ?></p>
                <p class="genre">Genre: <?= htmlspecialchars($book['b_genre']) ?></p>
                <p class="price" style="color:#666; margin-top: -10px; font-size: 16px;">Price: &#8369;<?= htmlspecialchars($book['b_price']) ?></p>
            </div>
            <div class="book-description">
                <p id="paragraph" class="paragraph">
                    <?= nl2br(htmlspecialchars($book['b_descript'])) ?>
                </p>
                <!-- <button class="readmore-btn" onclick="showMore()">Read more</button>
                <button class="readless-btn" onclick="showLess()" style="display: none;">Read less</button> -->
            </div>
        <?php endif; ?>
    </div>
</section>
<script src="<?=ROOT?>/assets/js/bookrent.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
