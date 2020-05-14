<?php

use App\Models\MainSlide;
use App\Models\Present;
use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Subheading;

class DefoultPresentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'raforafo1996@mail.ru')->first();
        if (!$user instanceof User) {
            $user = User::create([
                'name' => 'Ռաֆայել Համբարյան',
                'email' => 'raforafo1996@mail.ru',
                'password' => Hash::make('11111111')
            ]);
        }

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

        $subheading_1 = Subheading::create([
            'present_id' => $present_id,
            'main_slide_id' => $main_slider_id,
            'background' => '#00DED1',
            'text_header' => 'Ընդհանուր նկարագրություն',
        ]);

        $subheading_content_1 = \App\Models\ContentSubheading::create([
            'content' => json_encode([
                'Ինչ է MySQL- ը:',
                'Պատմություն:',
                'Օգտագործում է:',
                'Շարահյուսություն (Syntax)',
                'Նկարագրություն (client server):',
                'Ինչու MySQL:'
            ]),
            'content_type_id' => 1,
            'subheading_id' => $subheading_1->id,
            'present_id' => $present_id
        ]);


        $subheading_2 = Subheading::create([
            'present_id' => $present_id,
            'main_slide_id' => $main_slider_id,
            'background' => '#5F9EA0',
            'text_header' => 'Ինչ է MySQL- ը',
        ]);


        $subheading_content_2 = \App\Models\ContentSubheading::create([

            'content' => json_encode([
                'MySQL- ն այդպիսի բաց կոդով տվյալների հիման վրա տվյալների բազաների կառավարման համակարգ է: Ծրագիրը, որը սահմանում է, ստեղծում և շահարկում է տվյալների բազան, հայտնի է որպես տվյալների բազայի կառավարման համակարգ: Ծրագրավորողը կարող է օգտագործել SQL հարցումները MySQL- ում `տվյալների պահեստավորման և որոնման համար: Այն ապահովում է տվյալների կառավարում, տվյալների միգրացիա և տվյալների պաշտպանություն:',
                'MySQL- ը տրամադրում է NET պլատֆորմին, C ++, Python- ին, Java- ին ՝ տվյալների բազայի ծրագրեր կառուցելու համար:',
            ]),
            'content_type_id' => 1,
            'subheading_id' => $subheading_2->id,
            'present_id' => $present_id
        ]);

        $subheading_3 = Subheading::create([
            'present_id' => $present_id,
            'main_slide_id' => $main_slider_id,
            'background' => '#00BFFF',
            'text_header' => 'Պատմություն',
        ]);

        $subheading_content_3 = \App\Models\ContentSubheading::create([
            'content' => json_encode([
                'Microsoft-ը, Sybase-ը և Ashton-Tate-ը ի սկզբանե միավորվեցին՝ մի ծրագրի ստեղծման և շուկա բացթողնման համար, որը ստացավ SQL Server 1.0 OS/2 -ի համար անվանումը (1989 թ.), որը փաստացի համարժեքն էր Sybase SQL Server 3.0 Unix, VMS-ի և այլնի համար։',
                'Microsoft SQL Server 6.0-ը առաջին SQL Server-ի տարբերակն էր, որը ստեղծված էր բացառապես Windows NT-ի ճարտարապետության համար և առանց մշակման գործընթացում Sybase-ի մասնակցության։',

            ]),
            'content_type_id' => 1,
            'subheading_id' => $subheading_3->id,
            'present_id' => $present_id
        ]);


        \App\Models\Order::create([
            'user_id' => $user_id,
            'present_id' => $present_id,
            'subheading_id' => $subheading_1->id,
            'order' => $subheading_1->id
        ]);
        \App\Models\Order::create([
            'user_id' => $user_id,
            'present_id' => $present_id,
            'subheading_id' => $subheading_2->id,
            'order' => $subheading_2->id
        ]);
        \App\Models\Order::create([
            'user_id' => $user_id,
            'present_id' => $present_id,
            'subheading_id' => $subheading_3->id,
            'order' => $subheading_3->id
        ]);

    }
}
