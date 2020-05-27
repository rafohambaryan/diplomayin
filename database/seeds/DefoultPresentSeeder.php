<?php

use App\Models\ContentSubheadingMany;
use App\Models\MainSlide;
use App\Models\Present;
use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Subheading;
use App\Models\Order;
use App\Models\ContentSubheading;
use App\Models\SubheadingMany;
use App\Helpers\UniqueHash;
use App\Helpers\Copy;

class DefoultPresentSeeder extends Seeder
{
    private $user_id;
    private $present_id;

    private function setOrder($subheading_id)
    {
        Order::create([
            'user_id' => $this->user_id,
            'present_id' => $this->present_id,
            'subheading_id' => $subheading_id,
            'order' => $subheading_id
        ]);
    }

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

        $this->user_id = $user->id;
        $present = new Present();
        $present->name = 'MySql';
        $present->user_id = $this->user_id;

        $present->url = UniqueHash::hash(Present::class, 'url', 33);
        $present->save();
        $this->present_id = $present->id;

        $main_Slides = MainSlide::create([
            'user_id' => $this->user_id,
            'present_id' => $this->present_id,
            'logo' => Copy::file('/images/logo.png', '/uploads/logo/'),
            'logo_url' => 'http://npuagb.am/hy/',
            'present_logo' => Copy::file('/images/mysql-logo.png', '/uploads/present_logo/'),
            'main_name' => 'Դիպլոմային աշխատանք',
            'topic' => 'Տվյալների բազայի նախագծում և ծրագրավորում օգտագործելով MySQL',
            'student' => 'Ռաֆայել Համբարյան',
            'head' => 'Արտակ Չախոյան',
            'background' => '#ebfffc',
            'color' => '#000000',
        ]);
        $main_slider_id = $main_Slides->id;

        $subheading_1 = Subheading::create([
            'present_id' => $this->present_id,
            'main_slide_id' => $main_slider_id,
            'background' => '#e6e6e6',
            'color' => '#000000',
            'text_header' => 'Ընդհանուր նկարագրություն',
            'section_id' => UniqueHash::hash(Subheading::class, 'section_id'),
        ]);

        $subheading_content_1 = ContentSubheading::create([
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
            'present_id' => $this->present_id
        ]);


        $subheading_2 = Subheading::create([
            'present_id' => $this->present_id,
            'main_slide_id' => $main_slider_id,
            'background' => '#5cc0ff',
            'color' => '#000000',
            'text_header' => 'Ինչ է MySQL- ը',
            'section_id' => UniqueHash::hash(Subheading::class, 'section_id'),
        ]);


        $subheading_content_2 = ContentSubheading::create([

            'content' => json_encode([
                'MySQL- ն այդպիսի բաց կոդով տվյալների հիման վրա տվյալների բազաների կառավարման համակարգ է: Ծրագիրը, որը սահմանում է, ստեղծում և շահարկում է տվյալների բազան, հայտնի է որպես տվյալների բազայի կառավարման համակարգ: Ծրագրավորողը կարող է օգտագործել SQL հարցումները MySQL- ում `տվյալների պահեստավորման և որոնման համար: Այն ապահովում է տվյալների կառավարում, տվյալների միգրացիա և տվյալների պաշտպանություն:',
                'MySQL- ը տրամադրում է NET պլատֆորմին, C ++, Python- ին, Java- ին ՝ տվյալների բազայի ծրագրեր կառուցելու համար:',
            ]),
            'content_type_id' => 1,
            'subheading_id' => $subheading_2->id,
            'present_id' => $this->present_id
        ]);

        $subheading_3 = Subheading::create([
            'present_id' => $this->present_id,
            'main_slide_id' => $main_slider_id,
            'background' => '#00BFFF',
            'color' => '#FFFFFF',
            'text_header' => 'Պատմություն',
            'section_id' => UniqueHash::hash(Subheading::class, 'section_id'),
        ]);

        $subheading_content_3 = ContentSubheading::create([
            'content' => json_encode([
                'MySQL- ն ստեղծվել է շվեդական MySQL AB ընկերության կողմից 1995 թ.-ին: Պլատֆորմի մշակողներն էին Michael Widenius- ը (Monty), David Axmark- ը և Allan Larsson- ը:',
                'Հիմնական նպատակն էր տնային և պրոֆեսիոնալ օգտագործողներին տվյալների կառավարման արդյունավետ և հուսալի տարբերակներ տրամադրելը:',
                'Պլատֆորմի ավելի քան կես տասնյակ ալֆա և բետա տարբերակները թողարկվել են 2000 թ.-ին:',
            ]),
            'content_type_id' => 1,
            'subheading_id' => $subheading_3->id,
            'present_id' => $this->present_id
        ]);


        $subheading_4 = Subheading::create([
            'present_id' => $this->present_id,
            'main_slide_id' => $main_slider_id,
            'background' => '#75ddff',
            'color' => '#000000',
            'text_header' => 'Օգտագործում է:',
            'section_id' => UniqueHash::hash(Subheading::class, 'section_id'),
        ]);

        $subheading_content_4 = ContentSubheading::create([
            'content' => json_encode([
                'Եթե վեբ էջի մեջ տվյալների արտածման անհրաժեշտություն է առաջացել, ապա նախապես ունենալու ենք տվյալների բազա, օրինակ՝ MS Access, SQL Server, MySQL: Իսկ սերվերին ներկայացնելու համար կիրառում ենք PHP, java, nodeJs, ASP և այլն:',
                'Էջի արտաքին տեսքի համար պատասխանատու են HTML / CSS / javascript ծրագրերը:'

            ]),
            'content_type_id' => 1,
            'subheading_id' => $subheading_4->id,
            'present_id' => $this->present_id
        ]);

        $subheading_4_1 = SubheadingMany::create([
            'present_id' => $this->present_id,
            'subheading_id' => $subheading_4->id,
            'main_slide_id' => $main_slider_id,
            'background' => '#1E90FF',
            'color' => '#ffffff',
            'text_header' => 'Օրինակ՝',
            'section_id' => UniqueHash::hash(SubheadingMany::class, 'section_id', 30),
        ]);
        $subheading_content_4_1 = ContentSubheadingMany::create([
            'content' => json_encode([
                'Այս օրինակում ես ներկայացնում եմ թե ինչպես է օգտագործվում MySQL-ը կայքերի մեջ:',
            ]),
            'img' => Copy::file('/images/design-site.png', '/uploads/img/'),
            'content_type_id' => 2,
            'subheading_many_id' => $subheading_4_1->id,
            'present_id' => $this->present_id
        ]);

        ///
        ///
        $subheading_5 = Subheading::create([
            'present_id' => $this->present_id,
            'main_slide_id' => $main_slider_id,
            'background' => '#00BFFF',
            'color' => '#FFFFFF',
            'text_header' => 'Շարահյուսություն (Syntax)',
            'section_id' => UniqueHash::hash(Subheading::class, 'section_id'),
        ]);

        $subheading_content_5 = ContentSubheading::create([
            'content' => json_encode([
                'Հիմնականում տվյալների բազաների Շարահյուսությունը(Syntax) նման են:',
                'MySql-ը ունի տվյալների տիպեր և պատրաստի ֆունկցիաներ, MySql-ում աղյուսակ կամ նոր ֆունկցի ստեղծելիս օգտվում ենք SQL հարցումների լեզվից',
                'SQL հարցումների լեզուն օկտագործվում է տարբեր տվյալների բազաների հետ աշխատելիս:'
            ]),
            'img' => Copy::file('/images/Screenshot_8.png', '/uploads/img/'),
            'content_type_id' => 1,
            'subheading_id' => $subheading_5->id,
            'present_id' => $this->present_id
        ]);
        $subheading_6 = Subheading::create([
            'present_id' => $this->present_id,
            'main_slide_id' => $main_slider_id,
            'background' => '#d9ffd6',
            'color' => '#000000',
            'text_header' => 'Նկարագրություն (client server relations):',
            'section_id' => UniqueHash::hash(Subheading::class, 'section_id'),
        ]);

        $subheading_content_6 = ContentSubheading::create([
            'content' => json_encode([
                'Նկարագրություն (client server) այստեղ ես ներկայացնում եմ թե ինչպես են client, server և MySql-ը աշխատու, միմյանց  հետ:'
            ]),
            'img' => Copy::file('/images/asdf5.png', '/uploads/img/'),
            'content_type_id' => 1,
            'subheading_id' => $subheading_6->id,
            'present_id' => $this->present_id
        ]);

        $subheading_6_1 = SubheadingMany::create([
            'present_id' => $this->present_id,
            'subheading_id' => $subheading_6->id,
            'main_slide_id' => $main_slider_id,
            'background' => '#360099',
            'color' => '#ffffff',
            'text_header' => 'Նկարագրություն (Relations):',
            'section_id' => UniqueHash::hash(SubheadingMany::class, 'section_id', 30),
        ]);
        ContentSubheadingMany::create([
            'content' => json_encode([
                'MySQL-ում տվյալները տարբեր աղյուսակներում պահելիս ինդեքսավորում և կապում ենք միմյանց եկրորդայինը(FOREIGN KEY) առաջնայինի(PRIMARY KEY) հետ և օգտագործում ենք ON UPDATE CASCADE, ON DELETE CASCADE :',
                'CASCADE-ը նախատեսված է եկրուրդային աղյուսակները առաջնայինից կառավարելու համար:',
                'Կապերը լինում են՝ մեկ-ը մեկ-ին, մեկ-ը շատ-ին, շատ-ը մեկ-ին, շատ-ը շատ-ին:'
            ]),
            'img' => Copy::file('/images/Screenshot_6.png', '/uploads/img/'),
            'content_type_id' => 2,
            'subheading_many_id' => $subheading_6_1->id,
            'present_id' => $this->present_id
        ]);


        $this->setOrder($subheading_1->id);
        $this->setOrder($subheading_2->id);
        $this->setOrder($subheading_3->id);
        $this->setOrder($subheading_4->id);
        $this->setOrder($subheading_5->id);
        $this->setOrder($subheading_6->id);

    }
}
