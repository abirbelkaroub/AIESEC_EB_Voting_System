<?php


include 'connect.php';
if (isset($_POST['submit'])) {


    $particpant_name = $_POST['name'];
    // YESs votes 
    $eb_yes = $_POST['eb_yes'];
    $mm_yes = $_POST['mm_yes'];
    $less_six_yes = $_POST['less_six_yes'];
    $more_six_yes = $_POST['more_six_yes'];

    // NOs votes
    $eb_no = $_POST['eb_no'];
    $mm_no = $_POST['mm_no'];
    $less_six_no = $_POST['less_six_no'];
    $more_six_no = $_POST['more_six_no'];

    // NEUTRALs votes
    $eb_neutral = $_POST['eb_neutral'];
    $mm_neutral = $_POST['mm_neutral'];
    $less_six_neutral = $_POST['less_six_neutral'];
    $more_six_neutral = $_POST['more_six_neutral'];


    $sql = "insert into `participant` (name,eb_yes,mm_yes,less_six_yes,more_six_yes, eb_no,mm_no, less_six_no,more_six_no,eb_neutral,mm_neutral,less_six_neutral , more_six_neutral) values ('$particpant_name',$eb_yes,$mm_yes,$less_six_yes,$more_six_yes,$eb_no,$mm_no,$less_six_no,$more_six_no,$eb_neutral,$mm_neutral,$less_six_neutral ,$more_six_neutral)" or die(mysqli_error($connect));

    $insert_query = mysqli_query($connect, $sql);

    $percentage_each_eb = 0;
    $percentage_each_mm = 0;
    $percentage_each_less_six = 0;
    $percentage_each_more_six = 0;

    if ($insert_query) {
        $display_message = "The  Participant Data inserted successfully";
        // If someone votes 'neutral' for an applicant, the total number of voters specifically for that applicant will decrease by one (-1)
        $sql2 = "select * from `members_number` ";
        $select_query = mysqli_query($connect, $sql2);
        $row = mysqli_fetch_assoc($select_query);

        // If a 'neutral' vote is cast, it is subtracted from the total count for that category; otherwise, no change is made (-0) to the total count. This applies to each category
        $total_eb_number = $row['total_eb_number'] - $eb_neutral;
        $total_mmers_number = $row['total_mmers_number'] - $mm_neutral;
        $total_less_six_number = $row['total_less_six_number'] - $less_six_neutral;
        $total_more_six_number = $row['total_more_six_number'] - $more_six_neutral;

        // Calculating the percentage for each individual in every category for each applicant
        if ($eb_neutral > 0) {
            $total_eb_number = $total_eb_number - $eb_neutral;
            if ($total_eb_number > 0) {
                $percentage_each_eb = 30 / $total_eb_number;
            }
        } else $percentage_each_eb = 30 / $total_eb_number;

        if ($mm_neutral > 0) {
            $total_mmers_number = $total_mmers_number - $mm_neutral;
            if ($total_mmers_number > 0) {
                $percentage_each_mm = 15 / $total_mmers_number;
            }
        } else $percentage_each_mm = 15 / $total_mmers_number;


        if ($less_six_neutral > 0) {
            $total_less_six_number = $total_less_six_number - $less_six_neutral;
            if ($total_less_six_number > 0) {
                $percentage_each_less_six =  15 / $total_less_six_number;
            }
        } else $percentage_each_less_six =  15 / $total_less_six_number;


        if ($more_six_neutral > 0) {
            $total_more_six_number = $total_more_six_number - $more_six_neutral;
            if ($total_more_six_number > 0) {
                $percentage_each_more_six = 40 / $total_more_six_number;
            }
        } else $percentage_each_more_six = 40 / $total_more_six_number;

        // calculatting the percentage of YESs for each type for each applicant 
        $percentage_yes_eb = $eb_yes * $percentage_each_eb;
        $percentage_yes_mm = $mm_yes * $percentage_each_mm;
        $percentage_yes_less_six = $less_six_yes * $percentage_each_less_six;
        $percentage_yes_more_six = $more_six_yes * $percentage_each_more_six; // 

        $total_percentage_yes = $percentage_yes_eb + $percentage_yes_mm + $percentage_yes_less_six + $percentage_yes_more_six;
        if ($total_percentage_yes > 50 && $total_percentage_yes <= 100) {
            $status = "PASS";
        } elseif ($total_percentage_yes >= 0 && $total_percentage_yes <= 50) $status = "DON\'T PASS";

        $update_query = "update `participant` set pourcent=$total_percentage_yes, status='$status' where name='$particpant_name' ";
        $sql = mysqli_query($connect, $update_query);
    } else {
        echo "problem inserting the applicant Data";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<?php

if (isset($display_message)) {
    echo $display_message;
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add A Participant</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('header.php'); ?>
    <br>
    <h1 style="text-align: left;" class="vertical-space">Add A New Participant! :D</h1>
    <form action="" method="post">
        <label for="name">The Participant's Name:</label>
        <input type="text" id="name" name="name" class="vertical-space">
        <table border="3">
            <thead>
                <th colspan="4">YES</th>
                <th colspan="4">NO</th>
                <th colspan="4">Neutrality</th>
            </thead>
            <tr>


                <?php

                $query = "SELECT * FROM members_number";
                $result = mysqli_query($connect, $query);
                if (!$result) {
                    echo "Error retrieving data: " . mysqli_error($connect);
                } else {
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);

                        $total_eb_number = $row['total_eb_number'];
                        $total_mmers_number = $row['total_mmers_number'];
                        $total_less_six_number = $row['total_less_six_number'];
                        $total_more_six_number = $row['total_more_six_number'];
                    }
                }
                ?>

                <td>EB<input type="number" min="0" name="eb_yes" max="<?php echo $total_eb_number; ?>"> </td>
                <td>MMers<input type="number" min="0" name="mm_yes" max="<?php echo $total_mm_number; ?>"></td>
                <td>Less than 6 months Members<input type="number" name="less_six_yes" min="0" max="<?php echo $total_less_six_number; ?>"></td>
                <td>More than 6 months Members<input type="number" min="0" name="more_six_yes" max="<?php echo $total_more_six_number; ?>"></td>

                <td>EB<input type="number" min="0" name="eb_no" max="<?php echo $total_eb_number; ?>"></td>
                <td>MMers<input type="number" min="0" name="mm_no" max="<?php echo $total_mm_number; ?>"></td>
                <td>Less than 6 months Members<input type="number" min="0" name="less_six_no" max="<?php echo $total_less_six_number; ?>"></td>
                <td>More than 6 months Members<input type="number" min="0" name="more_six_no" max="<?php echo $total_more_six_number; ?>"></td>

                <td>EB<input type="number" min="0" name="eb_neutral" max="<?php echo $total_eb_number; ?>"></td>
                <td>MMers<input type="number" min="0" name="mm_neutral" max="<?php echo $total_mm_number; ?>"></td>
                <td>Less than 6 months Members<input type="number" min="0" name="less_six_neutral" max="<?php echo $total_less_six_number; ?>"></td>
                <td>More than 6 months Members<input type="number" min="0" name="more_six_neutral" max="<?php echo $total_more_six_number; ?>"></td>
            </tr>
        </table>
        <input type="submit" value="OK" name="submit" class="vertical-space-up">
    </form>
    <?php
    if (isset($total_percentage_yes)) {
        echo "<h3>The percentage of YES votes of " . $particpant_name . " Is : </h3>" . $total_percentage_yes . "%<h3> Status : </h3>" . stripslashes($status);
    }
    ?>


</body>

</html>