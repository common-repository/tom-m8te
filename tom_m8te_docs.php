<style>
  table {
    border-collapse: collapse;
  }
  table td {
    border: 1px solid #000;
  }
  table th {
    text-align: left;
  }
  table th, table td {
    vertical-align: top;
    padding: 10px;
  }
  table th p, table td p {
    margin: 0 0 10px 0;
    padding: 0;
  }
</style>
<h2>Tom M8te</h2>
<div class="postbox " style="display: block; ">
<div class="inside">

		<table class="data">
		  <thead>
		    <tr>
		      <th>Method name</th>
		      <th>Parameters</th>
		      <th>Description</th>
		    </tr>
		  </thead>
			<tbody>	
        <tr>
          <td>
            tom_get_month_list()
          </td>
          <td>
            <p></p>
          </td>
          <td>
            Returns an array of months of the year.
          </td>
        </tr>

        <tr>
          <td>
            tom_add_social_share_links($url)
          </td>
          <td>
            <p>$url = (string) The url of a site you wish for your users to share.</p>
          </td>
          <td>
            Creates a share website link for Facebook and Twitter.
          </td>
        </tr>

        <tr>
          <td>
            tom_write_to_file($write_content, $location)
          </td>
          <td>
            <p>$write_content = (string) Content to save to file.</p>
            <p>$location = (string) The physical file location of the file to save the content to.</p>
          </td>
          <td>
            Save content to a file.
          </td>
        </tr>

        <tr>
          <td>
            tom_write_to_htaccess_file($rule_name, $content)
          </td>
          <td>
            <p>$rule_name = (string) WP ERROR LOG</p>
            <p>$content = (string) The htaccess content to add. Example: <pre><Files error_log>\norder allow,deny\ndeny from all\n</Files>\nphp_flag  log_errors on\nphp_value error_log error_log</pre></p>
          </td>
          <td>
            <pre>
Write content to the htaccess file. 

This line: 
tom_write_to_htaccess_file("WP ERROR LOG", "<Files error_log>\norder allow,deny\ndeny from all\n</Files>\nphp_flag  log_errors on\nphp_value error_log error_log");

Will write: 

#BEGIN WP ERROR LOG
php_flag  log_errors on
php_value error_log error_log
#END WP ERROR LOG

in your htaccess file.
            </pre>
          </td>
        </tr>

        <tr>
          <td>
            tom_is_file_writable($file)
          </td>
          <td>
            <p>$file = (string) Path to file to test.</p>
          </td>
          <td>
            Returns true if the file is writable, false if it isn't.
          </td>
        </tr>

        <tr>
          <td>
            tom_is_file_readable($file)
          </td>
          <td>
            <p>$file = (string) Path to file to test.</p>
          </td>
          <td>
            Returns true if the file is readable, false if it isn't.
          </td>
        </tr>

        <tr>
          <td>
            tom_javascript_redirect_to($url, $non_javscript_content = "")
          </td>
          <td>
            <p>$url = (string) The url to direct the page to.</p>
            <p>$non_javscript_content = (string)(optional) Textual content for those who do not have javascript enabled.</p>
          </td>
          <td>
            Redirects the page to a particular url using javascript. Sometimes this is easier then using php redirect, because of the headers sent issue.
          </td>
        </tr>

        <tr>
          <td>
            tom_titlize_str($str)
          </td>
          <td>
            <p>$str = (string) The string you wish to titlize.</p>
          </td>
          <td>
            Titlizes a string. For example: status_level would become Status Level.
          </td>
        </tr>

        <tr>
          <td>
            tom_is_valid_datetime($datetime)
          </td>
          <td>
            <p>$datetime = (string) The string to test for datetime.</p>
          </td>
          <td>
            Checks to see if the parameter is a datetime. Returns true if its a date or datetime, False if its not.
          </td>
        </tr>

        <tr>
          <td>
            tom_is_valid_email($email)
          </td>
          <td>
            <p>$email = (string) The string to test for email.</p>
          </td>
          <td>
            Checks to see if the parameter is an email. Returns true if its a email, False if its not.
          </td>
        </tr>

        <tr>
          <td>
            tom_is_valid_emails($emails)
          </td>
          <td>
            <p>$email = (string) The string to test for emails, separated by commas. Example: test@test.com.au,joke@hotmail.com</p>
          </td>
          <td>
            Returns true if the parameter contains a list of emails separated by commas.
          </td>
        </tr>

        <tr>
          <td>
            tom_get_query_string_value($name, $index)
          </td>
          <td>
            <p>$name = (string) The name of the query string value, It can be the name of $_POST or $_GET, but $_POST takes precidence.</p>
            <p>$index = (integer)(optional) Default = -1. Index number of the query string array item.</p>
          </td>
          <td>
            Basically gets the value from query string without having to use $_POST or $_GET variables. $_POST takes precidence over $_GET. 
          </td>
        </tr>

        <tr>
          <td>
            tom_fix_http_quotes($http_data)
          </td>
					<td>
						<p>$http_data = (string) The post/get data.</p>
					</td>
					<td>Fixes up http post/get variables so that they present quotes correctly rather then like (\').
					</td>
				</tr>

        <tr>
          <td>
            tom_upload_file($field_name)
          </td>
          <td>
            <p>$field_name = (string) The name of file input field.</p>
          </td>
          <td>
            Allows you to upload a file.
          </td>
        </tr>

        <tr>
          <td>
            tom_send_email($is_html, $to_emails, $to_cc_emails, $to_bcc_emails, $from_email, $from_name, $subject, $body, $alt_body = "", $attachments = array(), $smtp_auth = false, $smtp_mail_host = "", $smtp_mail_port = "", $smtp_mail_username = "", $smtp_mail_password = "", $secure_array = array())
          </td>
          <td>
            <p>$is_html = (boolean) True if you want to send HTML emails, False if you just want to send text emails.</p>
            <p>$to_emails = (string) or (array) Can be a string of emails to send to separated by commas or array of email addresses. Example: ("test@test.com", "joke@hotmail.com") or (array("test@test.com" => "Test Mate", "joke@hotmail.com" => "Joker Name")).</p>
            <p>$to_cc_emails = (string) or (array) Can be a string of emails to send to separated by commas or array of email addresses. Example: ("test@test.com", "joke@hotmail.com") or (array("test@test.com" => "Test Mate", "joke@hotmail.com" => "Joker Name")).</p>
            <p>$to_bcc_emails = (string) or (array) Can be a string of emails to send to separated by commas or array of email addresses. Example: ("test@test.com", "joke@hotmail.com") or (array("test@test.com" => "Test Mate", "joke@hotmail.com" => "Joker Name")).</p>
            <p>$from_email = (string) The email address of the sender.</p>
            <p>$from_name = (string) The name of the sender.</p>
            <p>$subject = (string) The subject of the email.</p>
            <p>$body = (string) The actual email.</p>
            <p>$alt_body = (string) Content that appears if HTML is not supported.</p>
            <p>$attachments = (array)(optional) Array of attachments. Example array("img/logo.png", "img/attachment.jpg").</p>
            <p>$smtp_auth = (boolean)(optional) Use smtp authentication and use your smtp server instead of built in PHP.</p>
            <p>$smtp_mail_host = (string)(optional) Mail host. Example: mail.domain.com.au.</p>
            <p>$smtp_mail_port = (string)(optional) Your smtp port. Usually 25.</p>
            <p>$smtp_mail_username = (string)(optional) Your smtp username.</p>
            <p>$smtp_mail_password = (string)(optional) Your smtp password.</p>
						<p>$secure_array = (Array)(optional) Array of security algorithms used by your SMTP server. Example array("tls"), array("ssl") or array("tls", "ssl"). "tls" and "ssl" are the only two values acceptable for this parameter.</p>
          </td>
          <td>
            Allows you to send an email. Returns a success or error messages.
          </td>
        </tr>

        <tr>
          <td>
            tom_generate_datatable($table_name, $fields_array, $primary_key_name, $where_clause, $order_array = array(), $limit_clause = "", $page_name, $display_show = true, $display_edit = true, $display_delete = true, $sortable_columns = false, $paginated_table = false, $date_format = "Y-m-d")
          </td>
          <td>
            <p>$table_name = (string) The name of table to create, without the prefix. The prefix is auto added in for you.</p>
            <p>$fields_array = (array) An array of field names will be selected as part of the sql query. For example: array("id", "name", "address").</p>
            <p>$primary_key_name = (string) Name of primary key field. Needs to be in the $fields_array.</p>
            <p>$where_clause = (string)(optional) The SQL Where clause without the keyword WHERE.</p>
            <p>$order_array = (array)(optional) An array of fields you wish to order the records by with order direction. For example: array("id DESC", "name ASC"). If null, there will be no order.</p>
            <p>$limit_clause = (integer)(optional) The number of records to limit by. If null, there is no limit and will select all records based on $where_array.</p>
            <p>$page_name = (string)(optional) The name of the page you want the show,edit,delete, pagination links to link to. get_option("siteurl")."/wp-admin/admin.php?page=-form/-form.php".</p>
            <p>$display_show = (boolean)(optional) Make show links visible. Default is true, It appends &action=show&id={{record_id}} to the link.</p>
            <p>$display_edit = (boolean)(optional) Make show links visible. Default is true, It appends &action=edit&id={{record_id}} to the link.</p>
            <p>$display_delete = (boolean)(optional) Make show links visible. Default is true, It appends &action=delete&id={{record_id}} to the link.</p>
            <p>$sortable_columns = (boolean)(optional) Make columns sortable. Default is false.</p>
            <p>$paginate_table = (boolean)(optional) Add pagination to the table. Default is false. The number of records per page is controlled by $limit_clause.</p>
            <p>$date_format = (string)(optional) You can change the format of your dates. Default is Y-m-d.</p>
            <p>$filter_array = (array)(optional) You can set up a filter system. Default is no filter. For example: array(
          array("status" => 
            array("type" => "select", "value_options" => 
              array("" => "", "Draft" => "Draft", "Published" => "Published")
            )
          ),
          array("suburb" => 
            array("type" => "text")
          )
        ). Type can be text, select, radio, etc and option_values is only applicable to select, radio and checkbox.</p>
          </td>
          <td>
            Generates a datatable with show, edit and delete links.
          </td>
        </tr>

        <tr>
          <td>
            tom_generate_displayview($table_name, $fields_array, $id_column_name, $id)
          </td>
          <td>
            <p>$table_name = (string) The name of table to create, without the prefix. The prefix is auto added in for you.</p>
            <p>$fields_array = (array) An array of field names will be selected as part of the sql query. For example: array("id", "name", "address").</p>
            <p>$id_column_name = (string) Name of primary key field. Needs to be in the $fields_array.</p>
            <p>$id = (integer) The id value of the record you wish to display.</p>
          </td>
          <td>
            Generates a definition list with data from a record in the database.
          </td>
        </tr>

        <tr>
          <td>
            tom_compress_content($content)
          </td>
          <td>
            <p>$content = (string) The content you wish to compress.</p>
         </td>
          <td>
            Returns compressed version of $content.
          </td>
        </tr>

        <tr>
          <td>
            tom_get_form_query_strings($table_name, $exclude_fields = array(), $include_field_values = array()
          </td>
          <td>
            <p>$table_name = (string) The name of table to create, without the prefix. The prefix is auto added in for you.</p>
            <p>$exclude_fields = (array)(optional) Array of field names to exclude in query string. For example: array("confirm_date", "active").</p>
            <p>$exclude_fields = (array)(optional) Array of query string values to include. For example: array("updated_at" => $current_datetime, "created_at" => $current_datetime).</p>
         </td>
          <td>
            Returns array of query strings from a form. Works out the $_POST and $_GET array names from the database table column names.

            Example: 

            <pre>
              tom_update_record_by_id("ventura_feedback_forms", 
                tom_get_form_query_strings("ventura_feedback_forms", array("created_at", "updated_at"), array("updated_at" => gmdate( 'Y-m-d H:i:s'))), "ID", $_POST["ID"]);
            </pre>
          </td>
        </tr>


        <tr>
          <td>
            tom_validate_form($validations_array)
          </td>
          <td>
            <p>$validation_array = (array) Array of validation. Example: array("project_number" => "required", "completion_date" => "required date", "rating" => "integer"). The key is the field name and the value is the type of validation. Currently the method can only accept required, integer, currency and date validation.</p>
         </td>
          <td>
            Returns true if the form submitted is valid, false if not. When a form field is invalid, it adds an error message to your tom_add_form_field method.
            Example:

            <pre>
            $array_validation_rules = array("project_number" => "required", "completion_date" => "required date", "rating" => "integer", "start_price" => "currency");
            if (isset($_POST["action"])) {
              if ($_POST["action"] == "Update") {
                if (tom_validate_form($array_validation_rules)) {
                  tom_update_record_by_id("_forms", 
                    tom_get_form_query_strings("_forms", array("created_at", "updated_at"), array("updated_at" => gmdate( 'Y-m-d H:i:s'))), "ID", $_POST["ID"]);
                  header("Location: ".get_option("siteurl")."/wp-admin/admin.php?page=-form/-form.php&message=Update Complete");
                }
              }
              if ($_POST["action"] == "Create") {
                if (tom_validate_form($array_validation_rules)) {
                  $current_datetime = gmdate( 'Y-m-d H:i:s');
                  tom_insert_record("_forms", 
                    tom_get_form_query_strings("_forms", array("ID", "created_at", "updated_at"), array("updated_at" => $current_datetime, "created_at" => $current_datetime)));
                  header("Location: ".get_option("siteurl")."/wp-admin/admin.php?page=-form/-form.php&message=Record Created");
                }
              }
            }
            </pre>
          </td>
        </tr>

        <tr>
          <td>
            tom_check_captcha($captcha_field_name)
          </td>
          <td>
            <p>$captcha_field_name = (string) The name of the captcha field name.</p>
          </td>
          <td>
            Returns true if you entered in the correct captcha security code.
          </td>
        </tr>

        <tr>
          <td>
            tom_add_form_field($instance, $field_type, $field_label, $field_id, $field_name, $field_attributes, $container_element, $container_attributes, $value_options)
          </td>
          <td>
            <p>$instance = (object) The wordpress sql record object (tom_get_row_by_id(...)). Pass null when create a form for creating record.</p>
            <p>$field_type = (string) The field type. Can only accept one these values: hidden, text, placeholder_text, textarea, placeholder_textarea, select, radio, file, captcha or checkbox.</p>
            <p>$field_label = (string) The name of the label for the form field.</p>
            <p>$field_id = (string) The id name of the field.</p>
            <p>$field_name = (string) The name of the field, can be the same as $field_id.</p>
            <p>$field_attributes = (array) Array of attributes for the field. Example: array("class" => "cool", "style" => "display: none;").</p>
            <p>$container_element = (string) The element that will contain the field. For example: "p".</p>
            <p>$container_attributes = (array) Similiar to $field_attributes, but for the container element.</p>
            <p>$value_options = (array)(optional) Array of values for select, radio and checkbox fields. The key is the value set in the database and the value is the field value.</p>
            <p>$field_index = (integer)(optional) Only give an index if you want the field to be an array. If you give an index, the field name will have "[]" added to the end of it and the id name of the field will include the field index.</p>
         </td>
          <td>
            Adds a form field to the page.
          </td>
        </tr>

        <tr>
          <td>
            tom_add_option_form_field($field_type, $field_label, $field_id, $option_name, $field_attributes, $container_element, $container_attributes, $value_options)
          </td>
          <td>
            <p>$field_type = (string) The field type. Can only accept one these values: hidden, text, textarea, select, radio, file, captcha or checkbox.</p>
            <p>$field_label = (string) The name of the label for the form field.</p>
            <p>$field_id = (string) The id name of the field.</p>
            <p>$option_name = (string) The name of the Wordpress get_option. Example siteurl.</p>
            <p>$field_attributes = (array) Array of attributes for the field. Example: array("class" => "cool", "style" => "display: none;").</p>
            <p>$container_element = (string) The element that will contain the field. For example: "p".</p>
            <p>$container_attributes = (array) Similiar to $field_attributes, but for the container element.</p>
            <p>$value_options = (array)(optional) Array of values for select, radio and checkbox fields. The key is the value set in the database and the value is the field value.</p>
            <p>$field_index = (integer)(optional) Only give an index if you want the field to be an array. If you give an index, the field name will have "[]" added to the end of it and the id name of the field will include the field index.</p>
         </td>
          <td>
            Adds a form field to the page. Only difference is the value is from the Wordpress get_option database table. Example get_option("siteurl").
          </td>
        </tr>

        <tr>
          <td>
            tom_create_option_if_not_exist($option_name)
          </td>
          <td>
            <p>$option_name = (string) The name of the option you wish to create.</p>
         </td>
          <td>
            Creates the option in the database if it doesn't exist. For example: tom_create_option_if_not_exist("plugin_version_no").
          </td>
        </tr>

        <tr>
          <td>
            tom_create_table($table_name, $fields_array_with_datatype, $primary_key_array)
          </td>
          <td>
            <p>$table_name = (string) The name of table to create, without the prefix. The prefix is auto added in for you.</p>
            <p>$fields_array_with_datatype = (array) A named array of field names with datatype. For example: array("post_id mediumint(9) NOT NULL", "revision_id mediumint(9) NOT NULL")</p>
            <p>$primary_key_array = (array) A named array of primary key names. For example: array("post_id", "url")</p>
          </td>
          <td>
            Creates a MySQL database table. Returns a create table sql query object.
          </td>
        </tr>
        
        <tr>
          <td>
            tom_add_fields_to_table($table_name, $fields_array_with_datatype)
          </td>
          <td>
            <p>$table_name = (string) The name of table to edit, without the prefix. The prefix is auto added in for you.</p>
            <p>$fields_array_with_datatype = (array) A named array of fields to add to table with datatype. For example: array("post_id mediumint(9) NOT NULL", "revision_id mediumint(9) NOT NULL")</p>
          </td>
          <td>
            Adds fields to a MySQL Database table.  Returns a alter table sql query object.
          </td>
        </tr>

        <tr>
          <td>
            tom_start_transaction($transaction_id)
          </td>
          <td>
            <p>$transaction_id = (string)(integer) A unique transaction id.</p>
          </td>
          <td>
            Use before updating or inserting data, so that afterwards you can rollback or commit your changes.
          </td>
        </tr>

        <tr>
          <td>
            tom_rollback_transaction($transaction_id)
          </td>
          <td>
            <p>$transaction_id = (string)(integer) The same transaction id you used in tom_start_transaction.</p>
          </td>
          <td>
            Rollsback the database changes after calling tom_start_transaction($transaction_id).
          </td>
        </tr>

        <tr>
          <td>
            tom_commit_transaction($transaction_id)
          </td>
          <td>
            <p>$transaction_id = (string)(integer) The same transaction id you used in tom_start_transaction.</p>
          </td>
          <td>
            Commits the database changes after calling tom_start_transaction($transaction_id).
          </td>
        </tr>

        <tr>
          <td>
            tom_insert_record($table_name, $insert_array)
          </td>
          <td>
            <p>$table_name = (string) The name of table to add records to, without the prefix. The prefix is auto added in for you.</p>
            <p>$insert_array = (array) A named array of data to insert (in column => value pairs). For example: array("post_id" => 40, "url" => "http://www.google.com.au")</p>
          </td>
          <td>
            Inserts data into the database.  Returns true if inserted correctly, false if not.
          </td>
        </tr>

        <tr>
          <td>
            tom_update_record_by_id($table_name, $update_array, $id_column_name, $id)
          </td>
          <td>
            <p>$table_name = (string) The name of table you wish to update, without the prefix. The prefix is auto added in for you.</p>
            <p>$update_array = (array) A named array of data to update (in column => value pairs). For example: array("post_id" => 40, "url" => "http://www.google.com.au")</p>
            <p>$id_column_name = (string) Name of the primary key</p>
            <p>$id = (integer) The primary key id value of the record you wish to update.</p>
          </td>
          <td>
            Updates data in the database. Returns true if updated correctly, false if not.
          </td>
        </tr>

        <tr>
          <td>
            tom_update_record($table_name, $update_array, $where_array)
          </td>
          <td>
            <p>$table_name = (string) The name of table you wish to update, without the prefix. The prefix is auto added in for you.</p>
            <p>$update_array = (array) A named array of data to update (in column => value pairs). For example: array("post_id" => 40, "url" => "http://www.google.com.au")</p>
            <p>$where_array = (array) A named array of WHERE clauses (in column => value pairs). For example: array("id" => 40, "post_id" => 10).</p>
          </td>
          <td>
            Similar to tom_update_record_by_id, but you have more control over which record to update. Returns true if updated correctly, false if not.
          </td>
        </tr>
        
        <tr>
          <td>
            tom_delete_record_by_id($table_name, $id_column_name, $delete_id)
          </td>
          <td>
            <p>$table_name = (string) The name of table you wish to delete, without the prefix. The prefix is auto added in for you.</p>
            <p>$id_column_name = (string) The name of the primary key field.</p>
            <p>$delete_id = (integer) The primary key value of the record you wish to delete.</p>
          </td>
          <td>
            Deletes a record from the database. Returns a sql delete query object.
          </td>
        </tr>

        <tr>
          <td>
            tom_delete_record($table_name, $where_sql)
          </td>
          <td>
            <p>$table_name = (string) The name of table you wish to delete, without the prefix. The prefix is auto added in for you.</p>
            <p>$where_sql = (string) SQL Where condition without the keyword WHERE. For example: post_type='attachment' AND post_title LIKE '%$filter_image_name%' AND post_mime_type IN ('image/png', 'image/jpg', 'image/jpeg', 'image/gif').</p>
          </td>
          <td>
            Similar to tom_delete_record_by_id, but more flexibility with selecting the record that you want to delete.
          </td>
        </tr>

        <tr>
          <td>
            tom_get_record_count($table_name, $where_sql = "")
          </td>
          <td>
            <p>$table_name = (string) The name of table you wish to find the record count for, without the prefix. The prefix is auto added in for you. </p>
           <p>$where_sql = (string)(optional) The SQL Where clause without the keyword WHERE.</p>
          </td>
          <td>
            Get total record count from database table.
          </td>
        </tr>

        <tr>
          <td>
            tom_get_results($table_name, $fields_array, $where_sql, $order_array, $limit)
          </td>
          <td>
            <p>$table_name = (string) The name of table you wish to display, without the prefix. The prefix is auto added in for you.</p>
            <p>$fields_array = (array/string) An array of field names will be selected as part of the sql query. For example: array("id", "name", "address"). You can also pass "*" to select all.</p>
            <p>$where_sql = (string) SQL Where condition without the keyword WHERE. For example: post_type='attachment' AND post_title LIKE '%$filter_image_name%' AND post_mime_type IN ('image/png', 'image/jpg', 'image/jpeg', 'image/gif').</p>
            <p>$order_array = (array)(optional) An array of fields you wish to order the records by with order direction. For example: array("id DESC", "name ASC"). If null, there will be no order.</p>
            <p>$limit = (integer)(optional) The number of records to limit by. If null, there is no limit and will select all records based on $where_array.</p>
          </td>
          <td>
            Select records from the database. Returns sql results object.
          </td>
        </tr>

        <tr>
          <td>
            tom_get_row_by_id($table_name, $fields_array, $id_column_name, $id)
          </td>
          <td>
            <p>$table_name = (string) The name of table you wish to display, without the prefix. The prefix is auto added in for you.</p>
            <p>$fields_array = (array/string) An array of field names will be selected as part of the sql query. For example: array("id", "name", "address"). You can also pass "*" to select all.</p>
            <p>$id_column_name = (string) The name of the primary key field name.</p>
            <p>$id = (integer) The primary key id value of the record you wish to select.</p></p>
          </td>
          <td>
            Selects a record from the database. Returns one sql record result object.
          </td>
        </tr>

        <tr>
          <td>
            tom_get_row($table_name, $fields_array, $where_sql)
          </td>
          <td>
            <p>$table_name = (string) The name of table you wish to display, without the prefix. The prefix is auto added in for you.</p>
            <p>$fields_array = (array/string) An array of field names will be selected as part of the sql query. For example: array("id", "name", "address"). You can also pass "*" to select all.</p>
            <p>$where_sql = (string) SQL Where condition without the keyword WHERE. For example: post_type='attachment' AND post_title LIKE '%$filter_image_name%' AND post_mime_type IN ('image/png', 'image/jpg', 'image/jpeg', 'image/gif').</p>
          </td>
          <td>
            Similar to tom_get_row_by_id, but more flexibility with selecting the record that you want.
          </td>
        </tr>

			</tbody>
		</table>

</div>
</div>

<?php tom_add_social_share_links("http://wordpress.org/extend/plugins/tom-m8te/"); ?>