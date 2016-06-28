<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ImgController extends Controller
{
    //
    public function getGpw()
    {
        $filename = resource_path('imgs/lockandkey.png');
        $this->showImg($filename);
    }

    public function getAddr()
    {

        $filename = resource_path("imgs/address.png");
        $this->showImg($filename);
    }

    public function getUuid()
    {
        $filename = resource_path("imgs/uuid.png");
        $this->showImg($filename);
    }

    public function getCheckemail()
    {
        $filename = resource_path("imgs/checkemail.jpg");
        $this->showImg($filename);
    }

    public function getSchedule()
    {
        $filename = resource_path("imgs/schedule.png");
        $this->showImg($filename);
    }

    public function getTimesheet()
    {
        $filename = resource_path("imgs/timesheet.jpg");
        $this->showImg($filename);
    }

    public function getWallet()
    {
        $this->showImg(resource_path('imgs/wallet.jpg'));
    }

    public function getMoney()
    {
        $this->showImg(resource_path('imgs/money.png'));

    }

    public function showImg($filename)
    {
        $size = getimagesize($filename);
        $fp = fopen($filename, "rb");
        if ($size && $fp) {
            header("Content-type: {$size['mime']}");
            fpassthru($fp);
            exit;
        } else {
            // エラー
        }
    }
}
