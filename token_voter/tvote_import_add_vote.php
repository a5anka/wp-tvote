<style type="text/css">
div.updated {
  color: red;
}

div.tvote-award p {
    max-width: 800px;
    padding-left: 50px;
    text-align: justify;
}

div.tvote-award label {
    padding-left: 100px;
}
</style>
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
    $token = strtoupper($_POST['tvote_token']);
    $token_id = $token_model->getTokenFor($token);

    if ($token_id!==NULL) {
        foreach($award_list as $award) {
            $award_id = $award[0];
            $nominee_id = $_POST['tvote_award_' . $award[0]];

            $vote_saved = $vote_model->insert(array('token_id' => $token_id,
                                                    'award_id' => $award_id,
                                                    'nominee_id' => $nominee_id),
                                              array('%d','%d','%d'));

        }
        if ($vote_saved) {
            Html::printUpdate("Vote saved. Thank you.");
        } else {
            Html::printUpdate("You have already casted your vote.");
        }
    } else {
        Html::printUpdate("Token is not valid! Please check again.");
    }
}

$vote_array = $vote_model->getAll();

if (!empty($award_list)) {
    Html::openForm();
?>

<input type="hidden" name="tvote_hidden" value="Y">
<p><b>Voting Key in your ticket </b><input type="text" name="tvote_token" value="" size="20"></p>
<?php
        foreach($award_list as $award) {
            echo "<hr /><div class=\"tvote-award\"";
            Html::printAwardtitle($award[1]);
            Html::printAwardDescription($award[2]);
            $nominees = $nominee_model->getNomineeFor($award[0]);
            Html::radio("tvote_award_" . $award[0], $nominees);
            echo "<br /></div>";
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
