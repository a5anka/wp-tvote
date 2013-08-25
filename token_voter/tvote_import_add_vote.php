<div class="wrap">
<?php
     
function buildIndex($data_array)
{
    $result = array();
    foreach ($data_array as $row) {
        $result[$row[0]] = $row[1];
    }
    return $result;
}

require_once( __DIR__ . '/models/nominee.php');
require_once( __DIR__ . '/models/award.php');
require_once( __DIR__ . '/models/token.php');
require_once( __DIR__ . '/models/vote.php');
require_once( __DIR__ . '/helper/html.php');

$nominee_model = new Nominee();
$award_model = new Award();
$vote_model = new Vote();
$token_model = new Token();

$award_list = $award_model->getAllForSelect();
$award_index = buildIndex($award_list);
$nominee_list = $nominee_model->getAllForSelect();
$nominee_index = buildIndex($nominee_list);

//Form data sent
if($_POST['tvote_hidden'] == 'Y') {    
    $token = $_POST['tvote_token'];
    $token_id = $token_model->getTokenFor($token);

    foreach($award_list as $award) {
        $award_id = $award[0];
        $nominee_id = $_POST['tvote_award_' . $award[0]];
     
        $vote_model->insert(array('token_id' => $token_id,
                                  'award_id' => $award_id,
                                  'nominee_id' => $nominee_id
        ));
    }
    Html::printUpdate("Nominee saved");
}

$vote_array = $vote_model->getAll();

Html::printPageTitle("Add Nominee");

Html::openForm();
?>

<input type="hidden" name="tvote_hidden" value="Y">
<p>Token: <input type="text" name="tvote_token" value="" size="20"></p>
<?php
    foreach($award_list as $award) {
        Html::printPageSubtitle($award[1]);
        $nominees = $nominee_model->getNomineeFor($award[0]);
        Html::select("tvote_award_" . $award[0], $nominees);
    }
?>

<p class="submit">
  <input type="submit" name="Submit" value="Add Token" />
</p>

<?php 
    Html::closeForm();

    Html::openTable();
    Html::tableHead(array("Token", "Award", "Nominee"));

        echo "<tbody>";
        if( !empty($vote_array) ) {
            
            foreach( $vote_array as $row ) {
                echo "<tr>";
                echo "<td>" . $row['token_id'] . "</td>";
                echo "<td>" . $award_index[$row['award_id']] . "</td>";
                echo "<td>" . $nominee_index[$row['nominee_id']] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "<td>No data found</td>";
            echo "</tr>";
        }
        echo "</tbody>";


    
    Html::closeTable();
?>

</div> <!-- End page -->
