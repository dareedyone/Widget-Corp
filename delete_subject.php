<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	if (intval($_GET['subj']) == 0) {
		redirect_to("content.php");
	}
	
	$id = mysqli_prep($_GET['subj']);
	
	if ($subject = get_subject_by_id($id)) {
		
		$query = "DELETE FROM subjects WHERE id = {$id} LIMIT 1";
		$result = mysqli_query($conn, $query);
		if (mysqli_affected_rows($conn) == 1) {
			redirect_to("content.php");
		} else {
			// Deletion Failed
			echo "<p>Subject deletion failed.</p>";
			echo "<p>" . mysqli_error($conn) . "</p>";
			echo "<a href=\"content.php\">Return to Main Page</a>";
		}
	} else {
		// subject didn't exist in database
		redirect_to("content.php");
	}
?>

<?php mysql_close($connection); ?>