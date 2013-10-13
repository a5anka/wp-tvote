<div class="wrap">
<?php
require_once( __DIR__ . '/models/nominee.php');
require_once( __DIR__ . '/models/award.php');
require_once( __DIR__ . '/helper/html.php');

$nominee_model = new Nominee();
$award_model = new Award();

//Form data sent
if($_POST['tvote_hidden'] == 'Y') {
    $award_id = $_POST['tvote_award_id'];
    $nominee_name = $_POST['tvote_nominee_name'];
    $nominee_model->insert(array('name' => $nominee_name,
                                 'award_id' => $award_id
    ));
    
    Html::printUpdate("Nominee saved");
}

$nominees_array = $nominee_model->getAll();
$award_list = $award_model->getAllForSelect();

Html::printPageTitle("Add Nominee");

Html::openForm();
?>

<input type="hidden" name="tvote_hidden" value="Y">
<p>Award: 
<?php Html::select("tvote_award_id", $award_list); ?>
</p>
<p>Nominee name: <input type="text" name="tvote_nominee_name" value="" size="20"></p>

<p class="submit">
  <input type="submit" name="Submit" value="Add Nominee" />
</p>

<?php 
    Html::closeForm();

    Html::openTable();
    Html::tableHead(array("ID", "Award", "Nominee Name"));

    Html::tableBody($nominees_array);
    
    Html::closeTable();
?>

</div> <!-- End page -->
