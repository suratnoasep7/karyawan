<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('menu'))
{
    function get_menu($idJabatan)
    {
    	$CI = get_instance();

	    // You may need to load the model if it hasn't been pre-loaded
	    $CI->load->model('Dashboard_Model');

	    // Call a function of the model
	    return $CI->Dashboard_Model->getMenu($idJabatan)->result_array();
    }

    function get_sub_menu($idSubMenu)
    {
    	$CI = get_instance();

	    // You may need to load the model if it hasn't been pre-loaded
	    $CI->load->model('Dashboard_Model');

	    // Call a function of the model
	    return $CI->Dashboard_Model->getSubMenu($idSubMenu)->result_array();
    }   
}