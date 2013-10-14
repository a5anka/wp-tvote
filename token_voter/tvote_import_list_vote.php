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

foreach($award_list as $award) {
    Html::printAwardtitle($award[1]);
    /* $nominees = $nominee_model->getNomineeFor($award[0]); */
    /* Html::radio("tvote_award_" . $award[0], $nominees); */
    /* echo "<br />"; */
    $vote_results = $vote_model->getTotalVotesFor($award[0]);

    Html::openTable();
    Html::tableHead(array("Nominee", "Votes"));

    echo "<tbody>";

    if( !empty($vote_results) ) {

        foreach( $vote_results as $row ) {
            echo "<tr>";
            echo "<td>" . $nominee_index[$row['nominee_id']] . "</td>";
            echo "<td>" . $row['total_votes'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr>";
        echo "<td>No data found</td>";
        echo "</tr>";
    }
    echo "</tbody>";

    Html::closeTable();

}

echo "<h4>Result dump</h4>";

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
