<?php
function tvote_save_token($vote_token) {
    global $wpdb;
    $wpdb->insert('wp_tvote_tokens', array('token' => $vote_token));
}

//Form data sent
if($_POST['tvote_hidden'] == 'Y') {
      $vote_token = $_POST['tvote_token'];
      tvote_save_token($vote_token);
?>
<div class="updated"><p><strong>Token saved</strong></p></div>
<?php
}
global $wpdb;
$vote_tokens_array = $wpdb->get_results(
"
SELECT *
FROM wp_tvote_tokens
", ARRAY_A
);
?>

<div class="wrap">
     <h2>Add Tokens</h2>
     <form name="tvote_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="tvote_hidden" value="Y">
        <p>Token: <input type="text" name="tvote_token" value="<?php echo $dbhost; ?>" size="20"></p>

        <p class="submit">
        <input type="submit" name="Submit" value="Add Token" />
        </p>
    </form>

<table class="wp-list-table widefat fixed">
<thead>
    <tr>
      <th>Token</th>
    </tr>
</thead>
<tfoot>
    <tr>
    <th>Token</th>
    </tr>
</tfoot>
<tbody>
<?php
    if( !empty( $vote_tokens_array ) ) :

        foreach( $vote_tokens_array as $row ) : ?>
            <tr>
                <td><?php echo $row['token']; ?></td>
            </tr>
            <?php
        endforeach;
    else : ?>
        <tr>
            <td><?php echo 'No data found'; ?></td>
        </tr>
        <?php
    endif;
    ?>
</tbody>
</table>

</div> <!-- End page -->
