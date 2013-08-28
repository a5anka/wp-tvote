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

$vote_array = $vote_model->getAll();

Html::printPageTitle("Votes");
?>
<?php 

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
