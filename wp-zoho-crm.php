<?php
/**
 * Plugin Name: Zoho CRM for wp
 * Plugin URI: ""
 * Description: CRM fields sender from cf7 to zoho.
 * Version: 1.0
 * Author: Khandoker Ashique Mahamud
 * Author URI: http://ashique12009.blogspot.com/
 */

/**
 * Copyright (c) 2017 ashique (email: ashique12009@gmail.com). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

// don't call the file directly
if (!defined('ABSPATH')) {
  exit;
}

require_once dirname(__FILE__) . '/app.php';

add_action('wpcf7_before_send_mail', 'wp_action_wpcf7_before_mail_sent');

function wp_action_wpcf7_before_mail_sent($wpcf7) {
  $submission = WPCF7_Submission::get_instance();

  if ($submission) {
    $posted_data = $submission->get_posted_data();
  }

  $formFlag = false;

  $data = [];

  if ($wpcf7->id() == 27878 || $wpcf7->id() == 26720 || $wpcf7->id() == 26716 || $wpcf7->id() == 25411 || $wpcf7->id() == 32395) {
    $data['first_name'] = isset($posted_data['first-name']) ? $posted_data['first-name'] : '';
    if (isset($posted_data['last-name'])) {
      $data['last_name'] = $posted_data['last-name'];
    }
    if (isset($posted_data['FullName'])) {
      $data['last_name'] = $posted_data['FullName'];
    }
    if (isset($posted_data['CompanyName'])) {
      $data['company_name'] = $posted_data['CompanyName'];
    }
    if (isset($posted_data['email'])) {
      $data['email'] = $posted_data['email'];
    }
    if (isset($posted_data['phone'])) {
      $data['phone'] = $posted_data['phone'];
    }
    if (isset($posted_data['Country'])) {
      $data['country'] = $posted_data['Country'];
    }
    if (isset($posted_data['industry'])) {
      $data['industry'] = $posted_data['industry'];
    }
    if (isset($posted_data['interested-in'])) {
      $data['interested_in'] = $posted_data['interested-in'];
    }
    if (isset($posted_data['description'])) {
      $data['description'] = $posted_data['description'];
    }
    if (isset($posted_data['post-url'])) {
      $data['lead_url'] = $posted_data['post-url'];
    }
    if (isset($posted_data['lead-source'])) {
      $data['lead_source'] = $posted_data['lead-source'];
    }
    if (isset($posted_data['ga-traffic-source-data'])) {
      $data['ga_traffic_source_data'] = $posted_data['ga-traffic-source-data'];
    }
    $data['formid'] = $wpcf7->id();
    $formFlag       = true;
  }

  if ($wpcf7->id() == 27877) {
    if (isset($posted_data['FullName'])) {
      $data['last_name'] = $posted_data['FullName'];
    }
    if (isset($posted_data['CompanyName'])) {
      $data['company_name'] = $posted_data['CompanyName'];
    }
    if (isset($posted_data['email'])) {
      $data['email'] = $posted_data['email'];
    }
    if (isset($posted_data['phone'])) {
      $data['phone'] = $posted_data['phone'];
    }
    if (isset($posted_data['Country'])) {
      $data['country'] = $posted_data['Country'];
    }
    if (isset($posted_data['description'])) {
      $data['description'] = $posted_data['description'];
    }
    if (isset($posted_data['post-url'])) {
      $data['lead_url'] = $posted_data['post-url'];
    }
    if (isset($posted_data['lead-source'])) {
      $data['lead_source'] = $posted_data['lead-source'];
    }
    if (isset($posted_data['ga-traffic-source-data'])) {
      $data['ga_traffic_source_data'] = $posted_data['ga-traffic-source-data'];
    }
    $data['formid'] = $wpcf7->id();

    $formFlag = true;
  }

  if ($formFlag == true) {
    $obj = new RestClient();
    $obj->create($data);
  }
}