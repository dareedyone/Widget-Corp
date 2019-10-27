<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
$errors = array(); 
// Form Validation
$required_fields = array('menu_name', 'position', 'visible');
foreach($required_fields as $fieldname) {
    if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
        $errors[] = $fieldname;
    }
}

$fields_with_lengths = array('menu_name' => 30);
	foreach($fields_with_lengths as $fieldname => $maxlength ) {
		if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength) { $errors[] = $fieldname; }
	}

if (!empty($errors)) {
    redirect_to("new_subject.php");

}

?>
<?php
$menu_name= mysqli_prep($_POST['menu_name']);
$position= mysqli_prep($_POST['position']);
$visible= mysqli_prep($_POST['visible']);
?>
<?php
$query = "INSERT INTO subjects(menu_name, position, visible) VALUES ('{$menu_name}', {$position}, {$visible})";
if (mysqli_query($conn, $query)) {
header("location: content.php");
}else {
    echo "<p>Subject creation failed.</p>";
    echo "<p>" .mysqli_error(). "</p>";

}
?>

<?php mysqli_close($conn); ?>