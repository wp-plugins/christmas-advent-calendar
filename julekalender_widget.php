<?php
	class JulekalenderWidget extends WP_Widget {
		public function __construct() {
			
			$params = array(
				'description' => __('Get a list of Christmas Advent Calendars from julekalender.com','julekalender'),
				'name'		  => __('Christmas Advent Calendar', 'Julekalender')
				
			);	
			
			parent:: __construct('Julekalender','', $params);
			
			add_action('init', array($this, 'initFiles'));
		}
		
		public function initFiles() {
			wp_enqueue_script(
				'handlebars',
				plugins_url('js/handlebars.js', __FILE__),
				array('jquery'), false
			);
			wp_enqueue_script(
				'julekalender',
				plugins_url('js/julekalender.js', __FILE__),
				array('jquery'), false
			);
			wp_enqueue_style(
				'jul',
				plugins_url('css/julekalender.css', __FILE__)
			);
			
			
		}
		
		// Show widget options
		public function form( $instance ) { 
			$defaults = array( 'julekalender_num' => 5 );
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			extract($instance);
			
?>
			
           <p>
            	<label for="<?php echo $this->get_field_id('julekalender_title'); ?>"><?php _e('Title', 'julekalender'); ?></label>
                <input 
                	class="widefat" 
                    id="<?php echo $this->get_field_id('julekalender_title'); ?>"
                    name="<?php echo $this->get_field_name('julekalender_title'); ?>" 
                    value="<?php if( isset($julekalender_title) ) echo esc_attr($julekalender_title); ?>" />
            </p>
            <p>
            	<label for="<?php echo $this->get_field_id('julekalender_description'); ?>"><?php _e('Description', 'julekalender'); ?></label>
                <textarea 
                	class="widefat" 
                    rows="6"
                    id="<?php echo $this->get_field_id('julekalender_description'); ?>"
                    name="<?php echo $this->get_field_name('julekalender_description'); ?>"><?php if( isset($julekalender_description) ) echo esc_attr($julekalender_description); ?></textarea>
            </p>
            <p>
            	<label for="<?php echo $this->get_field_id('julekalender_num'); ?>"><?php _e('Number of Christmas Advent calendars', 'julekalender'); ?></label>
					<select id="<?php echo $this->get_field_id( 'julekalender_num' ); ?>" name="<?php echo $this->get_field_name( 'julekalender_num' ); ?>" class="widefat">
                    	
<?php		
			for ($i=1;$i<21;$i++) {
							
				if( (int) $julekalender_num === $i ) {
					echo "<option selected='selected' value='{$i}'>{$i}</option>";
				}else{
					echo "<option value='{$i}'>{$i}</option>";
				}
					
				
			}
?>
					</select>
			</p>
            <p>
            	<label><?php _e('Corporate', 'julekalender'); ?></label><br />
				<?php _e('An advent calendar creates commitment and enthusiasm. Its a cheap & effective way to build brand recognition, and will also create new customer relationships.<br /><br /> Curious? <br /><br /><a target="_blank" href="http://www.julekalender.com?a=wp">Sign up to test us for free until 25 november</a><br /><br /> We guarantee it will be a breeze!','julekalender'); ?>
            </p>	
                    
<?php
		}
				
		// show widget
		public function widget( $args, $instance) {
				extract($args);
				extract($instance);
				
				$make_title = apply_filters('widget_title', $julekalender_title);
				$make_description = apply_filters('widget_description', $julekalender_description);
				$bloginfo_lang = get_bloginfo( 'language');
								
				echo $before_widget;
					echo "<div class='julekalender-wrapper'>";
					echo $before_title . $julekalender_title . $after_title;
					echo "<p>" . $julekalender_description . "</p>";
?>
                 	
						<ul id="julekalender">
						<script id="template" type="text/x-handlebars-template">
                            {{#each this}}
                            <li><a target="_blank" href="{{path}}">{{title}}</a></li>
                            {{/each}}
                        </script>
                        </ul>
<?php					if($bloginfo_lang === 'nb-NO') { ?>
                        <strong>&raquo;&nbsp;<a target="_blank" href="http://www.julekalender.com/julekalendere-2012"><?php _e('Vis flere kalendere', 'julekalender');?></a></strong><br />
                        <strong>&raquo;&nbsp;<a target="_blank" href="http://www.julekalender.com/opprett"><?php _e('Kj&oslash;p kalender', 'julekalender');?></a></strong>
<?php 					} elseif($bloginfo_lang === 'da-DK') { ?>
						<strong>&raquo;&nbsp;<a target="_blank" href="http://www.julekalender.com/dk/julekalendere-2012"><?php _e('Se flere kalendere', 'julekalender');?></a></strong><br />
                        <strong>&raquo;&nbsp;<a target="_blank" href="http://www.julekalender.com/dk/opret"><?php _e('K&oslash;be kalender', 'julekalender');?></a></strong>

<?php 					} elseif($bloginfo_lang === 'sv-SE') { ?>
						<strong>&raquo;&nbsp;<a target="_blank" href="http://www.julekalender.com/se/julkalendrar-2012"><?php _e('Visa fler kalendrar', 'julekalender');?></a></strong><br />
                        <strong>&raquo;&nbsp;<a target="_blank" href="http://www.julekalender.com/se/opprett"><?php _e('K&ouml;pa kalender', 'julekalender');?></a></strong>

<?						} else { ?>
						<strong>&raquo;&nbsp;<a target="_blank" href="http://www.julekalender.com/en/adventcalendars-2012"><?php _e('I want more calendars', 'julekalender');?></a></strong><br />
                        <strong>&raquo;&nbsp;<a target="_blank" href="http://www.julekalender.com/en/opprett"><?php _e('Buy a calendar', 'julekalender');?></a></strong>

	
<?php } ?>
                    <script> new window.MakenewsmailJulekalender('<?php echo $julekalender_num ?>','<?php echo substr($bloginfo_lang, 0,2) ?>'); </script>
                
<?php
					echo "</div>";
				echo $after_widget;
				
		}
		
		
	}
	
?>
