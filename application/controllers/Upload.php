<?php

/*
 * Copyright © 2019 Dxvn, Inc. All rights reserved.
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Upload extends CI_Controller
{
    const DATADIR = 'Data';

    public function __construct()
    {
        parent::__construct();
    }

    public function doupload($time = false)
    {
        if (!$time) {
            redirect(base_url(), 'location', 301);
        }
        $config = [
            'upload_path'      => self::DATADIR.DIRECTORY_SEPARATOR.$time.DIRECTORY_SEPARATOR,
            'allowed_types'    => 'xlsx',
            'file_ext_tolower' => true,
            'overwrite'        => true,
            'remove_spaces'    => true,
        ];

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = ['error' => $this->upload->display_errors()];

            $this->debug($error);
        } else {
            $data = ['upload_data' => $this->upload->data()];

            redirect("/salary/time/$time", 'location', 301);
        }
    }

    /**
     * @param $arg
     */
    private function debug($arg)
    {
        echo '<pre>';
        print_r($arg);
        echo '</pre>';
    }
}
