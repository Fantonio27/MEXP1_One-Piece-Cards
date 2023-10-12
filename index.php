<?php
    include './crud/db.php';

    $param = isset($_GET['category']);
    if ($param) {
        $cat = $_GET['category'];
    } else {
        $cat = "A";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One Piece</title>
    <link rel="icon" href="./images/Logo/One-Piece-icon.png">
    <link rel="stylesheet" href="./styles/index.css">
</head>

<body>
    <div class="container">
        <p hidden id="cat"><?php echo $cat ?></p>
        <p hidden id="char"><?php echo isset($_GET['id']) ? $_GET['id'] : 0 ?></p>
        <p hidden id="page"><?php echo isset($_GET['pageno']) ? $_GET['pageno'] : 1 ?></p>

        <div class="modal-container">
            <div id="modal">
                <div class="modal-box">
                    <?php
                    
                    $modal = isset($_GET['modal']);

                    if($modal){

                    ?>
                    <form action="">
                        <h2>Delete Confirmation</h2>
                        <p>id</p>
                        <input type="text">
                        <p>Name</p>
                        <input type="text">
                        <p>Type</p>
                        <input type="text">
                        <p>Short description</p>
                        <input type="text">
                        <p>Description</p>
                        <input type="text">
                    </form>
                    <?php 
                    
                    } else{
                        
                    ?>
                    <img src="" alt="character" class="modal-card mode">
                    <div class="modal-description-box">
                        <a href="index.php?category=<?php echo $_GET['category'] ?>"><img src="images/Logo/cross.png"
                                alt="x" class="cross-icon"></a>
                        <p class="modal-title mode"></p>
                        <p class="modal-type mode"></p>
                        <p class="modal-description mode"> </p>
                    </div>
                        
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="box-container">
            <center>
                <nav>
                <img src="./images/Logo/One-Piece-Logo.png" alt="One Piece Logo" class="logo displaylogo">
                    <ul>
                        <a href="index.php?category=A">
                            <li id="tab">All</li>
                        </a>
                        <a href="index.php?category=P">
                            <li id="tab">Pirates</li>
                        </a>
                        <img src="./images/Logo/One-Piece-Logo.png" alt="One Piece Logo" class="logo">
                        <a href="index.php?category=M">
                            <li id="tab">Marines</li>
                        </a>
                        <a href="index.php?category=O">
                            <li id="tab">Others</li>
                        </a>
                    </ul>
                </nav>

                <div class="card-container" id="card-container"></div>

                <div class="pagination">
                    <button id="prevous">&lt;</button>
                    <button id="next">&gt;</button>
                </div>
            </center>
        </div>
    </div>
    <script src="./scripts/index.js" type="module"></script>
</body>

</html>