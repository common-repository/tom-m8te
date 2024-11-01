=== Tom M8te ===
Contributors: MMDeveloper
Donate link: 
Tags: plugin, plugins, MySQL, database, databases, helper, helpers, method, methods, crud
Requires at least: 3.3
Tested up to: 3.8
Stable tag: 1.6.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Tom M8te is every developers m8te, making it a little easier to make a plugin.

== Description ==

Tom M8te provides useful functions that you can use in your plugins. Such as a nice function for adding social share links and database manipulation functions. 

The social links link to Facebook and Twitter share links. 

Facebook: https://www.facebook.com/sharer/sharer.php?u=

Twitter:  http://twitter.com/intent/tweet?url=


Functions:

------------------------------------------------

tom_get_month_list()

Returns an array of months of the year.

(((((((((((((((((((((((

tom_add_social_share_links($url)

$url = (string) The url of a site you wish for your users to share.

Creates a share website link for Facebook and Twitter.

(((((((((((((((((((((((

tom_write_to_file($write_content, $location)

$write_content = (string) Content to save to file.

$location = (string) The physical file location of the file to save the content to.

Save content to a file.

(((((((((((((((((((((((

tom_write_to_htaccess_file($rule_name, $content)

$rule_name = (string) WP ERROR LOG

$content = (string) The htaccess content to add. Example: <Files error_log>\norder allow,deny\ndeny from all\n</Files>\nphp_flag  log_errors on\nphp_value error_log error_log

Write content to the htaccess file.

(((((((((((((((((((((((

tom_is_file_writable($file)

$file = (string) Path to file to test.

Returns true if the file is writable, false if it isn't.

(((((((((((((((((((((((

tom_is_file_readable($file)

$file = (string) Path to file to test.

Returns true if the file is readable, false if it isn't.

(((((((((((((((((((((((

tom_javascript_redirect_to($url, $non_javscript_content = "")

$url = (string) The url to direct the page to.

$non_javscript_content = (string)(optional) Textual content for those who do not have javascript enabled.

Redirects the page to a particular url using javascript. Sometimes this is easier then using php redirect, because of the headers sent issue.

(((((((((((((((((((((((

tom_titlize_str($str)

$str = (string) The string you wish to titlize.

Titlizes a string. For example: status_level would become Status Level.

(((((((((((((((((((((((

tom_is_valid_datetime($datetime)

$datetime = (string) The string to test for datetime.

Checks to see if the parameter is a datetime. Returns true if its a date or datetime, False if its not.

(((((((((((((((((((((((

tom_is_valid_email($email)

$email = (string) The string to test for email.

Checks to see if the parameter is an email. Returns true if its a email, False if its not.

(((((((((((((((((((((((
          
tom_is_valid_emails($emails)
          
$email = (string) The string to test for emails, separated by commas. Example: test@test.com.au,joke@hotmail.com

Returns true if the parameter contains a list of emails separated by commas.

(((((((((((((((((((((((

tom_get_query_string_value($name, $index)

$name = (string) The name of the query string value, It can be the name of $_POST or $_GET, but $_POST takes precidence.

$index = (integer)(optional) Default = -1. Index number of the query string array item.

Basically gets the value from query string without having to use $_POST or $_GET variables. $_POST takes precidence over $_GET.

(((((((((((((((((((((((

tom_fix_http_quotes($http_data)

$http_data = (string) The post/get data.

Fixes up http post/get variables so that they present quotes correctly rather then like (\').

(((((((((((((((((((((((

tom_upload_file($field_name)

$field_name = (string) The name of file input field.

Allows you to upload a file.

(((((((((((((((((((((((

tom_send_email($is_html, $to_emails, $to_cc_emails, $to_bcc_emails, $from_email, $from_name, $subject, $body, $alt_body = "", $attachments = array(), $smtp_auth = false, $smtp_mail_host = "", $smtp_mail_port = "", $smtp_mail_username = "", $smtp_mail_password = "", $secure_array = array())

$is_html = (boolean) True if you want to send HTML emails, False if you just want to send text emails.

$to_emails = (string) or (array) Can be a string of emails to send to separated by commas or array of email addresses. Example: ("test@test.com", "joke@hotmail.com") or (array("test@test.com" => "Test Mate", "joke@hotmail.com" => "Joker Name")).

$to_cc_emails = (string) or (array) Can be a string of emails to send to separated by commas or array of email addresses. Example: ("test@test.com", "joke@hotmail.com") or (array("test@test.com" => "Test Mate", "joke@hotmail.com" => "Joker Name")).

$to_bcc_emails = (string) or (array) Can be a string of emails to send to separated by commas or array of email addresses. Example: ("test@test.com", "joke@hotmail.com") or (array("test@test.com" => "Test Mate", "joke@hotmail.com" => "Joker Name")).

$from_email = (string) The email address of the sender.

$from_name = (string) The name of the sender.

$subject = (string) The subject of the email.

$body = (string) The actual email.

$alt_body = (string) Content that appears if HTML is not supported.

$attachments = (array)(optional) Array of attachments. Example array("img/logo.png", "img/attachment.jpg").

$smtp_auth = (boolean)(optional) Use smtp authentication and use your smtp server instead of built in PHP.

$smtp_mail_host = (string)(optional) Mail host. Example: mail.domain.com.au.

$smtp_mail_port = (string)(optional) Your smtp port. Usually 25.

$smtp_mail_username = (string)(optional) Your smtp username.

$smtp_mail_password = (string)(optional) Your smtp password.

$secure_array = (Array)(optional) Array of security algorithms used by your SMTP server. Example array("tls"), array("ssl") or array("tls", "ssl"). "tls" and "ssl" are the only two values acceptable for this parameter.

Allows you to send an email. Returns a success or error messages.

(((((((((((((((((((((((

tom_generate_datatable($table_name, $fields_array, $primary_key_name, $where_clause, $order_array = array(), $limit_clause = "", $page_name, $display_show = true, $display_edit = true, $display_delete = true)

$table_name = (string) The name of table to create, without the prefix. The prefix is auto added in for you.

$fields_array = (array) An array of field names will be selected as part of the sql query. For example: array("id", "name", "address").

$primary_key_name = (string) Name of primary key field. Needs to be in the $fields_array.

$where_clause = (string)(optional) The SQL Where clause without the keyword WHERE.

$order_array = (array)(optional) An array of fields you wish to order the records by with order direction. For example: array("id DESC", "name ASC"). If null, there will be no order.

$limit_clause = (integer)(optional) The number of records to limit by. If null, there is no limit and will select all records based on $where_array.

$page_name = (string)(optional) The name of the page you want the show,edit,delete,pagination links to link to. Example: get_option("siteurl")."/wp-admin/admin.php?page=ventura-feedback-form/ventura-feedback-form.php"
            
$display_show = (boolean)(optional) Make show links visible. Default is true, It appends &action=show&id={{record_id}} to the link.

$display_edit = (boolean)(optional) Make show links visible. Default is true, It appends &action=edit&id={{record_id}} to the link.

$display_delete = (boolean)(optional) Make show links visible. Default is true, It appends &action=delete&id={{record_id}} to the link.

$sortable_columns = (boolean)(optional) Make columns sortable. Default is false.

$paginate_table = (boolean)(optional) Add pagination to the table. Default is false. The number of records per page is controlled by $limit_clause.

$date_format = (string)(optional) You can change the format of your dates. Default is Y-m-d.

$filter_array = (array)(optional) You can set up a filter system. Default is no filter. For example: array(array("status" => array("type" => "select", "value_options" => array("" => "", "Draft" => "Draft", "Published" => "Published"))),array("suburb" => array("type" => "text"))). Type can be text, select, radio, etc and option_values is only applicable to select, radio and checkbox.

(((((((((((((((((((((((

tom_generate_displayview($table_name, $fields_array, $id_column_name, $id)

$table_name = (string) The name of table to create, without the prefix. The prefix is auto added in for you.

$fields_array = (array) An array of field names will be selected as part of the sql query. For example: array("id", "name", "address").

$id_column_name = (string) Name of primary key field. Needs to be in the $fields_array.

$id = (integer) The id value of the record you wish to display.

Generates a definition list with data from a record in the database.

(((((((((((((((((((((((

tom_compress_content($content)

$content = (string) The content you wish to compress.

Returns compressed version of $content.

(((((((((((((((((((((((

tom_get_form_query_strings($table_name, $exclude_fields = array(), $include_field_values = array()

$table_name = (string) The name of table to create, without the prefix. The prefix is auto added in for you.

$exclude_fields = (array)(optional) Array of field names to exclude in query string. For example: array("confirm_date", "active").

$exclude_fields = (array)(optional) Array of query string values to include. For example: array("updated_at" => $current_datetime, "created_at" => $current_datetime).

Returns array of query strings from a form. Works out the $_POST and $_GET array names from the database table column names.

Example: 

tom_update_record_by_id("ventura_feedback_forms", 
                tom_get_form_query_strings("ventura_feedback_forms", array("created_at", "updated_at"), array("updated_at" => gmdate( 'Y-m-d H:i:s'))), "ID", $_POST["ID"]);

(((((((((((((((((((((((

tom_validate_form($validations_array)

$validation_array = (array) Array of validation. Example: array("project_number" => "required", "completion_date" => "required date", "rating" => "integer"). The key is the field name and the value is the type of validation. Current the method can only accept required, integer and date validation.

Returns true if the form submitted is valid, false if not. When a form field is invalid, it adds an error message to your tom_add_form_field method.

Example:

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


(((((((((((((((((((((((

tom_check_captcha($captcha_field_name)

$captcha_field_name = (string) The name of the captcha field name.

Returns true if you entered in the correct captcha security code.

(((((((((((((((((((((((

tom_add_form_field($instance, $field_type, $field_label, $field_id, $field_name, $field_attributes, $container_element, $container_attributes, $value_options, $field_index)

$instance = (object) The wordpress sql record object (tom_get_row_by_id(...)). Pass null when create a form for creating record.

$field_type = (string) The field type. Can only accept one these values: hidden, text, placeholder_text, textarea, placeholder_textarea, select, radio, file, captcha or checkbox.

$field_label = (string) The name of the label for the form field.

$field_id = (string) The id name of the field.

$field_name = (string) The name of the field, can be the same as $field_id.

$field_attributes = (array) Array of attributes for the field. Example: array("class" => "cool", "style" => "display: none;").

$container_element = (string) The element that will contain the field. For example: "p".

$container_attributes = (array) Similiar to $field_attributes, but for the container element.

$value_options = (array)(optional) Array of values for select, radio and checkbox fields. The key is the value set in the database and the value is the field value.

$field_index = (integer)(optional) Only give an index if you want the field to be an array. If you give an index, the field name will have "[]" added to the end of it and the id name of the field will include the field index.

Adds a form field to the page.

(((((((((((((((((((((((

tom_add_option_form_field($field_type, $field_label, $field_id, $option_name, $field_attributes, $container_element, $container_attributes, $value_options)

$field_type = (string) The field type. Can only accept one these values: hidden, text, textarea, select, radio, file, captcha or checkbox.

$field_label = (string) The name of the label for the form field.

$field_id = (string) The id name of the field.

$option_name = (string) The name of the Wordpress get_option. Example siteurl.

$field_attributes = (array) Array of attributes for the field. Example: array("class" => "cool", "style" => "display: none;").

$container_element = (string) The element that will contain the field. For example: "p".

$container_attributes = (array) Similiar to $field_attributes, but for the container element.

$value_options = (array)(optional) Array of values for select, radio and checkbox fields. The key is the value set in the database and the value is the field value.

$field_index = (integer)(optional) Only give an index if you want the field to be an array. If you give an index, the field name will have "[]" added to the end of it and the id name of the field will include the field index.

Adds a form field to the page. Only difference is the value is from the Wordpress get_option database table. Example get_option("siteurl").

(((((((((((((((((((((((
            
tom_create_option_if_not_exist($option_name)

$option_name = (string) The name of the option you wish to create.

Creates the option in the database if it doesn't exist. For example: tom_create_option_if_not_exist("plugin_version_no").

(((((((((((((((((((((((

tom_create_table($table_name, $fields_array_with_datatype, $primary_key_array)

$table_name = (string) The name of table to create, without the prefix. The prefix is auto added in for you.

$fields_array_with_datatype = (array) A named array of field names with datatype. For example: array("post_id mediumint(9) NOT NULL", "revision_id mediumint(9) NOT NULL")

$primary_key_array = (array) A named array of primary key names. For example: array("post_id", "url")
                 
Creates a MySQL database table. Returns a create table sql query object.
          
(((((((((((((((((((((((       
        
tom_add_fields_to_table($table_name, $fields_array_with_datatype)
          
$table_name = (string) The name of table to edit, without the prefix. The prefix is auto added in for you.
            
$fields_array_with_datatype = (array) A named array of fields to add to table with datatype. For example: array("post_id mediumint(9) NOT NULL", "revision_id mediumint(9) NOT NULL")
          
Adds fields to a MySQL Database table.  Returns a alter table sql query object.

((((((((((((((((((((((( 

tom_start_transaction($transaction_id)

$transaction_id = (string)(integer) A unique transaction id.

Use before updating or inserting data, so that afterwards you can rollback or commit your changes.

((((((((((((((((((((((( 

tom_rollback_transaction($transaction_id)

$transaction_id = (string)(integer) The same transaction id you used in tom_start_transaction.

Rollsback the database changes after calling tom_start_transaction($transaction_id).

((((((((((((((((((((((( 

tom_commit_transaction($transaction_id)

$transaction_id = (string)(integer) The same transaction id you used in tom_start_transaction.

Commits the database changes after calling tom_start_transaction($transaction_id).

(((((((((((((((((((((((       

tom_insert_record($table_name, $insert_array)
          
$table_name = (string) The name of table to add records to, without the prefix. The prefix is auto added in for you.
            
$insert_array = (array) A named array of data to insert (in column => value pairs). For example: array("post_id" => 40, "url" => "http://www.google.com.au")
          
Inserts data into the database.  Returns true if inserted correctly, false if not.
          
(((((((((((((((((((((((        

tom_update_record_by_id($table_name, $update_array, $id_column_name, $id)
          
$table_name = (string) The name of table you wish to update, without the prefix. The prefix is auto added in for you.
            
$update_array = (array) A named array of data to update (in column => value pairs). For example: array("post_id" => 40, "url" => "http://www.google.com.au")
            
$id_column_name = (string) Name of the primary key
            
$id = (integer) The primary key id value of the record you wish to update.
          
Updates data in the database. Returns true if updated correctly, false if not.
          
(((((((((((((((((((((((         

tom_update_record($table_name, $update_array, $where_array)
          
$table_name = (string) The name of table you wish to update, without the prefix. The prefix is auto added in for you.
            
$update_array = (array) A named array of data to update (in column => value pairs). For example: array("post_id" => 40, "url" => "http://www.google.com.au")
            
$where_array = (array) A named array of WHERE clauses (in column => value pairs). For example: array("id" => 40, "post_id" => 10).
          
Similar to tom_update_record_by_id, but you have more control over which record to update. Returns true if updated correctly, false if not.
          
(((((((((((((((((((((((         
        
tom_delete_record_by_id($table_name, $id_column_name, $delete_id)
          
$table_name = (string) The name of table you wish to delete, without the prefix. The prefix is auto added in for you.
            
$id_column_name = (string) The name of the primary key field.
            
$delete_id = (integer) The primary key value of the record you wish to delete.
          
Deletes a record from the database. Returns a sql delete query object.

((((((((((((((((((((((( 

tom_delete_record($table_name, $where_sql)

$table_name = (string) The name of table you wish to delete, without the prefix. The prefix is auto added in for you.

$where_sql = (string) SQL Where condition without the keyword WHERE. For example: post_type='attachment' AND post_title LIKE '%$filter_image_name%' AND post_mime_type IN ('image/png', 'image/jpg', 'image/jpeg', 'image/gif').

Similar to tom_delete_record_by_id, but more flexibility with selecting the record that you want to delete.

((((((((((((((((((((((( 

tom_get_record_count($table_name, $where_sql = "")

$table_name = (string) The name of table you wish to find the record count for, without the prefix. The prefix is auto added in for you. 

$where_sql = (string)(optional) The SQL Where clause without the keyword WHERE.

Get total record count from database table.

(((((((((((((((((((((((        

tom_get_results($table_name, $fields_array, $where_array, $order_array, $limit)
          
$table_name = (string) The name of table you wish to display, without the prefix. The prefix is auto added in for you.
            
$fields_array = (array/string) An array of field names will be selected as part of the sql query. For example: array("id", "name", "address"). You can also pass "*" to select all.
            
$where_sql = (string) SQL Where condition without the keyword WHERE. For example: post_type='attachment' AND post_title LIKE '%$filter_image_name%' AND post_mime_type IN ('image/png', 'image/jpg', 'image/jpeg', 'image/gif').
            
$order_array = (array)(optional) An array of fields you wish to order the records by with order direction. For example: array("id DESC", "name ASC"). If null, there will be no order.
            
$limit = (integer)(optional) The number of records to limit by. If null, there is no limit and will select all records based on $where_array.
          
Select records from the database. Returns sql results object.
          
(((((((((((((((((((((((        

tom_get_row_by_id($table_name, $fields_array, $id_column_name, $id)
          
$table_name = (string) The name of table you wish to display, without the prefix. The prefix is auto added in for you.
            
$fields_array = (array/string) An array of field names will be selected as part of the sql query. For example: array("id", "name", "address"). You can also pass "*" to select all.
            
$id_column_name = (string) The name of the primary key field name.
            
$id = (integer) The primary key id value of the record you wish to select.
          
Selects a record from the database. Returns one sql record result object.
      
((((((((((((((((((((((( 

tom_get_row($table_name, $fields_array, $where_sql)

$table_name = (string) The name of table you wish to display, without the prefix. The prefix is auto added in for you.

$fields_array = (array/string) An array of field names will be selected as part of the sql query. For example: array("id", "name", "address"). You can also pass "*" to select all.

$where_sql = (string) SQL Where condition without the keyword WHERE. For example: post_type='attachment' AND post_title LIKE '%$filter_image_name%' AND post_mime_type IN ('image/png', 'image/jpg', 'image/jpeg', 'image/gif').

Similar to tom_get_row_by_id, but more flexibility with selecting the record that you want.

((((((((((((((((((((((( 

== Installation ==

1) Install WordPress 3.6 or higher

2) Download the latest from:
http://wordpress.org/extend/plugins/tom-m8te 

3) Login to WordPress admin, click on Plugins / Add New / Upload, then upload the zip file you just downloaded.

4) Activate the plugin.

== Changelog ==

= 1.6.0 =

* Fixed a security vulnerability when downloading a file.

= 1.5.3 =

* I've made many extra js changes to 1.5.2, but didn't make them public until now. Added in new method tom_get_record_count.

= 1.5.2 =

* Added two new fields to tom_add_form_field, placeholder_text and placeholder_textarea. placeholder_text is just a text field with the label content in its placeholder. placeholder_textarea is similar but for textareas. There is also a small js hack for the IE browser.

= 1.5.1 =

* Two new methods for checking if a file is readable and writable.

= 1.5.0 =

* Add htaccess rule to your htaccess file easily. Added in Wordpress option field. Added in Simple PHP Dom library.

= 1.4.9.1 =

* Little change, don't change "&" in input fields when you submit form. Added in small vulnerability fix for checkbox.

= 1.4.9 =

* I've learnt more about php vulnerabilities then I ever thought existed. Hopefully, this next version is a little more secure.

= 1.4.8 =

* New method tom_get_month_list added. Updated tom_add_form_field method so that if you pass html escaped quotes in the field, it will attempt to fix them.

= 1.4.7 =

* Added ability to use security algorithm like SSL or TLS when sending an email.

= 1.4.6 =

* Fixed bug where posted content has strange characters if you post a quote. Now I created a method called tom_fix_http_quotes which removes the horrid (\') issue when dealing with quotes.

= 1.4.5 =

* Fixed bug with uniqueness error message.

= 1.4.4 =

* Fixed issue with multidimensional checkboxes.

= 1.4.3 =

* Fixed the recaptcha image, sometimes it didn't appear.

= 1.4.2 =

* Fixed a few small bugs. Added a settings page to allow you to turn Securimage off if you want to. Turn if off if your using another plugin that uses Securimage.

= 1.4.1 =

* New methods tom_start_transaction, tom_rollback_transaction, tom_commit_transaction, tom_validate_value, tom_send_email, tom_is_valid_email and tom_javascript_redirect_to. Changed tom_add_form_field so that you can use array of fields. For example on a form you could have a row of records, each with the same name. Now if you add an index number to the row, it can work out which row your editing and which row is failing. I've also included securimage so that you can have a captcha system for your forms.

= 1.3.4 =

* Insert and Update methods check for unique constraints and display unique constraint error messages.

* Changed error messages.

= 1.3.3 =

* New methods tom_javascript_redirect_to, tom_get_form_query_strings and tom_validate_form. So now you have the ability to validate your form fields.

= 1.3.2 =

* Updated tom_generate_datatable to accept filters. Created new method titlize_str.

= 1.3.1 =

* Changed tom_generate_datatable so that you can sort columns, use pagination and format datetime values.

= 1.2.2 =

* Updated tom_get_row_by_id and tom_get_row so they can take "*" for $fields_array parameter.

= 1.2.1 =

* Updated tom_add_form_field so it can now create select, radio and checkbox fields.

= 1.2 =

* New functions - tom_delete_record, tom_get_row.

= 1.1 =

* New functions. Including creating form fields and tables.

= 1.0 =

* Initial Commit

== Upgrade notice ==

= 1.6.0 =

* Fixed a security vulnerability when downloading a file.

= 1.5.3 =

* I've made many extra js changes to 1.5.2, but didn't make them public until now. Added in new method tom_get_record_count.

= 1.5.2 =

* Added two new fields to tom_add_form_field, placeholder_text and placeholder_textarea. placeholder_text is just a text field with the label content in its placeholder. placeholder_textarea is similar but for textareas. There is also a small js hack for the IE browser.

= 1.5.1 =

* Two new methods for checking if a file is readable and writable.

= 1.5.0 =

* Add htaccess rule to your htaccess file easily. Added in Wordpress option field. Added in Simple PHP Dom library.

= 1.4.9.1 =

* Little change, don't change "&" in input fields when you submit form. Added in small vulnerability fix for checkbox.

= 1.4.9 =

* I've learnt more about php vulnerabilities then I ever thought existed. Hopefully, this next version is a little more secure.

= 1.4.8 =

* New method tom_get_month_list added. Updated tom_add_form_field method so that if you pass html escaped quotes in the field, it will attempt to fix them.

= 1.4.7 =

* Added ability to use security algorithm like SSL or TLS when sending an email.

= 1.4.6 =

* Fixed bug where posted content has strange characters if you post a quote. Now I created a method called tom_fix_http_quotes which removes the horrid (\') issue when dealing with quotes.

= 1.4.5 =

* Fixed bug with uniqueness error message.

= 1.4.4 =

* Fixed issue with multidimensional checkboxes.

= 1.4.3 =

* Fixed the recaptcha image, sometimes it didn't appear.

= 1.4.2 =

* Fixed a few small bugs. Added a settings page to allow you to turn Securimage off if you want to. Turn if off if your using another plugin that uses Securimage.

= 1.4.1 =

* New methods tom_start_transaction, tom_rollback_transaction, tom_commit_transaction, tom_validate_value, tom_send_email, tom_is_valid_email and tom_javascript_redirect_to. Changed tom_add_form_field so that you can use array of fields. For example on a form you could have a row of records, each with the same name. Now if you add an index number to the row, it can work out which row your editing and which row is failing. I've also included securimage so that you can have a captcha system for your forms.

= 1.3.4 =

* Insert and Update methods check for unique constraints and display unique constraint error messages.

* Changed error messages.

= 1.3.3 =

* New methods tom_javascript_redirect_to, tom_get_form_query_strings and tom_validate_form. So now you have the ability to validate your form fields.

= 1.3.2 =

* Updated tom_generate_datatable to accept filters. Created new method titlize_str.

= 1.3.1 =

* Changed tom_generate_datatable so that you can sort columns, use pagination and format datetime values.

= 1.2.2 =

* Updated tom_get_row_by_id and tom_get_row so they can take "*" for $fields_array parameter.

= 1.2.1 =

* Updated tom_add_form_field so it can now create select, radio and checkbox fields.

= 1.2 =

* New functions - tom_delete_record, tom_get_row.

= 1.1 =

* New functions. Including creating form fields and tables.

= 1.0 =

* Initial Commit