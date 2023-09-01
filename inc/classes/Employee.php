<?php

namespace Theme;

use Timber\Timber;

class Employee
{
    public static $post_type = "employee";

    public static function getEmployees(string $group, $timber = false): array
    {
        $query = array(
            'post_type' => self::$post_type,
            'posts_per_page' => 10,
        );

        if($group) {
            $query['tax_query'] = array(
                array(
                    'taxonomy' => 'employee_group',
                    'field' => 'slug',
                    'terms' => $group,
                ),
            );
        }

        if($timber) {

            /**
             * Make WP_Term available for Twig templates
             * https://timber.github.io/docs/reference/timber/#get_terms
             */
            $employees = Timber::get_posts($query);

        } else {
            $employees = get_posts($query);
        }

        return $employees;


    }


    public static function getEmployee(int $id_employee, $timber = false): object
    {
        $query = array(
            'post_type' => self::$post_type,
            'p' => $id_employee,
            'posts_per_page' => 1,
        );


        if($timber) {

            /**
             * Make WP_Term available for Twig templates
             * https://timber.github.io/docs/reference/timber/#get_terms
             */
            $employee = Timber::get_post($query);

        } else {
            $employee = get_post($query);
        }

        return $employee;


    }

}
