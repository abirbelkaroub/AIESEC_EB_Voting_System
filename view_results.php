<?php
include 'connect.php';
$query = "SELECT * FROM members_number";
$result = mysqli_query($connect, $query);
if (!$result) {
    echo "Error retrieving data: " . mysqli_error($connect);
} else {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $total_eb_number = $row['total_eb_number'] ?? 0;
        $total_mmers_number = $row['total_mmers_number'] ?? 0;
        $total_less_six_number = $row['total_less_six_number'] ?? 0;
        $total_more_six_number = $row['total_more_six_number'] ?? 0;
        $total = $total_eb_number + $total_mmers_number + $total_less_six_number + $total_more_six_number;
    } else {
        echo "<h3>No data found in the result set.</h3>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Votting Results</title>
</head>

<body>
    <?php
    include('header.php');
    if (isset($total)) echo "<h1 class='vertical-double-space'>The total number of votters Is : $total</h1>";

    ?>


    <form action="" method="post">
        <table border="3">
            <thead>
                <th colspan="1">Applicant</th>
                <th colspan="1">Yes Percentage</th>
                <th colspan="1">Status</th>
                <th colspan="4">YES</th>
                <th colspan="4">NO</th>
                <th colspan="4">Neutrality</th>
            </thead>
            <tr>

                <?php

                $query = "SELECT * FROM participant";
                $result = mysqli_query($connect, $query);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        $eb_yes = $row['eb_yes'];
                        $mm_yes = $row['mm_yes'];
                        $less_six_yes = $row['less_six_yes'];
                        $more_six_yes = $row['more_six_yes'];

                        $eb_no = $row['eb_no'];
                        $mm_no = $row['mm_no'];
                        $less_six_no = $row['less_six_no'];
                        $more_six_no = $row['more_six_no'];

                        $eb_neutral = $row['eb_neutral'];
                        $mm_neutral = $row['mm_neutral'];
                        $less_six_neutral = $row['less_six_neutral'];
                        $more_six_neutral = $row['more_six_neutral'];

                        $percentage = $row['pourcent'];
                        $status = $row['status'];
                        $name = $row['name'];

                ?>

                        <td> <?php echo $name; ?></td>
                        <td> <?php echo $percentage; ?></td>
                        <td> <?php echo $status; ?></td>
                        <td>EB<input type="number" value="<?php echo $eb_yes; ?>"> </td>
                        <td>MMers<input type="number" value="<?php echo $mm_yes; ?>"></td>
                        <td>Less than 6 months Members<input type="number" value="<?php echo $less_six_yes; ?>"></td>
                        <td>More than 6 months Members<input type="number" value="<?php echo $more_six_yes; ?>"></td>

                        <td>EB<input type="number" value="<?php echo $eb_no; ?>"></td>
                        <td>MMers<input type="number" value="<?php echo $mm_no; ?>"></td>
                        <td>Less than 6 months Members<input type="number" value="<?php echo $less_six_no; ?>"></td>
                        <td>More than 6 months Members<input type="number" value="<?php echo $more_six_no; ?>"></td>

                        <td>EB<input type="number" value="<?php echo $eb_neutral; ?>"></td>
                        <td>MMers<input type="number" value="<?php echo $mm_neutral; ?>"></td>
                        <td>Less than 6 months Members<input type="number" value="<?php echo $less_six_neutral; ?>"></td>
                        <td>More than 6 months Members<input type="number" value="<?php echo $more_six_neutral; ?>"></td>
            </tr>
    <?php }
                }
    ?>
        </table>
    </form>
</body>

</html>