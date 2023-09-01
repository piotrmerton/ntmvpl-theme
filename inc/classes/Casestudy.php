<?php

namespace Theme;

use Timber\Timber;
use Theme\Terms;

class Casestudy
{
    public static $post_type = "casestudy";

    public static function getTaxonomies($with_terms = false): array
    {
        $taxonomies = get_object_taxonomies(self::$post_type, 'objects');

        if($with_terms) {
            foreach($taxonomies as $taxonomy) {
                $taxonomy->terms = Terms::getTerms($taxonomy->name);
            }
        }

        return $taxonomies;
    }

    /**
     * Get all available Services
     *
     * @param $id_post - limit results to given post
     * @return array of WP Terms or Timber Terms
     */
    public static function getServices($id_post = null): array
    {
        return Terms::getTerms('casestudy_service', $id_post);
    }

    /**
     * Get all available Industries
     *
     * @param $id_post - limit results to given post
     * @return array of WP Terms or Timber Terms
     */
    public static function getIndustries($id_post = null): array
    {
        return Terms::getTerms('casestudy_industry', $id_post);
    }


    /**
     * Get all Tags associated with Case Study
     * @return array of WP Terms or Timber Terms
     */
    public static function getTags($id_post = null, $timber = false): array
    {

        $taxonomies = get_object_taxonomies(self::$post_type);

        $query = array(
            'taxonomy' => $taxonomies,
            'hide_empty' => false,
            'orderby' => 'term_group',
        );

        if($id_post) {
            $query['object_ids'] = $id_post;
        }

        if($timber) {

            /**
             * Make WP_Term available for Twig templates
             * https://timber.github.io/docs/reference/timber/#get_terms
             */
            $terms = Timber::get_terms($query);

        } else {
            $terms = get_terms($query);
        }

        return $terms;

    }



}
