<?php
include_once 'database.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>File Retrieve With PHP and MySql</title>
</head>

<body>
    <div>
        <label>File Retrieve With PHP and MySql</label>
    </div>
    <div>
        <table width="80%" border="1">
            <tr>
                <th colspan="4">your uploads...<label><a href="index.php">upload new files...</a></label></th>
            </tr>
            <tr>
                <td>File Name</td>
                <td>File Type</td>
                <td>File Size(KB)</td>
                <td>View</td>
            </tr>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM file");
            ?>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($result)) {
                if ($i % 2 == 0)
                    $classname = "evenRow";
                else
                    $classname = "oddRow";
            ?>

                <tr>
                    <td><?php echo $row["file"]; ?></td>
                    <td><?php echo $row["type"]; ?></td>
                    <td><?php echo $row["size"]; ?></td>
                    <td><a href="upload/<?php echo $row['file'] ?>" target="_blank">view file</a></td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </table>

    </div>
</body>

</html>