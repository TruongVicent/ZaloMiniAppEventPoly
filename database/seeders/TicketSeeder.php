<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tatuses = ['new','resolved'];
        for ($i =1 ; $i <=10 ; $i++){
            Ticket::create([
                'name_student' => 'NGuyen van '.$i,
                'code_student' => 'SV' . str_pad($i,6,0, STR_PAD_LEFT),
                'email' => 'nguyenvan'.$i .'@gmail.com',
                'content_support' => 'Hỗ trợ cho em '.$i,
                'status' => $tatuses[array_rand($tatuses)],
            ]);
        }
    }
}
