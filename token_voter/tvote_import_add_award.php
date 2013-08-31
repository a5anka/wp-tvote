<div class="wrap">
<?php
require_once( __DIR__ . '/models/award.php');
require_once( __DIR__ . '/helper/html.php');

$award_model = new Award();

//Form data sent
if($_POST['tvote_hidden'] == 'Y') {
    $award_name = $_POST['tvote_award_name'];
    $award_desc = $_POST['tvote_award_desc'];
    $award_model->insert(array('name' => $award_name,
    'descryption' => $award_desc));
    
    Html::printUpdate("Award saved");
}

$awards_array = $award_model->getAll();

Html::printPageTitle("Add Award");

Html::openForm();
?>

<input type="hidden" name="tvote_hidden" value="Y">
<p>Award name: <input type="text" name="tvote_award_name" value="" size="20"></p>
    <p>Description:</p> <textarea name="tvote_award_desc" rows="4" cols="50"></textarea>
<p class="submit">
  <input type="submit" name="Submit" value="Add Award" />
</p>

<?php 
    Html::closeForm();

    Html::openTable();
Html::tableHead(array("ID", "Award Name", "Description"));

    Html::tableBody($awards_array);
    
    Html::closeTable();
?>

</div> <!-- End page -->
