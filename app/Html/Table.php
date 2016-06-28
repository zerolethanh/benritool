<?php
/**
 * Created by PhpStorm.
 * User: ZE
 * Date: 2016/06/14
 * Time: 13:47
 */

namespace App\Http;


class Table
{
    public $tag = 'table';
    public $html;

    function openTable()
    {
        $this->html .= '<table>';
    }

    function closeTable()
    {
        $this->html .= '</table>';
    }

    function addRow($options)
    {

    }

    public function openTr($options)
    {
        $this->html .= "<tr>" . $this->buildOptions($options);
    }

    public function openTd($options)
    {
        $this->html .= "<td>" . $this->buildOptions($options);
    }

    public function closeTr()
    {
        $this->html .= '</tr>';
    }

    public function closeTd()
    {
        $this->html .= '</td>';
    }

    public function buildOptions($options)
    {
        $re = '';
        foreach ($options as $k => $val) {
            $re .= " $k = '" . $val . "'";
        }
        return $re;
    }

    function addOptions($element)
    {

    }

    public function addTd($value, $options)
    {

    }
}