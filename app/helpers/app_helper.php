<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');	

function admin_theme_style($filename = false)
{

	if($filename)
	{
		$filename = "<link href='".site_url('assets/admin/css/'.$filename)."' rel='stylesheet'>\n";
	}

	return $filename;
}

function admin_theme_script($filename = false)
{

	if($filename)
	{
		$filename = "<script src='".site_url('assets/admin/js/'.$filename)."'></script>\n";
	}

	return $filename;
}

function theme_style($filename = false)
{

	if($filename)
	{
		$filename = "<link href='".site_url('assets/public/css/'.$filename)."' rel='stylesheet'>\n";
	}

	return $filename;
}

function theme_script($filename = false)
{

	if($filename)
	{
		$filename = "<script src='".site_url('assets/public/js/'.$filename)."'></script>\n";
	}

	return $filename;
}

if(!function_exists('_isLogin'))
{
	function _isLogin()
	{
		$CI =& get_instance();
		if(!empty($CI->session->userdata('authId')) && !empty($CI->session->userdata('email')))
		{
	    return true;
		}
		else {
			redirect('admin/login');
		}
	}
}


if(!function_exists('_send_mail'))
{
	function _send_mail($email_data)
	{
		$CI =& get_instance();

		$CI->load->library('email');

    $CI->email->from($email_data['from'], ucwords($email_data['sender_name']));
    $CI->email->to($email_data['to']);

    if (!empty($email_data['cc']))
    {
      $CI->email->cc($email_data['cc']);
    }
    if (!empty($email_data['bcc']))
    {
      $CI->email->bcc($email_data['bcc']);
    }
    if (!empty($email_data['file']))
    {
      $CI->email->attach($email_data['file']);
    } 

    $CI->email->subject(ucfirst($email_data['subject']));
   
    $CI->email->message($email_data['message']);
    $CI->email->send();
	}
}