<?php

namespace Theme;

use Timber\Timber;

class Terms
{
    /**
     * Get all terms for taxonomy
     *
     * @param $taxonomy string
     * @param $object_ids int|int[]
     * @param $timber bool
     * @return array of WP Terms or Timber Terms objects
     */
    public static function getTerms($taxonomy, $object_ids = null, $timber = false): array
    {

        $query = array(
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
        );

        if($object_ids) {
            $query['object_ids'] = $object_ids;
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

        //Add custom links
        $taxonomy_object = get_taxonomy($taxonomy);
        foreach($terms as $term) {
            $term->query_link = self::getTermQueryLink($term, $taxonomy_object);
        }

        return $terms;

    }


    /**
     * Generate URL to archive page with queried Term
     */
    public static function getTermQueryLink($term, $taxonomy = false)
    {
        if(!$taxonomy) {
            $taxonomy = get_taxonomy($term->taxonomy);
        }

        $query_var = $taxonomy->query_var;
        $archive_page = get_post_type_archive_link($taxonomy->object_type[0]);

        $query = array(
            $query_var => $term->slug
        );

        $url = $archive_page . '?' . http_build_query($query);

        return $url;

    }

}
