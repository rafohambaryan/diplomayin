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

class DefoultPresentSeeder extends Seeder
{
    private $user_id;
    private $present_id;

    private function imageCopy($go, $to, $ext = 'png')
    {
        $path = Str::random(5) . time() . '.' . $ext;
        File::copy(public_path($go), public_path($to . $path));
        return $path;
    }

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
            'logo' => $this->imageCopy('/images/logo.png', '/uploads/logo/'),
            'logo_url' => 'http://npuagb.am/hy/',
            'present_logo' => $this->imageCopy('/images/mysql-logo.png', '/uploads/present_logo/'),
            'main_name' => 'Դիպլոմային աշխատանք',
            'topic' => '<< Տվյալների բազայի նախագծում և ծրագրավորում օգտագործելով MySQL >>',
            'student' => 'Ռաֆայել Համբարյան',
            'head' => 'Արտակ Չախոյան',
            'background' => '#00BFFF',
        ]);
        $main_slider_id = $main_Slides->id;

        $subheading_1 = Subheading::create([
            'present_id' => $this->present_id,
            'main_slide_id' => $main_slider_id,
            'background' => '#00DED1',
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
            'background' => '#5F9EA0',
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
            'text_header' => 'Պատմություն',
            'section_id' => UniqueHash::hash(Subheading::class, 'section_id'),
        ]);

        $subheading_content_3 = ContentSubheading::create([
            'content' => json_encode([
                'Microsoft-ը, Sybase-ը և Ashton-Tate-ը ի սկզբանե միավորվեցին՝ մի ծրագրի ստեղծման և շուկա բացթողնման համար, որը ստացավ SQL Server 1.0 OS/2 -ի համար անվանումը (1989 թ.), որը փաստացի համարժեքն էր Sybase SQL Server 3.0 Unix, VMS-ի և այլնի համար։',
                'Microsoft SQL Server 6.0-ը առաջին SQL Server-ի տարբերակն էր, որը ստեղծված էր բացառապես Windows NT-ի ճարտարապետության համար և առանց մշակման գործընթացում Sybase-ի մասնակցության։',

            ]),
            'content_type_id' => 1,
            'subheading_id' => $subheading_3->id,
            'present_id' => $this->present_id
        ]);


        $subheading_4 = Subheading::create([
            'present_id' => $this->present_id,
            'main_slide_id' => $main_slider_id,
            'background' => '#00BFFF',
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
            'text_header' => 'Օրինակ՝',
            'section_id' => UniqueHash::hash(SubheadingMany::class, 'section_id', 30),
        ]);
        $subheading_content_4_1 = ContentSubheadingMany::create([
            'img' => $this->imageCopy('/images/design-site.png', '/uploads/img/'),
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
            'text_header' => 'Շարահյուսություն (Syntax)',
            'section_id' => UniqueHash::hash(Subheading::class, 'section_id'),
        ]);

        $subheading_content_5 = ContentSubheading::create([
            'content' => json_encode([
                'Հիմնականում տվյալների բազաների Շարահյուսությունը նման են:',
                'Օրինակ PostgreSQL և MySql բազաներում Շարահյուսությունը նույնն է միայն PostgreSQL-ում աղյուսակները 2 տիպի են լինում public և private իսկ MySql-ում բոլորը public տիպի են',


            ]),
            'content_type_id' => 1,
            'subheading_id' => $subheading_5->id,
            'present_id' => $this->present_id
        ]);


        $this->setOrder($subheading_1->id);
        $this->setOrder($subheading_2->id);
        $this->setOrder($subheading_3->id);
        $this->setOrder($subheading_4->id);
        $this->setOrder($subheading_5->id);

    }
}
