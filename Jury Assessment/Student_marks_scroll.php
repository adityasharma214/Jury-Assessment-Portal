<Style>
    section {
        font-family: sans-serif;
        min-height: 100vh;
    }
</Style>

<body>
    <style>

    </style>
    <?php
    include("connect.php");
    $subject = $data['Subject_id'];
    $enroll = mysqli_real_escape_string($conn, $_POST['id']);
    $sql = "SELECT * FROM `rubrics` WHERE `Course_id` = '$subject';";
    $result = $conn->query($sql);
    ?>
    <section class="section">
        <h5 style="color: #737474;"><?php echo $data["Subject_id"] . ' - ' . $data["Subject_name"]; ?></h5>
        <div class="container mt-4">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr style="vertical-align:middle;background-color:#dc4c44; color:#FFFFFF;">
                        <th style="font-weight: bold; font-size:medium;text-align:center;">Criteria</th>
                        <th style="font-weight: bold; font-size:medium;text-align:center;">Rating 1</th>
                        <th style="font-weight: bold; font-size:medium;text-align:center;">Rating 2</th>
                        <th style="font-weight: bold; font-size:medium;text-align:center;">Rating 3</th>
                        <th style="font-weight: bold; font-size:medium;text-align:center;">Marks/</th>
                        <th style="font-weight: bold; font-size:medium;text-align:center;">Out of</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                    while ($rows = $result->fetch_assoc()) {
                        $count += $count;
                    ?>
                        <tr>
                            <td><?php echo $rows['Criteria']; ?></td>
                            <td><?php echo $rows['Rating1']; ?></td>
                            <td><?php echo $rows['Rating2']; ?></td>
                            <td><?php echo $rows['Rating3']; ?></td>
                            <td style="vertical-align:middle; text-align:center;"><input required min="0" max="<?php echo $rows['Out of']; ?>" step="5" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="2" name="data[]" value="" /></td>
                            <td style="vertical-align:middle; text-align:center;"><?php echo $rows['Out of']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <div class="form-group">
                <label for="exampleFormControlTextarea1" style="margin-bottom: 10px;">Comments</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" maxlength="250" placeholder="Enter your Feedback"></textarea>
            </div>

    </section>
    
</body>


</html>