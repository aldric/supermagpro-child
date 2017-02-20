<?php
/**
 * Class for adding News Ticker
 *
 * @package AcmeThemes
 * @subpackage supermag
 * @since 1.0.0
 */
if ( ! class_exists( 'agt_bank_ranking' ) ) { 

	class Ranking_Widget extends WP_Widget
	{
		 function __construct() {
				parent::__construct(
				/*Base ID of your widget*/
					'agt_bank_ranking',
					/*Widget name will appear in UI*/
					__('AGT Bank Ranking Widget', 'supermagpro-child'),
					/*Widget description*/
					array( 'description' => __( 'Bank Ranking', 'supermagpro-child' ), )
				);
			}
		
		/*function Ranking_Widget() 
		{
			parent::WP_Widget(false, "AGT : Ranking Widget");
		}*/
	 
		function update($new_instance, $old_instance) 
		{  
			return $new_instance;  
		}  
	 
		function form($instance)
		{  
			$title = esc_attr($instance["title"]);  
			echo "<br />";
		}
	 
		function widget($args, $instance) 
		{
		  $widget_id = "widget_" . $args["widget_id"];
		  $bank_name_label = get_field('bank_name_label');
		  if(have_rows('evaluation_criteres')) {
			//  $queried_object = get_queried_object();
			$eval_count = 0;
			$eval_sum = 0;
			$eval_data = array();
				while( have_rows('evaluation_criteres') ) {
					the_row();
					$eval_sum += (int) get_sub_field('valeur_note');
					$eval_count++;
					array_push($eval_data, array(
						"label" => get_sub_field('label_critere'),
						"description" => get_sub_field('description_critere'),
						"note" => get_sub_field('valeur_note')
					));
				}
			$eval_title = get_field("evaluation_title");
			$eval_mean = round($eval_sum / $eval_count);
			//echo("Moyenne générale >>" .$eval_mean."<br/>");
			// I like to put the HTML output for the actual widget in a seperate file
			include(realpath(dirname(__FILE__)) . "/ranking.widget.view.php");
		  }
		}
	}
	add_action( 'widgets_init', function(){
		register_widget("Ranking_Widget");
	});

}

?>
