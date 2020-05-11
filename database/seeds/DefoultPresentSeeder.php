<?php

use App\Models\MainSlide;
use App\Models\Present;
use Illuminate\Database\Seeder;
use App\User;
use App\Models\TextSlider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DefoultPresentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Ռաֆայել Համբարյան',
            'email' => 'raforafo1996@mail.ru',
            'password' => Hash::make('11111111')
        ]);
        $user_id = $user->id;
        $present = new Present();
        $present->name = 'MySql';
        $present->user_id = $user_id;

        do {
            $url = Str::random(32);
            $present->url = $url;
        } while (Present::where("url", "=", $url)->first() instanceof Present);
        $present->save();
        $present_id = $present->id;

        $logo_path = Str::random(5) . time() . '.png';
        $present_logo_path = Str::random(5) . '1' . time() . '.png';

        File::copy(public_path('/images/logo.png'), public_path('/uploads/logo/' . $logo_path));
        File::copy(public_path('/images/mysql-logo.png'), public_path('/uploads/present_logo/' . $present_logo_path));
        $main_Slides = MainSlide::create([
            'user_id' => $user_id,
            'present_id' => $present_id,
            'logo' => $logo_path,
            'logo_url' => 'http://npuagb.am/hy/',
            'present_logo' => $present_logo_path,
            'main_name' => 'Դիպլոմային աշխատանք',
            'topic' => '<< Տվյալների բազայի նախագծում և ծրագրավորում օգտագործելով MySQL >>',
            'student' => 'Ռաֆայել Համբարյան',
            'head' => 'Արտակ Չախոյան',
            'background' => '#00BFFF',
        ]);
        $main_slider_id = $main_Slides->id;
        TextSlider::create([
            'user_id' => $user_id,
            'present_id' => $present_id,
            'main_slider_id' => $main_slider_id,
            'background' => '#00BFFF',
            'text_header' => 'Ընդհանուր նկարագրություն',
            'text_content' => json_encode([
                'Ինչ է MySQL- ը:',
                'Պատմություն:',
                'Օգտագործում է:',
                'Շարահյուսություն (Syntax)',
                'Նկարագրություն (client server):',
                'Ինչու MySQL:'
            ])
        ]);
        TextSlider::create([
            'user_id' => $user_id,
            'present_id' => $present_id,
            'main_slider_id' => $main_slider_id,
            'background' => '#00BFFF',
            'text_header' => 'Ինչ է MySQL- ը:',
            'text_content' => json_encode([
                'MySQL- ն այդպիսի բաց կոդով տվյալների հիման վրա տվյալների բազաների կառավարման համակարգ է: Ծրագիրը, որը սահմանում է, ստեղծում և շահարկում է տվյալների բազան, հայտնի է որպես տվյալների բազայի կառավարման համակարգ: Ծրագրավորողը կարող է օգտագործել SQL հարցումները MySQL- ում `տվյալների պահեստավորման և որոնման համար: Այն ապահովում է տվյալների կառավարում, տվյալների միգրացիա և տվյալների պաշտպանություն:',
                'MySQL- ը տրամադրում է NET պլատֆորմին, C ++, Python- ին, Java- ին ՝ տվյալների բազայի ծրագրեր կառուցելու համար:',
            ])
        ]);
        TextSlider::create([
            'user_id' => $user_id,
            'present_id' => $present_id,
            'main_slider_id' => $main_slider_id,
            'background' => '#00BFFF',
            'text_header' => 'Ընդհանուր նկարագրություն',
            'text_content' => json_encode([
                'Ինչ է MySQL- ը:',
                'Պատմություն:',
                'Օգտագործում է:',
                'Շարահյուսություն (Syntax)',
                'Նկարագրություն (client server):',
                'Ինչու MySQL:'
            ])
        ]);

    }
}
