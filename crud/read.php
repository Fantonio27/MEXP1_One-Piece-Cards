<?php

$sql = "SELECT * FROM characters";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['name'];
        $type = $row['type'];
        $short = $row['short'];
        $desc = $row['description'];
        $image = $row['image'];
        ?>

        <tr>
            <td scope="row">
                <?php echo $id ?>
            </td>
            <td>
                <center>
                    <?php echo '<img class="card" src="data:image/jpeg;base64,' . base64_encode($image) . '"/>'; ?>
                </center>
            </td>
            <td>
                <?php echo $name ?>
            </td>
            <td>
                <?php echo $type ?>
            </td>
            <td>
                <?php echo $short ?>
            </td>
            <td>
                <?php echo $desc ?>
            </td>
            <td>
                <a href="dashboard.php?id=<?php echo $id?>">Edit</a>
                <a href="dashboard.php?id=<?php echo $id?>&method=delete">Delete</a>
            </td>
        </tr>

        <?php
    }
}
?>