<div class="wrap">
<?php

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
$nominee_list = $nominee_model->getAllForSelect();

//Form data sent
if($_POST['tvote_hidden'] == 'Y') {    
    $token = $_POST['tvote_token'];
    $token_id = $token_model->getTokenFor($token);

    if ($token_id!==NULL) {
        foreach($award_list as $award) {
            $award_id = $award[0];
            $nominee_id = $_POST['tvote_award_' . $award[0]];
            
            $vote_model->insert(array('token_id' => $token_id,
                                      'award_id' => $award_id,
                                      'nominee_id' => $nominee_id
            ));
        }
        Html::printUpdate("Vote saved");
    } else {
        Html::printUpdate("Token is not valid!");
    }
}

$vote_array = $vote_model->getAll();

if (!empty($award_list)) {
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
  <input type="submit" name="Submit" value="Vote" />
</p>

<?php 
        Html::closeForm();
} else {
    Html::printPageSubtitle("No award categories!");
}
?>

</div> <!-- End page -->
