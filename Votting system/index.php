<?php

include 'connect.php';
if (isset($_POST['submit'])) {
    $total_eb_number = $_POST['total_eb_number'];
    $total_mmers_number = $_POST['total_mmers_number'];
    $total_less_six_number = $_POST['total_less_six_number'];
    $total_more_six_number = $_POST['total_more_six_number'];
    $insert_query = mysqli_query($connect, "insert into `members_number` (total_eb_number,total_mmers_number,total_less_six_number ,total_more_six_number ) values ($total_eb_number, $total_mmers_number , $total_less_six_number ,$total_more_six_number)") or die(mysqli_error($connect));

    if ($insert_query) {
        $display_message = "Numbers for each category has inserted successfully";
    } else {
        $display_message = "There are some errors inserting the numbers";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Votting System</title>
</head>

<div style="color: green;">
<body>
    <?php include('header.php');
    if (isset($display_message)) {
     echo htmlspecialchars($display_message);
    }

    ?>
    </div>

    <h2 class="vertical-space">Welcom To The Votting System </h2>
    <form action="" method="post">
        <input type="number" min="0" placeholder="EB Number" name="total_eb_number"> <br>
        <input type="number" min="0" placeholder="MMers Number" name="total_mmers_number"><br>
        <input type="number" min="0" placeholder="Less than 6 months Members Number" name="total_less_six_number"><br>
        <input type="number" class="vertical-space"" min="0" placeholder="More than 6 months Members Number" name="total_more_six_number"><br>
        <input type="submit" name="submit" value="OK">
    </form>
</body>

</html>