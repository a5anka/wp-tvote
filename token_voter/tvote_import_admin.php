<?php
//Form data sent
if($_POST['tvote_hidden'] == 'Y') {  
      $dbhost = $_POST['tvote_dbhost'];  
      update_option('tvote_dbhost', $dbhost);

      $dbname = $_POST['tvote_dbname'];  
        update_option('tvote_dbname', $dbname);  
          
        $dbuser = $_POST['tvote_dbuser'];  
        update_option('tvote_dbuser', $dbuser);  
          
        $dbpwd = $_POST['tvote_dbpwd'];  
        update_option('tvote_dbpwd', $dbpwd);  
?>
<div class="updated"><p><strong>Options saved.</strong></p></div> 
<?php
} else {  
    //Normal page display  
    $dbhost = get_option('tvote_dbhost');  
    $dbname = get_option('tvote_dbname');  
    $dbuser = get_option('tvote_dbuser');  
    $dbpwd = get_option('tvote_dbpwd'); 
}  
?> 

<div class="wrap">  
     <h2>Token Voting Options</h2>
     <form name="tvote_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
        <input type="hidden" name="tvote_hidden" value="Y">  
        <h4>Database Settings</h4>
        <p>Database host: <input type="text" name="tvote_dbhost" value="<?php echo $dbhost; ?>" size="20"> ex: localhost</p>  
        <p>Database name<input type="text" name="tvote_dbname" value="<?php echo $dbname; ?>" size="20"> ex: tvote_db</p>  
        <p>Database user: <input type="text" name="tvote_dbuser" value="<?php echo $dbuser; ?>" size="20"> ex: root</p>  
        <p>Database password: <input type="password" name="tvote_dbpwd" value="<?php echo $dbpwd; ?>" size="20"> ex: secretpassword</p>  
      
        <p class="submit">  
        <input type="submit" name="Submit" value="Update Options" />  
        </p>  
    </form> 
</div>
