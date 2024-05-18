<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!--for icons -->
    <link rel="icon" type="image/x-icon" href="<?=ROOT?>/assets/images/bh.png">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/header.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/home.css">
    <title>Search Books</title>

</head>
<body>


<nav class="nav">
  <!-- <div class="search-box">
    <i class="fa-solid fa-magnifying-glass search-icon"></i>   
    <input type="text" placeholder="Search in my library" />
  </div> -->
  <!-- Search Form -->
  <div class="search-box">
        <form action="<?= ROOT ?>/home" method="POST">
            <input type="text" name="search" placeholder="Search for books..." required>
            <button type="submit">Search</button>
        </form>
    </div>
    
  <div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa-solid fa-xmark icon"></i></a>
    <a href="#">Settings</a>
    <a href="signup.html">Account</a>
  </div>
  <button class="openbtn" onclick="openNav()"><i class="fas fa-user icon"></i></button>
  
  <div id="customSidebar" class="custom-sidebar">
    <a href="javascript:void(0)" class="custom-sidebar-closebtn" onclick="closeCustomNav()"><i class="fa-solid fa-xmark icon"></i></a>
    <a href="landingpage.html" class="custom-sidebar-link">Home</a>
    <a href="#" class="custom-sidebar-link">Genre</a>
  </div>

  <button class="custom-openbtn" onclick="openCustomNav()"><i class="fa-solid fa-bars icon"></i></button>

  <div class="d-flex justify-content-start logo"> 
    <a href="<?=ROOT?>/home"><img src="<?=ROOT?>/assets/images/bhaven.png" alt="Logo"></a>
  </div>
</nav>

 

<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>