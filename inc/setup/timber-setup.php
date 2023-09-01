<?php

use Timber\Timber;
use Theme\Breadcrumbs;
use Theme\Seo;
use Theme\Service;

// initialize Timber
$timber = new \Timber\Timber();

/**
 * Customize Timber with custom context, functions, filters and namespaces
 *
 * Docs:
 *
 * https://timber.github.io/docs/guides/functions/
 * vendor\timber\timber\docs\guides\extending-timber.md
 * https://stackoverflow.com/a/47501103
 *
 **/
add_filter('timber/context', 'theme_global_context');
add_filter('timber/twig', 'add_to_twig');
add_filter('timber/loader/loader', 'twig_namespaces');

function add_to_twig($twig)
{
    $twig->addFunction(new \Timber\Twig_Function('theme_render_flexible_content', 'theme_render_flexible_content'));

    return $twig;
}
function twig_namespaces($loader) {
    $loader->addPath(ABSPATH, "root");
	return $loader;
}

/**
 * Timber global context available for all templates
 */
function theme_global_context($context)
{

    //https://timber.github.io/docs/guides/menus/#setting-up-a-menu-globally
    $context['nav'] = new \Timber\Menu('top-nav', array( 'depth' => 1));
    $context['footer_nav'] = new \Timber\Menu('footer-nav', array( 'depth' => 1));

    //https://timber.github.io/docs/guides/acf-cookbook/#options-page
    //better not to add all options at once due to heavy load
    //$context['options'] = get_fields('options');

    /**
     * @see inc/classes/Breadcrumbs.php
     */
    $context['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();

    /**
     * @see inc/classes/Seo.php
     */
    $context['seo'] = Seo::getMetaTags();

    /**
     * @see inc/classes/Service.php
     */
    $context['services'] = Service::getServices(true);

    /** global variables */
    $context['globals'] = array(
        'is_home'   => is_home(),
        'is_front_page' => is_front_page(),
        'is_single' => is_singular(),
        'is_single_post' => is_singular('post'),
        'is_contact_page' => is_page_template('page-templates/page-contact.php'),
        'is_inquiry_page' => is_page_template('page-templates/page-inquiry.php'),
        'is_cpt_career_archive' => is_post_type_archive('job_offer'),
        'links'     => array(
            'casestudies'    => get_post_type_archive_link('casestudy'),
            'blog'           => get_permalink(THEME_BLOG_PAGE_ID),
            'privacy_policy' => get_privacy_policy_url(),
        ),
        'socialmedia' => get_field('socialmedia', 'contact_data'),
        'contact_data' => get_fields('contact_data'),
        'default_wpcf7_id' => THEME_WPCF7_DEFAULT_FORM_ID,
    );


    return $context;
}

/**
 *
 * Custom Twig function to introduce template hierarchy for ACF Flexible Content:
 * use PHP file if it exists (i.e. to provide some additional logic, queries etc),
 * otherwise render Twig template file
 *
 * TO DO: check for ACF Plugin first?
 *
 */
function theme_render_flexible_content($field, $loop)
{

    $context = Timber::get_context();
    $context['section'] = $field;
    $context['section']['index'] = $loop['index'];
    $context['section']['layout'] = $field['acf_fc_layout'];

    $layout = str_replace('_', '-', $field['acf_fc_layout']);

    $layout_file_path = get_theme_file_path('/template-parts/acf-flexible-content/'. $layout . '.php');
    $layout_file_template_path = get_theme_file_path('/views/content/acf-flexible-content/'. $layout . '.twig');

    if (file_exists($layout_file_path)) {

        include $layout_file_path;

    } elseif (file_exists($layout_file_template_path)) {
        return Timber::fetch('views/content/acf-flexible-content/' . $layout . '.twig', $context);
    }

}
