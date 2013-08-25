<div class="wrap">
<?php
require_once( __DIR__ . '/models/token.php');
require_once( __DIR__ . '/helper/html.php');

$token_model = new Token();

//Form data sent
if($_POST['tvote_hidden'] == 'Y') {
    $vote_token = $_POST['tvote_token'];
    $token_model->insert(array('token' => $vote_token));
    
    Html::printUpdate("Token saved");
}

$vote_tokens_array = $token_model->getAll();

Html::printPageTitle("Add Tokens");

Html::openForm();
?>

<input type="hidden" name="tvote_hidden" value="Y">
<p>Token: <input type="text" name="tvote_token" value="<?php echo $dbhost; ?>" size="20"></p>

<p class="submit">
  <input type="submit" name="Submit" value="Add Token" />
</p>

<?php 
    Html::closeForm();

    Html::openTable();
    Html::tableHead(array("ID", "Token"));

    Html::tableBody($vote_tokens_array);
    
    Html::closeTable();
?>

</div> <!-- End page -->
