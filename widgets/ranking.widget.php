<?php
/**
 * Class for adding News Ticker
 *
 * @package AcmeThemes
 * @subpackage supermag
 * @since 1.0.0
 */
if (! class_exists('Ranking_Widget')) {
    class Ranking_Widget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct(
                /*Base ID of your widget*/
                    'agt_bank_ranking',
                    /*Widget name will appear in UI*/
                    __('AGT Bank Ranking Widget', 'supermagpro-child'),
                    /*Widget description*/
                    array( 'description' => __('Bank Ranking', 'supermagpro-child'), )
                );
        }

        public function update($new_instance, $old_instance)
        {
            return $new_instance;
        }

        public function form($instance)
        {
            $title = esc_attr($instance["title"]);
            echo "<br />";
        }

        public function widget($args, $instance)
        {
            $widget_id = "widget_" . $args["widget_id"];
            $post_object = get_field('associated_bank');
            if ($post_object) {
                $id = $post_object->ID;
                $bank_name_label = get_field('bank_name_label', $id);
                if (have_rows('evaluation_criteres', $id)) {
                    $eval_count = 0;
                    $eval_sum = 0;
                    $eval_data = array();
                    while (have_rows('evaluation_criteres', $id)) {
                        the_row();
                        $eval_sum += (int) get_sub_field('valeur_note', $id);
                        $eval_count++;
                        array_push($eval_data, array(
                        "label" => get_sub_field('label_critere', $id),
                        "description" => get_sub_field('description_critere', $id),
                        "note" => get_sub_field('valeur_note', $id)
                    ));
                    }
                    $eval_title = get_field("evaluation_title", $id);
                    $eval_mean = round($eval_sum / $eval_count);
                    include(realpath(dirname(__FILE__)) . "/ranking.widget.view.php");
                }
            }
        }
    }
}
