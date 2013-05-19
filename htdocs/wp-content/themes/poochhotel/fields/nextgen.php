<?php

	/*
		 *	Advanced Custom Fields - New field template
		 *
		 *	Create your field's functionality below and use the function:
		 *	register_field($class_name, $file_path) to include the field
		 *	in the acf plugin.
		 *
		 *	Documentation:
		 *	functions.php : register_field('NextGen_Field', dirname(__File__) . '/fields/nextgen.php');
		 *
		 */


	class NextGen_Field extends acf_Field {

		/*--------------------------------------------------------------------------------------
				 *
				 *	Constructor
				 *	- This function is called when the field class is initalized on each page.
				 *	- Here you can add filters / actions and setup any other functionality for your field
				 *
				 *	@author Elliot Condon
				 *	@since 2.2.0
				 *
				 *-------------------------------------------------------------------------------------*/

		function __construct($parent) {
			// do not delete!
			parent::__construct($parent);
			// set name / title
			$this->name = 'nextgen';
			// variable name (no spaces / special characters / etc)
			$this->title = __("NextGen Gallery Select", 'acf');
			// field label (Displayed in edit screens)

		}

		/*--------------------------------------------------------------------------------------
				 *
				 *	create_options
				 *	- this function is called from core/field_meta_box.php to create extra options
				 *	for your field
				 *
				 *	@params
				 *	- $key (int) - the $_POST obejct key required to save the options to the field
				 *	- $field (array) - the field object
				 *
				 *	@author Nontas Ravazoulas
				 *	@since 1.0.0
				 *
				 *-------------------------------------------------------------------------------------*/

		function create_options($key, $field) {
			
			// defaults
			$field['allow_null'] = isset($field['allow_null']) ? $field['allow_null'] : '0';
			
			?>
			<tr class="field_option field_option_<?php echo $this->name; ?>">
				<td class="label">
					<label><?php _e("Allow Null?",'acf'); ?></label>
				</td>
				<td>
					<?php 
					$this->parent->create_field(array(
						'type'	=>	'radio',
						'name'	=>	'fields['.$key.'][allow_null]',
						'value'	=>	$field['allow_null'],
						'choices'	=>	array(
							'1'	=>	__("Yes",'acf'),
							'0'	=>	__("No",'acf'),
						),
						'layout'	=>	'horizontal',
					));
					?>
				</td>
			</tr>
			<?php
			
		}

		/*--------------------------------------------------------------------------------------
				 *
				 *	pre_save_field
				 *	- this function is called when saving your acf object. Here you can manipulate the
				 *	field object and it's options before it gets saved to the database.
				 *
				 *	@author Elliot Condon
				 *	@since 2.2.0
				 *
				 *-------------------------------------------------------------------------------------*/

		function pre_save_field($field) {
			// do stuff with field (mostly format options data)

			return parent::pre_save_field($field);
		}

		/*--------------------------------------------------------------------------------------
				 *
				 *	create_field
				 *	- this function is called on edit screens to produce the html for this field
				 *
				 *  @author Nontas Ravazoulas
				 *  @since 1.0.0
				 *
				 *-------------------------------------------------------------------------------------*/

		function create_field($field) {
			
			// defaults
			$field['allow_null'] = isset($field['allow_null']) ? $field['allow_null'] : false;
			
			
			$selected_value = $field['value'];
			$is_selected    = '';
			global $ngg;
			global $nggdb;
			$gallerylist = $nggdb->find_all_galleries($order_by = 'title', $order_dir = 'ASC');
			?>

			<select id="<?php echo $field['name'] ?>" class="<?php echo $field['class'] ?>"
					name="<?php echo $field['name'] ?>">
	
				<?php
				
				// null
				if($field['allow_null'] == '1')
				{
					echo '<option value="null"> - None - </option>';
				}
				
				foreach($gallerylist as $gallery) :
					$name = ( empty($gallery->title) ) ? $gallery->name : $gallery->title;
					if ($gallery->gid == $selected_value) {
						$is_selected = 'selected="selected"';
					} else {
						$is_selected = '';
					} ?>
					<option value="<?php echo $gallery->gid ?>" <?php echo $is_selected ?>><?php echo $name ?></option>

				<?php endforeach ?> 
			</select>
		<?php
		}

		/*--------------------------------------------------------------------------------------
				 *
				 *	admin_head
				 *	- this function is called in the admin_head of the edit screen where your field
				 *	is created. Use this function to create css and javascript to assist your
				 *	create_field() function.
				 *
				 *	@author Elliot Condon
				 *	@since 2.2.0
				 *
				 *-------------------------------------------------------------------------------------*/

		function admin_head() {

		}

		/*--------------------------------------------------------------------------------------
				 *
				 *	admin_print_scripts / admin_print_styles
				 *	- this function is called in the admin_print_scripts / admin_print_styles where
				 *	your field is created. Use this function to register css and javascript to assist
				 *	your create_field() function.
				 *
				 *	@author Elliot Condon
				 *	@since 3.0.0
				 *
				 *-------------------------------------------------------------------------------------*/

		function admin_print_scripts() {

		}

		function admin_print_styles() {

		}

		/*--------------------------------------------------------------------------------------
				 *
				 *	update_value
				 *	- this function is called when saving a post object that your field is assigned to.
				 *	the function will pass through the 3 parameters for you to use.
				 *
				 *	@params
				 *	- $post_id (int) - usefull if you need to save extra data or manipulate the current
				 *	post object
				 *	- $field (array) - usefull if you need to manipulate the $value based on a field option
				 *	- $value (mixed) - the new value of your field.
				 *
				 *	@author Elliot Condon
				 *	@since 2.2.0
				 *
				 *-------------------------------------------------------------------------------------*/

		function update_value($post_id, $field, $value) {
			// do stuff with value

			//wp_set_object_terms($post_id, array(1), 'category', FALSE);

			// save value
			parent::update_value($post_id, $field, $value);
		}

		/*--------------------------------------------------------------------------------------
				 *
				 *	get_value
				 *	- called from the edit page to get the value of your field. This function is useful
				 *	if your field needs to collect extra data for your create_field() function.
				 *
				 *	@params
				 *	- $post_id (int) - the post ID which your value is attached to
				 *	- $field (array) - the field object.
				 *
				 *	@author Elliot Condon
				 *	@since 2.2.0
				 *
				 *-------------------------------------------------------------------------------------*/

		function get_value($post_id, $field) {
			// get value
			$value = parent::get_value($post_id, $field);

			// format value

			// return value
			return $value;
		}

		/*--------------------------------------------------------------------------------------
				 *
				 *	get_value_for_api
				 *	- called from your template file when using the API functions (get_field, etc).
				 *	This function is useful if your field needs to format the returned value
				 *
				 *	@params
				 *	- $post_id (int) - the post ID which your value is attached to
				 *	- $field (array) - the field object.
				 *
				 *	@author Elliot Condon
				 *	@since 3.0.0
				 *
				 *-------------------------------------------------------------------------------------*/

		function get_value_for_api($post_id, $field) {
			// get value
			$value   = $this->get_value($post_id, $field);
			
			if($value == 'null')
			{
				$value = false;
			}
			
			// return value
			return $value;
		}

	}

?>