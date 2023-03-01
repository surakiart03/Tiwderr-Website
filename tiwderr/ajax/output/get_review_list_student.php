<?php
include("../../functions/utf8_strlen.php");
require_once("../../connection/connect_db.php");
session_start();

$student = $_POST['student'];
$score = ($_POST['score'] != 0 ? " AND `score` = $_POST[score]" : "");

$sql = "SELECT A.*, B.profile_pic 
                    FROM `tbl_review_student` A
                    INNER JOIN `tbl_user_info` B
                    ON A.create_by = B.username
                    WHERE `student` = '$student' $score
                    ORDER BY `created_time` DESC";
$result = mysqli_query($conn, $sql);
// print_r($sql);

if (mysqli_num_rows($result) != 0) {
?>
    <table id="tbl_review" class="tbl_review" width="100%">
        <thead class="d-none">
            	<th></th>
		<th></th>
        </thead>
        <tbody>
            <?php
            foreach ($result as $row) {
            ?>
                <tr style="vertical-align: top;">
			<td style="width: 45px;">
				<figure class="d-inline-block mr-3">
                                    <img src="./assets/images/avatar/<?= $row['profile_pic'] ?>" alt="img" width="40rem" height="40rem" class="rounded-circle">
                                </figure>
			</td>
                    <td>
                        <div class="row px-3">
                            <div class="d-flex flex-column">
                                <p class="p-0 m-0">
                                    <?php
                                    if ($row['show_user'] == 1) {
                                        echo $row['create_by'];
                                    } else {
                                        echo substr($row['create_by'], 0, 1) . "*****" . substr($row['create_by'], strlen($row['create_by']) - 1, strlen($row['create_by']));
                                    }
                                    ?>
                                    <br />
                                    <span class="text-secondary"><?= $row['created_time'] ?></span>
                                </p>
                                <p class="p-0 m-0">

                                    <?php
                                    $rating = $row['score'];
                                    if ($rating != 0) {
                                        for ($star = 0; $star < $rating; $star++) {
                                            echo '<i class="mdi mdi-star text-warning" style="font-size:1.5rem;"></i>';
                                        }
                                        for ($star = 0; $star < 5 - $rating; $star++) {
                                            echo '<i class="mdi mdi-star-outline text-warning" style="font-size:1.5rem;"></i>';
                                        }
                                    } else {
                                        for ($star = 0; $star < 5; $star++) {
                                            echo '<i class="mdi mdi-star-outline text-warning" style="font-size:1.5rem;"></i>';
                                        }
                                    }

                                    ?>
                                </p>
                                <span class="p-0 m-0"><?= $row['message'] ?></span>


                            </div>
                        </div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
} else {
}
?>
<script>
    $(document).ready(function() {
        $(".tbl_review").DataTable({
            dom: '<"toolbar">frtip',
            ordering: false,
            searching: false,
            paging: true,
            pageLength: 15,
	    destroy: true,
        });
    });
</script>