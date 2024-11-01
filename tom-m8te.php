<?php
/*
Plugin Name: Tom M8te
Plugin URI: http://wordpress.org/extend/plugins/tom-m8te/
Description: Tom-M8te provides useful functions that you can use in your plugins. Such as a nice function for adding social share links and database manipulation functions. 

Installation:

1) Install WordPress 3.8 or higher

2) Download the following file:

http://downloads.wordpress.org/plugin/tom-m8te.zip

3) Login to WordPress admin, click on Plugins / Add New / Upload, then upload the zip file you just downloaded.

4) Activate the plugin.

Version: 1.6.0
Author: TheOnlineHero - Tom Skroza
License: GPL2
*/
//  echo("<script language='javascript'>jQuery(window).keydown(function(e) {if (e.keyCode== 13 && e.ctrlKey) {alert('BOOO');}});</script>");

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
require_once(ABSPATH."wp-includes/class-phpmailer.php");
if (get_option("include_securimage") == "1" && !class_exists("Securimage")) {
  require_once('securimage/securimage.php');
}
if (!class_exists("simple_html_dom_node")) {
 require_once(dirname(__FILE__).'/simplephpdom/simple_html_dom.php');
}

add_action('admin_menu', 'register_tom_m8te_page');

function register_tom_m8te_page() {
   add_menu_page('Tom M8te', 'Tom M8te', 'update_themes', 'tom-m8te/tom-m8te-story.php', '',  '', 186);
   add_submenu_page('tom-m8te/tom-m8te-story.php', 'Docs', 'Docs', 'manage_options', 'tom-m8te/tom_m8te_docs.php', '');
   add_submenu_page('tom-m8te/tom-m8te-story.php', 'Settings', 'Settings', 'manage_options', 'tom-m8te/tom-m8te.php', 'tom_m8te_settings_page');
}

//call register settings function
add_action( 'admin_init', 'register_tom_m8te_settings' );
function register_tom_m8te_settings() {
  register_setting( 'tom-m8te-settings-group', 'include_securimage' );
  if (isset($_REQUEST['tomm8te_download']) && $_REQUEST['tomm8te_download'] != "" && wp_verify_nonce($_REQUEST['_tomm8te_nonce'], "tomm8te_download_file_nonce")) {
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false);
    header("Content-Disposition: attachment; filename=".$_GET["file"].";" );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".filesize($_GET["file"]));
    echo file_get_contents($_GET["file"]);
    exit;
  }
}

add_action("admin_init", "tom_m8te_register_style_scripts");
function tom_m8te_register_style_scripts() {
  wp_register_script("tom-m8te", plugins_url("/js/application.js", __FILE__));
  wp_enqueue_script("tom-m8te");
  wp_register_style("tom-m8te", plugins_url("/css/style.css", __FILE__));
  wp_enqueue_style("tom-m8te");
}

function tom_m8te_settings_page() {?>
  <div class="wrap">
  <h2>Settings</h2>
  <div class="postbox " style="display: block; ">
  <div class="inside">
  <form method="post" action="options.php">
    <?php settings_fields( 'tom-m8te-settings-group' ); ?>
    <h3>Settings</h3>
    <table class="form-table">
      <tbody>
        <tr valign="top">
          <th scope="row">
            <label for="include_securimage">Include Securimage:</label>
          </th>
          <td>
            <input type="hidden" name="include_securimage" value="0" />
            <input type="checkbox" id="include_securimage" name="include_securimage" value="1"
              <?php
                if (get_option("include_securimage") == "1") {
                  echo "checked";
                }
              ?>
             />
          </td>
        </tr>
      </tbody>
    </table>

    <p class="submit">
      <input type="submit" name="Submit" value="Update Settings" />
    </p>

  </form>
  </div>
  </div>
  </div>
<?php
}

// Returns an array of months of the year.
function tom_get_month_list() {
  return array("January","February","March","April","May","June","July","August","September","October","November","December");
}

// Creates a share website link for Facebook and Twitter.
function tom_add_social_share_links($url) {
  ?>
  <a title="Share On Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo($url); ?>"><img style="width: 30px;" src="<?php echo(get_option("siteurl")); ?>/wp-content/plugins/tom-m8te/images/facebook.jpg" style="width: 30px;" /></a>
  <a title="Share On Twitter" target="_blank" href="http://twitter.com/intent/tweet?url=<?php echo($url); ?>"><img style="width: 30px;" src="<?php echo(get_option("siteurl")); ?>/wp-content/plugins/tom-m8te/images/twitter.jpg" style="width: 30px;" /></a>
  <a title="Rate it 5 Star" target="_blank" href="<?php echo($url); ?>"><img style="padding-bottom: 3px;" src="<?php echo(get_option("siteurl")); ?>/wp-content/plugins/tom-m8te/images/rate-me.png" /></a>
  
  <?php
}

// Write content to a file.
function tom_write_to_file($write_content, $location) {
  $file = fopen($location, "w") or exit("Unable to open file!");
  $content = str_replace('\"', "\"", $write_content);
  $content = str_replace("\'", '\'', $content);
  fwrite($file, $content);
  fclose($file);
}

// Write a block of content into the htaccess file.
// Example: tom_write_to_htaccess_file("WP ERROR LOG", "<Files error_log>\norder allow,deny\ndeny from all\n</Files>\nphp_flag  log_errors on\nphp_value error_log error_log");
function tom_write_to_htaccess_file($rule_name, $content) {
  $htaccess_content = file_get_contents(ABSPATH.".htaccess");
  $htaccess_content = preg_replace("/\n#BEGIN ".$rule_name."(.+)#END ".$rule_name."/s", "", $htaccess_content);
  file_put_contents(ABSPATH.".htaccess", $htaccess_content);
  $new_content = "\n#BEGIN ".$rule_name.
"\n".$content."\n".
"#END ".$rule_name;
  file_put_contents(ABSPATH.".htaccess", $new_content, FILE_APPEND | LOCK_EX);
}

// Returns true if the file is writable, false if it isn't.
function tom_is_file_writable($file) {
  if ( $f = @fopen( $file, 'a' ) ) {               
    @fclose( $f );
    return true;
  } else {
    return false;
  }
}

// Returns true if the file is readable, false if it isn't.
function tom_is_file_readable($file) {
  if ( $f = @fopen( $file, 'r' ) ) {               
    @fclose( $f );
    return true;
  } else {
    return false;
  }
}

// Javascript redirect to url code.
function tom_javascript_redirect_to($url, $non_javscript_content = "") {
  echo("<script language='javascript'>window.location='".$url."'</script>");
  if ($non_javscript_content != "") {
    echo $non_javscript_content;
  }
}

// Titlizes a string. For example: status_level would become Status Level.
function tom_titlize_str($str) {
  return ucwords((str_replace("_", " ", $str)));
}

// Return current url.
function tom_get_current_url() {
  $pageURL = 'http';
  if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
  $pageURL .= "://";
  if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
  } else {
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
  }
  return $pageURL;
}

// Returns true if parameter is a datetime variable.
function tom_is_valid_datetime($datetime) {
    return (preg_match("/^([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})( ([0-9| |:])*)*$/", $datetime));
}

// Returns true if parameter is an email address. You can only pass one email address.
function tom_is_valid_email($email) {
  $email = strtolower($email);
  return (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email));
}


// Returns true if parameter is an email address. You can pass more then one email address, by separating them with a comma.
function tom_is_valid_emails($emails) {
  $emails_valid = true;
  $email_addresses = explode(",", preg_replace("/,( )*/", ",",$emails));
  foreach ($email_addresses as $email_address) {
    $email_address = strtolower($email_address);
    if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email_address)) {
      $emails_valid = false;
    }
  }
  return $emails_valid;
}

// Fixes up http post/get variables so that they present quotes correctly rather then like (\').
function tom_fix_http_quotes($http_data) {
	$http_data = str_replace('\"', "\"", $http_data);
	$http_data = str_replace("\'", '\'', $http_data);
	return $http_data;
}

// Basically gets the value from query string without having to use $_POST or $_GET variables. $_POST takes precidence over $_GET.
function tom_get_query_string_value($name, $index = -1) {
  if ($index == -1) {
    if (isset($_POST[$name])) {
      return tom_fix_http_quotes($_POST[$name]);
    } else if (isset($_GET[$name])) {
      return tom_fix_http_quotes($_GET[$name]);
    } else if (isset($_POST[$name."_0"])) {
        $i = 0;
        $data = "";
        do {
          $data .= $_POST[$name."_".$i];
          if ($data != "") {
            $data .= " ";
          }
          $i++;
        } while (isset($_POST[$name."_".$i]));
        $_POST[$name] = tom_fix_http_quotes($data);
        return tom_fix_http_quotes($data);
    } else {
      return "";
    }
  } else {
    $name = str_replace("[]", "", $name);
    if (isset($_POST[$name][$index])) {
      return tom_fix_http_quotes($_POST[$name][$index]);
    } else if (isset($_GET[$name][$index])) {
      return tom_fix_http_quotes($_GET[$name][$index]);
    } else if (isset($_POST[$name."_0"][$index])) {
        $i = 0;
        $data = "";
        do {
          $data .= $_POST[$name."_".$i][$index];
          if ($data != "") {
            $data .= " ";
          }
          $i++;
        } while (isset($_POST[$name."_".$i][$index]));
        $_POST[$name][$index] = tom_fix_http_quotes($data);
        return tom_fix_http_quotes($data);
    } else {
      return "";
    }
  }
}

// Upload a file.
function tom_upload_file($field_name) {
  $uploadfiles = $_FILES[$field_name];

  if (is_array($uploadfiles)) {

    foreach ($uploadfiles['name'] as $key => $value) {

      // look only for uploded files
      if ($uploadfiles['error'][$key] == 0) {

        $filetmp = $uploadfiles['tmp_name'][$key];

        //clean filename and extract extension
        $filename = $uploadfiles['name'][$key];

        // get file info
        // @fixme: wp checks the file extension....
        $filetype = wp_check_filetype( basename( $filename ), null );
        $filetitle = preg_replace('/\.[^.]+$/', '', basename( $filename ) );
        $filename = $filetitle . '.' . $filetype['ext'];
        $upload_dir = wp_upload_dir();

        /**
         * Check if the filename already exist in the directory and rename the
         * file if necessary
         */
        $i = 0;
        while ( file_exists( $upload_dir['path'] .'/' . $filename ) ) {
          $filename = $filetitle . '_' . $i . '.' . $filetype['ext'];
          $i++;
        }
        $filedest = $upload_dir['path'] . '/' . $filename;

        /**
         * Check write permissions
         */
        if ( !is_writeable( $upload_dir['path'] ) ) {
          $this->msg_e('Unable to write to directory %s. Is this directory writable by the server?');
          return;
        }

        /**
         * Save temporary file to uploads dir
         */
        if ( !@move_uploaded_file($filetmp, $filedest) ){
          $this->msg_e("Error, the file $filetmp could not moved to : $filedest ");
          continue;
        }

        $attachment = array(
          'post_mime_type' => $filetype['type'],
          'post_title' => $filetitle,
          'post_content' => '',
          'post_status' => 'inherit',
        );

        $attach_id = wp_insert_attachment( $attachment, $filedest );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $filedest );
        wp_update_attachment_metadata( $attach_id,  $attach_data );
        preg_match("/\/wp-content(.+)$/", $filedest, $matches, PREG_OFFSET_CAPTURE);
        tom_update_record_by_id("posts", array("guid" => get_option("siteurl").$matches[0][0]), "ID", $attach_id);
        // echo $filedest;
      }
    }   
  }
}


// Allows you to send an email.
function tom_send_email($is_html, $to_emails, $to_cc_emails, $to_bcc_emails, $from_email, $from_name, $subject, $body, $alt_body = "", $attachments = array(), $smtp_auth = false, $smtp_mail_host = "", $smtp_mail_port = "", $smtp_mail_username = "", $smtp_mail_password = "", $secure_array = array()) {

  $mail  = new PHPMailer(); 
  // defaults to using php "mail()"
  $body  = preg_replace("/[\"]/","",$body);
  if (!is_array($to_emails)) {
    $to_emails = explode(",", $to_emails);
  }
  foreach ($to_emails as $key => $value) {
    if (is_integer($key)) {
      $mail->AddAddress(str_replace(" ", "",$value), "");
    } else {
      $mail->AddAddress(str_replace(" ", "",$key), $value);
    }
  } 

  if (!is_array($to_cc_emails)) {
    $to_cc_emails = explode(",", $to_cc_emails);
  }
  foreach ($to_cc_emails as $key => $value) {
    if (is_integer($key)) {
      $mail->AddCC(str_replace(" ", "",$value), "");
    } else {
      $mail->AddCC(str_replace(" ", "",$key), $value);
    }
  } 

  if (!is_array($to_bcc_emails)) {
    $to_bcc_emails = explode(",", $to_bcc_emails);
  }
  foreach ($to_bcc_emails as $key => $value) {
    if (is_integer($key)) {
      $mail->AddBCC(str_replace(" ", "",$value), "");
    } else {
      $mail->AddBCC(str_replace(" ", "",$key), $value);
    }
  } 

  $mail->SetFrom($from_email, $from_name);
  $mail->Subject  = $subject;

  if ($is_html) {
    $body = preg_replace("/<script(.+)*<\/script>/", "", $body);
  } else {
    $body = esc_html($body);
  }
  
  $alt_body = esc_html($alt_body);

  $body = str_replace("&#039;", "'", $body);
  $body = str_replace("&#34;", '"', $body);
  $body = str_replace("&amp;", '&', $body);
  $body = str_replace("&#38;", '&', $body);
  $alt_body = str_replace("&#039;", "'", $alt_body);
  $alt_body = str_replace("&#34;", '"', $alt_body);
  $alt_body = str_replace("&amp;", '&', $alt_body);
  $alt_body = str_replace("&#38;", '&', $alt_body);

  if ($is_html) {
    $mail->MsgHTML($body);
  } else {
    $mail->Body = $body;
  }

  if ($alt_body != "") {
    $mail->AltBody = $alt_body;
  }
  
  foreach ($attachments as $attachment_url) {
    $mail->AddAttachment($attachment_url);      // attachment
  }

  if ($smtp_auth) {
    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->SMTPAuth = true; 
    if ($smtp_mail_host != "") {
      $mail->Host = $smtp_mail_host;
    }
    if ($smtp_mail_port != "") {
      $mail->Port = $smtp_mail_port;
    }
    if ($smtp_mail_username != "") {
      $mail->Username = $smtp_mail_username;
    }
    if ($smtp_mail_password != "") {
      $mail->Password = $smtp_mail_password;
    }

		foreach ($secure_array as $secure) {
			if ($secure == "tls") {
				$mail->SMTPSecure = 'tls';
			} else if ($secure == "ssl") {
				$mail->SMTPSecure = 'ssl';
			}
		}

  }

  if(!$mail->Send()) {
    return "<div class='error'>Mailer Error: ".$mail->ErrorInfo."</div>";
  } else {
    return "<div class='success'>Message sent!</div>";
  }
}

// Generates a datatable with show, edit and delete links.
function tom_generate_datatable($table_name, $fields_array, $primary_key_name, $where_clause, $order_array = array(), $limit_clause = "", $page_name, $display_show = true, $display_edit = true, $display_delete = true, $sortable_columns = false, $paginate_table = false, $date_format = "Y-m-d", $filter_arrays = array()) {
    
  if (!is_array($fields_array)) {
    echo("Fields Array, can only accept an array of field names.");
  } else {

    // Get the page no. Mainly used during pagination.
    if (isset($_GET[$table_name."_page"])) {
      $page_no = $_GET[$table_name."_page"];  
    }

    // If sort columns enabled, find out what order the columns are suppose to be in.
    if ($sortable_columns && isset($_GET[$table_name."_order_by"]) && $_GET[$table_name."_order_by"] != "") {
      array_unshift($order_array, $_GET[$table_name."_order_by"]." ".$_GET[$table_name."_order_direction"]);
    }

    if (isset($_GET[$table_name."_order_direction"]) && $_GET[$table_name."_order_direction"] != "") {
      $order_direction = $_GET[$table_name."_order_direction"];
    }

    // Work out which page no of results to show. Offset is the same as page no in MySQL.
    $offset_clause = "";
    if ($limit_clause != "" && $paginate_table) {
      $offset = 0;
      $offset = $page_no * $limit_clause;
      $offset_clause = " OFFSET $offset";
    }

    // If filter enabled, add extra filter conditions to existing datatable.
    $extra_where = array();
    if (count($filter_arrays) > 0) {
      if (tom_get_query_string_value($table_name."_filters") != "") {
        $filters = explode(",", tom_get_query_string_value($table_name."_filters"));
        foreach ($filters as $filter) {
          if (tom_get_query_string_value("filter_".$filter) != "") {
            if (!(isset($_POST["action"]) && $_POST["action"] == "Reset")) {
              array_push($extra_where, $filter." LIKE '%".tom_get_query_string_value("filter_".$filter)."%'");  
            }
          }
        }
        if (count($extra_where) > 0) {
          if ($where_clause != "") {
            $where_clause = "(".$where_clause.") AND (".implode(" AND ", $extra_where).")";
          } else {
            $where_clause = implode(" AND ", $extra_where);
          }
        }
      }
      if (isset($_POST["action"]) && $_POST["action"] == "Filter") {
        $page_no = 0;
        $offset_clause = " OFFSET 0";
      }
    }

    $results = tom_get_results($table_name, $fields_array, $where_clause, $order_array, $limit_clause.$offset_clause);
    
    $total_count = count(tom_get_results($table_name, $fields_array, $where_clause));

    echo("<div class=\"postbox\" style=\"display: block; \"><div class=\"inside\">");
    
    $filters = array();

    if (count($filter_arrays) > 0) { ?>
      <h2>Filter</h2>
      <div class='search-filter'>
        <form action="" method="post">
          <fieldset>
            <?php 
            $params_filter = "";
            foreach($filter_arrays as $filter_array) { 
              foreach($filter_array as $key => $value) { 
                if (tom_get_query_string_value("filter_".$key) != "") {
                  if (isset($_POST["action"]) && $_POST["action"] == "Reset") {
                    $_POST["filter_".$key] = "";
                  }
                  $params_filter .= "&filter_".$key."=".tom_get_query_string_value("filter_".$key);
                }
                array_push($filters, $key);
                tom_add_form_field(null, $value["type"], tom_titlize_str($key), "filter_".$key, "filter_".$key, array(), "p", array(), $value["value_options"]);
              }
            } 
            ?>
            <input type="hidden" id="<?php echo($table_name); ?>_filters" name="<?php echo($table_name); ?>_filters" value="<?php echo(implode(",", $filters)); ?>" />
          </fieldset>
          <fieldset class="submit">
            <p><input type="submit" name="action" value="Filter"/> <input type="submit" name="action" value="Reset" /></p>
          </fieldset>
        </form>
      </div>
      <?php
    }
    if (count($results) > 0) { 
      if ($paginate_table) { tom_generate_datatable_pagination($table_name, $total_count, $limit_clause, $page_no, $page_name, $order_direction, "top"); } ?>
        <table class="data">
          <thead>
            <tr>
              <?php foreach($fields_array as $field_name) { ?>
                <th class='<?php echo(strtolower(str_replace("_", "-", $field_name))); ?>'>
                  <?php if ($sortable_columns) { 
                    $change_order_direction = "ASC";                    
                    if ($_GET[$table_name."_order_direction"] == "ASC") {
                      $change_order_direction = "DESC";
                    } 
                    ?>
                    <a href='<?php echo($page_name); ?>&<?php echo($table_name); ?>_order_by=<?php echo($field_name); ?>&<?php echo($table_name); ?>_order_direction=<?php echo($change_order_direction); ?>&<?php echo($table_name."_page"); ?>=<?php echo($page_no); ?>&<?php echo($table_name); ?>_filters=<?php echo(implode(",", $filters)); echo($params_filter); ?>'>
                  <?php } ?>
                  <?php echo(tom_titlize_str($field_name)); ?>
                  <?php if ($sortable_columns) {
                    if ($_GET[$table_name."_order_by"] == $field_name) {
                      if ($order_direction == "ASC") {
                        echo ("&#9660;");

                      } else {
                        echo ("&#9650;");
                      }
                    }
                    ?>
                    </a>
                  <?php } ?>
                </th>
              <?php } ?>
            </tr>
          </thead>
          <tbody> 
            <?php foreach($results as $result) { ?>
              <tr>
                <?php foreach($fields_array as $field_name) { ?>
                  <td class='<?php echo(esc_html(strtolower(str_replace("_", "-", $field_name)))); ?>'>
                    <?php 
                      if (tom_is_valid_datetime($result->$field_name)) {
                        echo(date($date_format, strtotime($result->$field_name )));
                      } else {
                        echo($result->$field_name);
                      }
                    ?></td>
                <?php } ?>
                <?php if ($display_show) { ?>
                  <td class='show'><a href="<?php echo($page_name); ?>&action=show&id=<?php echo($result->$primary_key_name); ?>">Show</a></td>
                <?php }?>
                <?php if ($display_edit) { ?>
                  <td  class='edit'><a href="<?php echo($page_name); ?>&action=edit&id=<?php echo($result->$primary_key_name); ?>">Edit</a></td>
                <?php }?>
                <?php if ($display_delete) { ?>
                  <td class='delete'><a class="delete" href="<?php echo($page_name); ?>&action=delete&id=<?php echo($result->$primary_key_name); ?>">Delete</a></td>
                <?php }?>                
              </tr>
            <?php } ?>

          </tbody>
        </table>
        <?php if ($paginate_table) { tom_generate_datatable_pagination($table_name, $total_count, $limit_clause, $page_no, $page_name, $order_direction, "bottom"); } ?>
    <?php } else {

      if (count($filter_arrays) > 0) {
        echo("<p>Sorry no records found, please try change your search preferences.</p>");  
      } else {
        echo("<p>Sorry no records found.</p>");
      }

    }
    echo("</div></div>"); 
  }

}

// This method is used by tom_generate_datatable. Please don't use.
function tom_generate_datatable_pagination($table_name, $total_count, $limit_clause, $tom_page_no, $page_name, $order_direction, $pagination_class) {
  if ($order_direction == "") {
    $order_direction = "ASC";
  } 
  $total_number_pages = intval($total_count / $limit_clause);
    $params_filter = "";
    $filters = explode(",", tom_get_query_string_value($table_name."_filters"));
    $params_filter .= "&".$table_name."_filters=".tom_get_query_string_value($table_name."_filters");
    foreach ($filters as $filter) {
      if (tom_get_query_string_value("filter_".$filter) != "") {
        $params_filter .= "&filter_".$filter."=".tom_get_query_string_value("filter_".$filter);
      }
    }

    ?>
    <ul class="pagination <?php echo($pagination_class); ?>">
      <?php 
      if (!($tom_page_no == "" || $tom_page_no == "0")) { 
        $prev_page_no = ($tom_page_no - 1);
        ?>
        <li><a href="<?php echo ($page_name."&".$table_name."_page"."=".$prev_page_no."&".$table_name."_order_by=".$_GET[$table_name.'_order_by']."&".$table_name."_order_direction=".$order_direction.$params_filter); ?>">Prev</a></li>
      <?php } ?>
      <li>Page 
        <?php if ($tom_page_no != "") {
          echo($tom_page_no+1);
        } else {
          echo "1";
        }
        ?> of 
        <?php
        if (fmod($total_count, $limit_clause) != 0) { ?>
          <?php $total_number_pages = (intval($total_count / $limit_clause)+1); ?></li>
        <?php } 
        echo($total_number_pages);
        if (($tom_page_no+1) < $total_number_pages) { 
          $next_page_no = ($tom_page_no + 1);?>
          <li><a href="<?php echo ($page_name."&".$table_name."_page"."=".$next_page_no."&".$table_name."_order_by=".$_GET[$table_name.'_order_by']."&".$table_name."_order_direction=".$order_direction.$params_filter); ?>">Next</a></li>
        <?php } ?>
    </ul>
  <?php
}

// Generates a definition list with data from a record in the database.
function tom_generate_displayview($table_name, $fields_array, $id_column_name, $id) {
  if (!is_array($fields_array)) {
    echo("Fields Array, can only accept an array of field names.");
  } else {
    $result = tom_get_row_by_id($table_name, $fields_array, $id_column_name, $id);
    echo("<dl>");
    foreach($fields_array as $field) { 
      echo("<dt>".ucwords(esc_html(str_replace("_", " ", $field)))."</dt><dd>".esc_html($result->$field)."</dd>");
    }
    echo("</dl>");
  }
}

// Returns compressed version of $content.
function tom_compress_content($content) {
  /* remove comments */
  $content = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $content);
  /* remove tabs, spaces, newlines, etc. */
  return str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), ' ', $content);
}

// Returns array of query string from a form. Works out the $_POST and $_GET array names from the database table column names.
function tom_get_form_query_strings($table_name, $exclude_fields = array(), $include_field_values = array()) {
  global $wpdb;
  $table_name_prefix = $wpdb->prefix . $table_name;
  $sql = "SHOW columns FROM ".$table_name_prefix;
  $results = $wpdb->get_results($sql);
  $return_array = array();
  foreach ($results as $result) {
    if (!in_array($result->Field, $exclude_fields)) {
      $value = $_POST[$result->Field];
      if (preg_match("/^decimal/i", $result->Type)) {
        $value = str_replace("$", "", $value);
        $value = str_replace(",", "", $value);
      }
      $return_array[$result->Field] = $value;
    }
  }

  return array_merge($return_array, $include_field_values);
}

// Returns true if value passes validation. Used by tom_validate_form.
// $validation = can either be required, integer, currency, date.
// $value = is the value to test against.
// $error_session_name = name of the session to store the error.
function tom_validate_value($validation, $value, $error_session_name) {
  $validate_form = true;
  if (preg_match("/required | required|^required$/i", $validation)) {
    if ($value == "") {
      $_SESSION[$error_session_name] .= " must have a value. ";
      $validate_form = false;
    }
  }

  if ($value != "") {
    if (preg_match("/integer | integer|^integer$/i", $validation)) {
      if (!is_numeric($value)) {
        if (!preg_match("/must be a number/", $_SESSION[$error_session_name])) {
          $_SESSION[$error_session_name] .= " must be a number. ";
        }
        $validate_form = false;
      }
    }

    if (preg_match("/currency | currency|^currency$/i", $validation)) {
      if (!preg_match("/^\\$?([0-9])+(,)?([0-9])*(,)?([0-9])*(\.)?([0-9]){1,2}?$/", $value)) {
        if (!preg_match("/must be a currency/", $_SESSION[$error_session_name])) {
          $_SESSION[$error_session_name] .= " must be a currency (e.g: $1,300,323.00). ";
        }
        $validate_form = false;
      }
    }

    if (preg_match("/date | date|^date$/i", $validation)) {
      if (!tom_is_valid_datetime($value)) {
        if (!preg_match("/must be a date/", $_SESSION[$error_session_name])) {
          $_SESSION[$error_session_name] .= " must be a date. ";
        }
        $validate_form = false;
      }
    }

    if (preg_match("/email | email|^email$/i", $validation)) {
      if (!tom_is_valid_email($value)) {
        if (!preg_match("/must be a valid email address/", $_SESSION[$error_session_name])) {
          $_SESSION[$error_session_name] .= " must be a valid email address. ";
        }
        $validate_form = false;
      }
    }

    if (preg_match("/multi-emails | multi-emails|^multi-emails$/i", $validation)) {
      if (!tom_is_valid_emails($value)) {
        if (!preg_match("/must have valid email addressess, separated by commas/", $_SESSION[$error_session_name])) {
          $_SESSION[$error_session_name] .= " must have valid email addressess, separated by commas. ";
        }
        $validate_form = false;
      }
    }
  }

  return $validate_form;
}

// Returns true if the form submitted is valid, false if not.
function tom_validate_form($validations_array) {
  $validate_form = true;
  foreach ($validations_array as $key => $value) {
    if (is_array(tom_get_query_string_value($key))) {
      $index = 0;
      foreach (tom_get_query_string_value($key) as $sub_value) {
        if (tom_validate_value($value, $sub_value, $key."_".$index."_error") == false) {
          $validate_form = false;
        }
        $index++;
      }
    } else {
      if (preg_match("/required/i", $value) && isset($_POST[$key."_0"])) {

        if (is_array(tom_get_query_string_value($key."_0"))) {
          // For checkbox fields.
          $index = 0;
          foreach ($_POST["validation_0"] as $row) {
            # code...
            $i = 0;
            $data = "";
            do {
              $data .= $_POST[$key."_".$i][$index];
              if ($data != "") {
                $data .= " ";
              }
              $i++;
            } while (isset($_POST[$key."_".$i][$index]));
            
            if (tom_validate_value($value, $data, $key."_".$index."_error") == false) {
              echo $index;
              $validate_form = false;
            }
            $index++;
          }
        } else {
          // For other fields like text, textarea, etc.
          $i = 0;
          $data = "";
          do {
            $data .= $_POST[$key."_".$i];
            if ($data != "") {
              $data .= " ";
            }
            $i++;
          } while (isset($_POST[$key."_".$i]));
          if (tom_validate_value($value, $data, $key."_error") == false) {
            $validate_form = false;
          }
        }
      } else {
        if (tom_validate_value($value, tom_get_query_string_value($key), $key."_error") == false) {
          $validate_form = false;
        }
      }
    }

  }
  return $validate_form;
}

function tom_check_captcha($captcha_field_name) {
  $securimage = new Securimage();
  if ($securimage->check($_POST[$captcha_field_name]) == false) {
    $_SESSION[$captcha_field_name."_error"] = "invalid captcha code, try again!";
    return false;
  } else {
    return true;
  }
}

// Adds a form field to the page.
function tom_add_form_field($instance, $field_type, $field_label, $field_id, $field_name, $field_attributes = array(), $container_element, $container_attributes = array(), $value_options = array(), $field_index = -1) {
  
  $field_content = "";
  foreach ($field_attributes as $key => $value) {
    $field_content .= "$key='$value' ";
  }
  $container_content = "";
  foreach ($container_attributes as $key => $value) {
    $container_content .= "$key='$value' ";
  }
  
  if ($instance == null && preg_match("/^tomm8te_admin_option::/", $field_name)) {
    $field_name = str_replace("tomm8te_admin_option::", "", $field_name);
    $field_value = get_option($field_name);
    if (count($_POST) > 0) {
      if ($field_index >= 0) {
        $field_value = tom_get_query_string_value($field_name, $field_index);
      } else {
        $field_value = tom_get_query_string_value($field_name);
      }
    }
  } else {
    $field_value = $instance->$field_name;
    if ($instance == null || count($_POST) > 0) {
      if ($field_index >= 0) {
        $field_value = tom_get_query_string_value($field_name, $field_index);
      } else {
        $field_value = tom_get_query_string_value($field_name);
      }
    }
  }
  
  $field_id_with_without_index = $field_id;
  $field_name_with_without_array = $field_name;
  $field_checkbox_array = "";
  if ($field_index >= 0) {
    $field_checkbox_array = "[".$field_index."]";
    $field_name_with_without_array .= "[]";
    $field_id_with_without_index .= "_".$field_index;
  }

  $field_type = strtolower($field_type);

  if (!is_array($field_value)) {
    $field_value = str_replace("&amp;", "&", htmlentities(htmlentities($field_value, ENT_NOQUOTES), ENT_QUOTES)); 
  }

  if ($field_type != "hidden") {
    echo("<$container_element $container_content>");
    if ($field_label != "") {
      if ($field_type == "checkbox") {
        echo("<label>".$field_label."<span class='colon'>:</span></label>");
      } else if ($field_type == "placeholder_text" || $field_type == "placeholder_textarea") {
        // Do nothing
      } else {
        echo("<label for='$field_id_with_without_index'>".$field_label."<span class='colon'>:</span></label>");
      }
    }
  }
  if ($field_type == "text") {
    echo("<input type='text' id='$field_id_with_without_index' name='$field_name_with_without_array' value='$field_value' $field_content />");
  } else if ($field_type == "hidden") {
    echo("<input type='hidden' id='$field_id_with_without_index' name='$field_name_with_without_array' value='$field_value' $field_content />");
  } else if ($field_type == "placeholder_text") {
    echo("<input type='text' id='".$field_id_with_without_index."' name='$field_name_with_without_array' value='$field_value' $field_content placeholder='".strip_tags($field_label)."' />");
  } else if ($field_type == "file") {
    echo("<input type='file' id='$field_id_with_without_index' name='".$field_name."[]' value='$field_value' $field_content />");
  } else if ($field_type == "textarea") {
    echo("<textarea id='$field_id_with_without_index' name='$field_name_with_without_array' ".$field_content.">$field_value</textarea>");
  } else if ($field_type == "placeholder_textarea") {
    echo("<textarea id='$field_id_with_without_index' name='$field_name_with_without_array' ".$field_content." placeholder='".strip_tags($field_label)."'>".$field_value."</textarea>");
  } else if ($field_type == "captcha") {
    echo("<img id='$field_id_with_without_index' src='".get_option("siteurl")."/wp-content/plugins/tom-m8te/securimage/securimage_show.php' />");
    echo("<a href='#' onclick=\"document.getElementById('".$field_id_with_without_index."').src = '".get_option("siteurl")."/wp-content/plugins/tom-m8te/securimage/securimage_show.php?' + Math.random(); return false\">[ Different Image ]</a><input type='text' name='".$field_name."' size='10' maxlength='6' />");
  } else if ($field_type == "select") {
    echo("<select id='$field_id_with_without_index' name='$field_name_with_without_array' ".$field_content.">");
    foreach($value_options as $key => $option) {
      if ($field_value == $key) {
        if ($key == "") {
          echo("<option selected label='Please Select Option'></option>");
        } else {
          echo("<option value='$key' selected>$option</option>");
        }
      } else {
        if ($key == "") {
          echo("<option label='Please Select Option'></option>");
        } else {
          echo("<option value='$key'>$option</option>");
        }
      }
    } 
    echo("</select>");
  } else if ($field_type == "radio") {
    echo("<ul class='options'>");
    foreach($value_options as $key => $option) {
      $checked_value = "";
      if ($field_value == $key) {
        $checked_value = "checked";
      }
      echo("<li><input type='radio' id='".$field_name."_".$field_id_with_without_index."_".$key."' name='$field_name_with_without_array' value='$key' ".$field_content." ".$checked_value." /><label for='".$field_name."_".$field_id_with_without_index."_".$key."'>$option</label></li>");
    }
    echo("</ul>");
  } else if ($field_type == "checkbox") {
    echo("<ul class='options'>");
    if (count($value_options) == 1) {
      echo("<li><input type='hidden' name='".$field_name.$field_checkbox_array."' value='' />");
      $checked_value = "";
      foreach($value_options as $key => $option) {
        if ($field_value == $key) {
          $checked_value = "checked";
        }
        echo("<input type='checkbox' ".$checked_value." id='".$field_name."_".$field_id_with_without_index."_".$key."' name='".$field_name.$field_checkbox_array."' value='$key' ".$field_content." /><label for='".$field_name."_".$field_id_with_without_index."_".$key."'>$option</label></li>");
      }        
    } else if (count($value_options) > 1) {
      $i = 0;
      foreach($value_options as $key => $option) {
        echo("<li><input type='hidden' name='".$field_name."_".$i.$field_checkbox_array."' value='' />");

        $field_value = tom_get_query_string_value($field_name."_".$i, $field_index);
        $field_value = str_replace("&amp;", "&", htmlentities(htmlentities($field_value, ENT_NOQUOTES), ENT_QUOTES));
        $checked_value = "";
				if (count($_POST) == 0) {
	        if ($field_value == $key || (($field_value == "") && preg_match("/".$key." | ".$key."|^".$key."$/i", $instance->$field_name) )) {
	          $checked_value = "checked";
	        }
				}

        if ($field_value == $key) {
          $checked_value = "checked";
        }

        echo("<input type='checkbox' ".$checked_value." id='".$field_name."_".$field_id_with_without_index."_".$key."' name='".$field_name."_".$i.$field_checkbox_array."' value='$key' ".$field_content." /><label for='".$field_name."_".$field_id_with_without_index."_".$key."'>".$option."</label></li>");
        $i++;
      }   
    }
    echo("</ul>");

  }

  if ($field_index >= 0) {
    $field_id = $field_id."_".$field_index;
  }
  if ($_SESSION[$field_id."_error"] != "") {
    echo "<span class='error'>".$_SESSION[$field_id."_error"]."</span>";
  }
  unset($_SESSION[$field_id."_error"]);

  if ($field_type != "hidden") {
    echo("</$container_element>");
  }
}

// Adds a form field to the page. Only difference is the value is from the Wordpress get_option database table. Example get_option("siteurl").
function tom_add_option_form_field($field_type, $field_label, $field_id, $option_name, $field_attributes = array(), $container_element, $container_attributes = array(), $value_options = array(), $field_index = -1) {

  tom_add_form_field(null, $field_type, $field_label, $field_id, "tomm8te_admin_option::".$option_name, $field_attributes, $container_element, $container_attributes, $value_options, $field_index);
}

// Creates the option in the database if it doesn't exist. For example: tom_create_option_if_not_exist("plugin_version_no").
function tom_create_option_if_not_exist($option_name) {
  if (!get_option($option_name)) {
    add_option($option_name);
  }
}

// Creates a MySQL database table. Returns a create table sql query object.
function tom_create_table($table_name, $fields_array_with_datatype, $primary_key_array) {
  global $wpdb;
  $table_name_prefix = $wpdb->prefix . $table_name;
  $fields_comma_separated = implode(",", $fields_array_with_datatype);
  $primary_key_comma_separated = implode(",", $primary_key_array);
  $primary_key_text = ", PRIMARY KEY  ($primary_key_comma_separated)";
  if (count($primary_key_array) > 1) {
    $primary_key_text = ", UNIQUE KEY ".$primary_key_array[0]." ($primary_key_comma_separated)";
  }
  
  $sql = "CREATE TABLE $table_name_prefix ($fields_comma_separated  $primary_key_text);";
  return dbDelta($sql);
}

// Adds fields to a MySQL Database table. Returns a alter table sql query object.
function tom_add_fields_to_table($table_name, $fields_array_with_datatype) {
  global $wpdb;
  $table_name_prefix = $wpdb->prefix . $table_name;
  $fields_comma_separated = implode(",", $fields_array_with_datatype);
  $sql = "ALTER TABLE $table_name_prefix ADD $fields_comma_separated";
  return $wpdb->query($sql);
}

// Run before making inserts and updates and then you can later rollback or commit a transaction.
function tom_start_transaction($transaction_id) {
  global $wpdb;
  global $wp_transaction_id;
  if ( !isset($wp_transaction_id) ) {
    $wp_transaction_id = $transaction_id;
    $wpdb->query("START TRANSACTION;");
  }
}

// Rollback transaction.
function tom_rollback_transaction($transaction_id) {
  global $wpdb;
  global $wp_transaction_id;
  if ( isset($wp_transaction_id) && $wp_transaction_id == $transaction_id ) {
    unset($wp_transaction_id);
    $wpdb->query("ROLLBACK;");
  }
}

// Commit a transaction.
function tom_commit_transaction($transaction_id) {
  global $wpdb;
  global $wp_transaction_id;
  if ( isset($wp_transaction_id) && $wp_transaction_id == $transaction_id ) {
    unset($wp_transaction_id);
    $wpdb->query("COMMIT;");
  }
}

// Inserts data into the database.  Returns true if inserted correct, false if not.
function tom_insert_record($table_name, $insert_array) {
  global $wpdb;
  ob_start();
  $wpdb->show_errors();
  $table_name_prefix = $wpdb->prefix.$table_name;
  $result = $wpdb->insert($table_name_prefix, $insert_array);
  $wpdb->print_error();
  $errors = ob_get_contents();
  ob_end_clean();

  if (preg_match("/<strong>WordPress database error:<\/strong> \[\]/", $errors)) {
    return true;
  } else {
    $sql = "SHOW INDEXES FROM $table_name_prefix WHERE non_unique =0 AND Key_name !=  'PRIMARY'";
    $results = $wpdb->get_results($sql);
    foreach ($results as $result) {
      $col_name = $result->Column_name;
      if (preg_match("/Duplicate entry (.+)&#039;".$col_name."&#039;]/", $errors, $matches, PREG_OFFSET_CAPTURE)) {

				if (!preg_match("/Must have a unique value/", $_SESSION[$col_name."_error"])) {
				  $_SESSION[$col_name."_error"] .= "Must have a unique value.";
        }

      }
    }
    return false;
  }
}

// Updates data in the database. Returns true if updated correctly, false if not.
function tom_update_record_by_id($table_name, $update_array, $id_column_name, $id) {
  global $wpdb;
  ob_start();
  $wpdb->show_errors();
  $table_name_prefix = $wpdb->prefix.$table_name;
  $result = $wpdb->update($table_name_prefix, $update_array, array($id_column_name => $id));
  $wpdb->print_error();
  $errors = ob_get_contents();
  ob_end_clean();

  if (preg_match("/<strong>WordPress database error:<\/strong> \[\]/", $errors)) {
    return true;
  } else {
    $sql = "SHOW INDEXES FROM $table_name_prefix WHERE non_unique =0 AND Key_name !=  'PRIMARY'";
    $results = $wpdb->get_results($sql);
    foreach ($results as $result) {
      $col_name = $result->Column_name;
      if (preg_match("/Duplicate entry (.+)&#039;".$col_name."&#039;]/", $errors, $matches, PREG_OFFSET_CAPTURE)) {
				if (!preg_match("/Must have a unique value/", $_SESSION[$col_name."_error"])) {
				  $_SESSION[$col_name."_error"] .= "Must have a unique value.";
        }
      }
    }
    return false;
  }
}

// Similar to tom_update_record_by_id, but you have more control over which record to update. Returns true if updated correctly, false if not.
function tom_update_record($table_name, $update_array, $where_array) {
  global $wpdb;
  ob_start();
  $wpdb->show_errors();
  $table_name_prefix = $wpdb->prefix.$table_name;
  $result = $wpdb->update($table_name_prefix, $update_array, $where_array);
  $wpdb->print_error();
  $errors = ob_get_contents();
  ob_end_clean();

  if (preg_match("/<strong>WordPress database error:<\/strong> \[\]/", $errors)) {
    return true;
  } else {
    $sql = "SHOW INDEXES FROM $table_name_prefix WHERE non_unique =0 AND Key_name !=  'PRIMARY'";
    $results = $wpdb->get_results($sql);
    foreach ($results as $result) {
      $col_name = $result->Column_name;
      if (preg_match("/Duplicate entry (.+)&#039;".$col_name."&#039;]/", $errors, $matches, PREG_OFFSET_CAPTURE)) {
				if (!preg_match("/Must have a unique value/", $_SESSION[$col_name."_error"])) {
				  $_SESSION[$col_name."_error"] .= "Must have a unique value.";
        }
      }
    }
    return false;
  }
}

// Deletes a record from the database. Returns a sql delete query object.
function tom_delete_record_by_id($table_name, $id_column_name, $delete_id) {
  global $wpdb;
  $table_name_prefix = $wpdb->prefix.$table_name;
  return $wpdb->query($wpdb->prepare("DELETE FROM $table_name_prefix WHERE $id_column_name = %d", $delete_id));
}

// Similar to tom_delete_record_by_id, but more flexibility with selecting the record that you want to delete.
function tom_delete_record($table_name, $where_sql) {
  global $wpdb;
  $table_name_prefix = $wpdb->prefix.$table_name;
  return $wpdb->query("DELETE FROM $table_name_prefix WHERE $where_sql");
}

// Get total record count from database table.
// $table_name = (string) The name of table you wish to find the record count for, without the prefix. The prefix is auto added in for you. 
// $where_sql = (string)(optional) The SQL Where clause without the keyword WHERE.
function tom_get_record_count($table_name, $where_sql = "") {
  global $wpdb;
  $table_name_prefix = $wpdb->prefix.$table_name;

  if (!empty($where_sql)) {
    $where_sql = "WHERE ".$where_sql;
  }
  $sql = "SELECT COUNT(*) as count FROM $table_name_prefix $where_sql";
  // echo $sql;
  return $wpdb->get_row($sql)->count;
}

// Select records from the database. Returns sql results object.
function tom_get_results($table_name, $fields_array, $where_sql, $order_array = array(), $limit = "") {
  global $wpdb;
  $table_name_prefix = $wpdb->prefix.$table_name;
  if ($fields_array == "*") {
    $fields_comma_separated = "*";
  } else {
    $fields_comma_separated = implode(",", $fields_array);
  }

  if (!empty($where_sql)) {
    $where_sql = "WHERE ".$where_sql;
  }
  $order_sql = "";
  if (!empty($order_array)) {
    $order_sql = "ORDER BY ".implode(",", $order_array);
  }
  $limit_sql = "";
  if ($limit != "") {
    $limit_sql = "LIMIT $limit";
  }
  $sql = "SELECT $fields_comma_separated FROM $table_name_prefix $where_sql $order_sql $limit_sql";
  // echo $sql;
  return $wpdb->get_results($sql);
}

// Selects a record from the database. Returns one sql record result object.
function tom_get_row_by_id($table_name, $fields_array, $id_column_name, $id) {
  global $wpdb;
  $table_name_prefix = $wpdb->prefix.$table_name;
  if ($fields_array == "*") {
    $fields_comma_separated = "*";
  } else {
    $fields_comma_separated = implode(",", $fields_array);
  }
  return $wpdb->get_row($wpdb->prepare("SELECT $fields_comma_separated FROM $table_name_prefix  WHERE $id_column_name = %d", $id));
}

// Similar to tom_get_row_by_id, but more flexibility with selecting the record that you want.
function tom_get_row($table_name, $fields_array, $where_sql) {
  global $wpdb;
  $table_name_prefix = $wpdb->prefix.$table_name;
  if ($fields_array == "*") {
    $fields_comma_separated = "*";
  } else {
    $fields_comma_separated = implode(",", $fields_array);
  }
  return $wpdb->get_row("SELECT $fields_comma_separated FROM $table_name_prefix WHERE $where_sql LIMIT 1");
}

?>