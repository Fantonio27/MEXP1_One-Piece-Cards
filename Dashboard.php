<?php
include './crud/db.php';

$i = isset($_GET['id']);
$m = isset($_GET['method']);
if ($m) {
    $paramid = $_GET['id'];
    $method=$_GET['method'];
} else if ($i) {
    $paramid = $_GET['id'];

    $sql = "SELECT * FROM characters WHERE id = '$paramid'";
    $result = mysqli_query($conn, $sql);

    $row = $result->fetch_assoc();
    $ename = $row['name'];
    $etype = $row['type'];
    $eshort = $row['short'];
    $edesc = $row['description'];
    $eimage = $row['image'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One Piece - Dashboard</title>
    <link rel="stylesheet" href="./styles/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container-box">
        <center>
            <nav>
                <H2 class="title">Dashboard</H2>
                <button type="button" class="createbutton" id="createbutton" data-bs-toggle="modal"
                    data-bs-target="#createmodal">
                    Create
                </button>
            </nav>

            <!-- Trigger to open modal  -->
            <button id="editbutton" data-bs-toggle="modal" data-bs-target="#editmodal" style="opacity: 0"></button>
            <button id="deletebutton" data-bs-toggle="modal" data-bs-target="#deletemodal" style="opacity: 0"></button>
            <input type="hidden" id="method" value="<?php echo $method ?>" />  <!--hidden method-->

            <div class="container-table">
                <table>
                    <thead class="thead">
                        <th scope="col">id</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Short Description</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </thead>
                    <tbody>
                        <?php
                        include './crud/read.php';
                        ?>
                    </tbody>
                </table>
            </div>
        </center>

        <!-- Modal For Create Form -->
        <div class="modal fade " id="createmodal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Create Character</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="./crud/create.php" enctype="multipart/form-data" class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Input name"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="type" class="form-label">Type</label>
                                <select id="type" class="form-select" name="type" required>
                                    <option value="" selected>Choose...</option>
                                    <option value="Pirate">Pirate</option>
                                    <option value="Marine">Marine</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="short" class="form-label">Short Description</label>
                                <textarea class="form-control" id="short" rows="4" name="short" required></textarea>
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5"
                                    required></textarea>
                            </div>
                            <div class="col-12">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="image" required>
                            </div>
                            <div class="col-12">
                                <center><input type="submit" name="submit" class="createbutton" value="Create"></input>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal For Edit Form -->
        <div class="modal fade " id="editmodal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit Character</h1>
                        <a href="dashboard.php"><button type="button" class="btn-close"
                                data-bs-dismiss="modal"></button></a>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="./crud/update.php" enctype="multipart/form-data" class="row g-3">
                            <input type="hidden" id="id" value="<?php echo $paramid ?>" />     <!--hidden id-->

                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Input name"
                                    value="<?php echo $ename ?>" required>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" id="type" value="<?php echo $etype ?>" />    <!--hidden type-->

                                <label for="types" class="form-label">Type</label>
                                <select id="types" class="form-label">
                                    <option value="" disabled>Choose...</option>
                                    <option value="Pirate">Pirate</option>
                                    <option value="Marine">Marine</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="short" class="form-label">Short Description</label>
                                <textarea class="form-control" id="short" rows="4" name="short"
                                    required><?php echo $eshort ?></textarea>
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5"
                                    required><?php echo $edesc ?></textarea>
                            </div>
                            <div class="col-12">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="image" required>
                            </div>
                            <div class="col-12">
                                <center>
                                    <input type="submit" name="submit" class="createbutton" value="Create"></input>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal For Delete Form -->
    <div class="modal fade " id="deletemodal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you want to delete this character?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="./crud/delete.php" method="post">

                        <input type="hidden" id="id" name="id" value="<?php echo $paramid ?>" />    <!--hidden id-->

                        <input type="submit" name="submit" class="createbutton" value="Confirm"></input>   
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        const id = document.getElementById('id').value;
        const type = document.getElementById('type').value;
        const method = document.getElementById('method').value;

        if (method == "delete") {
            document.getElementById("deletebutton").click();
        } else if (id >= 0) {
            document.getElementById("editbutton").click();
            document.getElementById("types").value = "";

        }

    </script>
</body>

</html>