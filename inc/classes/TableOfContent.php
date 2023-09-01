<?php

/**
 * Generate Table of Content dynamically for Post based on HTML Headers stored in ACF Flexible Content
 */

namespace Theme;

class TableOfContent
{

    public $index = array();
    public $filtered_content = array();

    public function __construct(int $id_post) {

        $content_flexible = get_field('content_flexible', $id_post);

        if($content_flexible) {
            $this->filtered_content = $this->generateTableOfContents($content_flexible);
        }

        

    }

    /**
     * Generate Table of Contents based on ACF Flexible Content
     * @param array ACF Flexible Content
     */
    public function generateTableOfContents( array $content ) : array {

        foreach($content as &$layout) {
            // TO DO: check layout type (i.e. section text only?)
            array_walk_recursive($layout, array($this, '_filter_flexible_content'));
        }

        return $content;

    }

    /**
     * Filter each ACF Flexible Content field, filter it and update Table of Content index
     */
    private function _filter_flexible_content(&$field, $key) {
        
        if(is_string($field)) {
            $filter = self::_add_id_to_headings($field);
            $field = $filter['content'];
            
            foreach($filter['headers'] as $header) {
                $this->index[] = array(
                    'label' => $header,
                    'anchor' => sanitize_title( $header ),
                );
            }
    
        } else if (is_array($field)) {
            array_walk_recursive($field, '_filter_flexible_content');
        }
    }

    /**
     * Filters post content and adds ID to each header node;
     * 
     * @param string HTML content
     * @return array with filtered contented and matched headers (for Table of Contents)
     *  
     */
    public static function _add_id_to_headings( string $html ) : array {
        $headers = [];

        $content = preg_replace_callback( '/(\<h[1-2](.*?))\>(.*)(<\/h[1-2]>)/i', function( $matches ) use (&$headers) {
            if ( ! stripos( $matches[0], 'id=' ) ) :
                $matches[0] = $matches[1] . $matches[2] . ' id="' . sanitize_title( $matches[3] ) . '">' . $matches[3] . $matches[4];
            endif;
            $headers[] = $matches[3];
            return $matches[0];
        }, $html );
    
        $return = array(
            'content' => $content,
            'headers' => $headers,
        );
    
        return $return;
    }

    
}
