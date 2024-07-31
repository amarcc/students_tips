<?php

namespace Database\Seeders;

use App\Models\Tip;
use App\Models\Like;
use App\Models\User;
use App\Models\Reply;
use App\Models\Faculty;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Program;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Amar Cirgic',
            'email' => 'amarhunter01@gmail.com',
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin',
            'admin' => true
        ]);
        
        User::factory(300) -> create();

        Faculty::factory(50) -> create();

        $faculties = Faculty::all() -> shuffle();

        for($i = 0; $i < 50; $i++) {
            $id = $faculties -> pop() -> id;
            for( $j = 0; $j < rand(3, 10); $j++ ) {
                Program::factory() -> create([
                    'faculty_id' => $id
                ]);
            }
        }

        $users = User::all() -> shuffle();
        $programs = Program::all() -> shuffle();

        $limit = $programs -> count();

        for($i = 0; $i < $limit; $i++){
            $id = $programs -> pop() -> id;
            for($j = 0; $j < rand(5, 10); $j++){
                $tip = Tip::factory() -> create([
                    'program_id' => $id,
                    'user_id' => $users -> random() -> id
                ]);
                $user_id = $users -> random() -> id;
                for($k = 0; $k < rand(0, 100); $k++){
                    Like::factory() -> create([
                        'user_id' => $user_id,
                        'tip_id' => $tip -> id,
                        'ind' => $user_id . '$$' . $tip -> id . '$$tip'
                    ]);
                }
            }
        }

        $tips = Tip::all() -> shuffle();

        $limit = $tips -> count();

        for($i = 0; $i < $limit; $i++){
            $id = $tips -> pop() -> id;
            for($j = 0; $j < rand(0, 10); $j++){
                $reply = Reply::factory() -> create([
                    'user_id' => $users -> random() -> id,
                    'tip_id' => $id
                ]);
                $user_id = $users -> random() -> id;
                for($k = 0; $k < rand(0, 100); $k++){
                    Like::factory() -> create([
                        'user_id' => $user_id,
                        'reply_id' => $reply -> id,
                        'ind' => $user_id . '$$' . $tip -> id . '$$reply'
                    ]);
                }
            }
        }

        $faculty = Faculty::factory() -> create([
            'name' => 'Faculty of Electrical Engineering',
            'location' => 'Podgorica'
        ]);

        Program::factory() -> create([
            'name' => 'Applied computer engineering',
            'faculty_id' => $faculty -> id,
        ]);
        
        Program::factory() -> create([
            'name' => 'Electronics telecommunications and computers',
            'faculty_id' => $faculty -> id,
        ]);

        Program::factory() -> create([
            'name' => 'Power systems and automatic control',
            'faculty_id' => $faculty -> id,
        ]);
    }
}
 