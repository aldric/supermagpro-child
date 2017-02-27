<?php
if (! class_exists('BankHierarchy_Widget')) {
    class BankHierarchy_Widget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct(
                /*Base ID of your widget*/
                    'agt_bank_hierarchy',
                    /*Widget name will appear in UI*/
                    __('AGT Bank Hierarchy Widget', 'supermagpro-child'),
                    /*Widget description*/
                    array( 'description' => __('Bank Hierarchy', 'supermagpro-child'), )
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

        public function get_ranking_data($p)
        {
            $ranking_data = null;
            if ($p) {
                $id = $p->ID;
                $name = get_field('bank_name_label', $id);
                $ranking_data  = new RankingData($name, $id);

                if (have_rows('evaluation_criteres', $id)) {
                    $eval_count = 0;
                    $eval_sum = 0;
                    $eval_data = array();
                    while (have_rows('evaluation_criteres', $id)) {
                        the_row();
                        $eval_sum += (int) get_sub_field('valeur_note', $id);
                        $eval_count++;

                        array_push($ranking_data->eval_data, array(
                        "label" => get_sub_field('label_critere', $id),
                        "description" => get_sub_field('description_critere', $id),
                        "note" => get_sub_field('valeur_note', $id)
                    ));
                    }
                    $ranking_data->title = get_field("evaluation_title", $id);
                    $ranking_data->mean = round($eval_sum / $eval_count);
                }
            }
            return $ranking_data;
        }

        public function widget($args, $instance)
        {
            $widget_id = "widget_" . $args["widget_id"];
            global $post;
            $top = get_post(end(get_post_ancestors($post->ID)));
            $descendants =  $this->get_posts_children($top);
            echo '<pre>';
            print_r($descendants);
            echo '</pre>';
            if ($data != null) {
                include(realpath(dirname(__FILE__)) . "/ranking.widget.view.php");
            }
        }

        public function get_posts_children($p)
        {
            $children = array();
            $id = $p->ID;
            $posts = get_posts(array( 'numberposts' => -1, 'post_status' => 'publish', 'post_type' => 'banque_en_ligne', 'post_parent' => $id, 'suppress_filters' => false, 'orderby' => 'menu_order' ));
            $parent = new HierarchicalData($id, get_the_title($p), get_permalink($p));
            foreach ($posts as $child) {
                array_push($parent->children, $this->get_posts_children($child));
            }
            return $parent;
        }
    }

    class HierarchicalData
    {
        public $id;
        public $title;
        public $permalink;
        public $children = array();

        public function __construct($id, $title, $permalink)
        {
            $this->id = $id;
            $this->title = $title;
            $this->permalink = $permalink;
        }
    }

    add_action('widgets_init', function () {
        register_widget("BankHierarchy_Widget");
    });
}
