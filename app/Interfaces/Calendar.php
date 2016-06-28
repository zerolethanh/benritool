<?php
/**
 * Created by PhpStorm.
 * User: ZE
 * Date: 2016/06/13
 * Time: 9:46
 */

namespace App\Interfaces;


interface Calendar
{

    public function tr_td_add_button($button_template = null, $options = null);

    public function tr_td_data_list($data_template = null, $options = null);
}