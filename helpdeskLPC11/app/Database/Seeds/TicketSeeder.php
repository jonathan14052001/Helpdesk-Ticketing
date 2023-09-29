<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'no_ticket'         => static::faker()->numberBetween(0, 100),
            'user_id'           => 13,
            'urgency'           => static::faker()->word(),
            'name_company'      => static::faker()->words(3, true),
            'name_pic'          => static::faker()->name($gender = null|'male'|'female'),
            'position_pic'      => static::faker()->words(2, true),
            'problem_company'   => static::faker()->words(3, true),
            'problem_details'   => static::faker()->text(),
            'image_ticket'      => static::faker()->text()
        ];
        $this->db->table('ticket')->insert($data);
    }
}
