<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * The settings to add.
     */
    protected $settings = [
        [
            'key'         => 'contact_email',
            'name'        => 'Contact form email address',
            'description' => 'The email address that all emails from the contact form will go to.',
            'value'       => 'angelkurten@hotmail.com',
            'field'       => '{"name":"contact_email","label":"contact_email","type":"email"}',
            'active'      => 1,
        ],
        [
            'key'         => 'name',
            'name'        => 'Name',
            'description' => 'Name used for platform',
            'value'       => 'LMS-Laravel',
            'field'       => '{"name":"name","label":"Name","type":"text"}',
            'active'      => 1,
        ],
        [
            'key'         => 'description',
            'name'        => 'Description',
            'description' => 'Description used for platform',
            'value'       => 'LMS in Laravel',
            'field'       => '{"name":"description","label":"Description","type":"text"}',
            'active'      => 1,
        ],
        [
            'key'         => 'logo',
            'name'        => 'Logo',
            'description' => 'Logo used for platform',
            'value'       => 'http://lms-laravel.test/logo.png',
            'field'       => '{"name":"logo","label":"Logo","type":"file"}',
            'active'      => 1,
        ],
        [
            'key'         => 'media_server_url',
            'name'        => 'Server for string',
            'description' => 'Media server for stream',
            'value'       => 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
            'field'       => '{"name":"media_server_url","label":"Server URL","type":"text"}',
            'active'      => 1,
        ],
    ];

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $index => $setting) {
            $result = DB::table('settings')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");

                return;
            }
        }

        $this->command->info('Inserted '.count($this->settings).' records.');
    }
}
