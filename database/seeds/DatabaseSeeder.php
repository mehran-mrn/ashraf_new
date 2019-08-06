<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('store_categories')->insert(
            array(
                'title' => 'تاج گل',
                'description' => 'سفارش تاج گل',
            )
        );
        DB::table('store_categories')->insert(
            array(
                'title' => 'دسته گل',
                'description' => 'دسته گل',
            )
        );

        DB::table('store_item_categories')->insert(
            array(
                'title' => 'وزن',
            )
        );
        DB::table('store_item_categories')->insert(
            array(
                'title' => 'ابعاد',
            )
        );

        DB::table('store_items')->insert(
            array(
                'title' => 'طول',
                'category_id' => '2',
                'suffix' => 'سانتی متر'
            )
        );
        DB::table('store_items')->insert(
            array(
                'title' => 'عرض',
                'category_id' => '2',
                'suffix' => 'سانتی متر'
            )
        );
        DB::table('store_items')->insert(
            array(
                'title' => 'وزن',
                'category_id' => '1',
                'suffix' => 'کیلوگرم'
            )
        );

        DB::table('store_products')->insert(
            array(
                'title' => 'تاج گل یک',
                'description' => '<p><span style="font-family:IRANSans"><strong><strong>نیکوکار گرامی :&nbsp;</strong></strong></span></p><p><span style="font-family:IRANSans">تاج گل های هنری و استند تسلیت موسسه خیریه اشرف الانبیاء(ص) جهت جلوگیری از اسراف طراحی گردیده و عواید حاصله از این امر خداپسندانه صرف حمایت و توانمندی ایتام و محرومین تحت پوشش می گردد و آثار معنوی آن به روح آن عزیز از دست رفته می رسد .</span></p>',
                'properties' => '* ارسال رایگان * جانمایی قبل از شروع مراسم* اهداء لوح نیکوکاری به صاحبین مراسم از طرف نیکوکار سفارش دهنده * کیفیت مستمر در تاج گل ها و استندهای جهت حفظ شأن نیکوکاران سفارش دهنده',
                'main_image' => 'http://ashraf.locali/public/images/photos/1/1__0025406_-1.jpeg',
                'main_image_id' => '1',
                'price' => '0',
                'off' => '0',
                'ready' => '5',
                'status' => 'active',
            )
        );
        DB::table('store_products')->insert(
            array(
                'title' => 'تاج گل دو',
                'description' => '<p><span style="font-family:IRANSans"><strong><strong>نیکوکار گرامی :&nbsp;</strong></strong></span></p><p><span style="font-family:IRANSans">تاج گل های هنری و استند تسلیت موسسه خیریه اشرف الانبیاء(ص) جهت جلوگیری از اسراف طراحی گردیده و عواید حاصله از این امر خداپسندانه صرف حمایت و توانمندی ایتام و محرومین تحت پوشش می گردد و آثار معنوی آن به روح آن عزیز از دست رفته می رسد .</span></p>',
                'properties' => '* ارسال رایگان * جانمایی قبل از شروع مراسم* اهداء لوح نیکوکاری به صاحبین مراسم از طرف نیکوکار سفارش دهنده * کیفیت مستمر در تاج گل ها و استندهای جهت حفظ شأن نیکوکاران سفارش دهنده',
                'main_image' => 'http://ashraf.locali/public/images/photos/1/1__1.jpg',
                'main_image_id' => '2',
                'price' => '0',
                'off' => '0',
                'ready' => '2',
                'status' => 'active',
            )
        );

        DB::table('store_product_categories')->insert(
            array(
                'product_id' => '1',
                'category_id' => '2',
            )
        );
        DB::table('store_product_categories')->insert(
            array(
                'product_id' => '2',
                'category_id' => '1',
            )
        );

        DB::table('store_product_tags')->insert(
            array(
                'product_id' => '2',
                'tag' => 'تاج',
            )
        );
        DB::table('store_product_tags')->insert(
            array(
                'product_id' => '2',
                'tag' => 'تسلیت',
            )
        );
        DB::table('store_product_tags')->insert(
            array(
                'product_id' => '1',
                'tag' => 'تاج گل',
            )
        );
        DB::table('store_product_tags')->insert(
            array(
                'product_id' => '1',
                'tag' => 'مراسم',
            )
        );

        DB::table('store_product_items')->insert(
            array(
                'product_id' => '1',
                'item_id' => '3',
                'value' => '50',
            )
        );
        DB::table('store_product_items')->insert(
            array(
                'product_id' => '2',
                'item_id' => '3',
                'value' => '50',
            )
        );

        DB::table('store_product_gateways')->insert(
            array(
                'product_id' => '1',
                'gateway_id' => '1',
                'type' => 'online',
            )
        );
        DB::table('store_product_gateways')->insert(
            array(
                'product_id' => '1',
                'gateway_id' => '2',
                'type' => 'cart',
            )
        );
        DB::table('store_product_gateways')->insert(
            array(
                'product_id' => '1',
                'gateway_id' => '3',
                'type' => 'cart',
            )
        );
        DB::table('store_product_gateways')->insert(
            array(
                'product_id' => '1',
                'gateway_id' => '3',
                'type' => 'account',
            )
        );
        DB::table('store_product_gateways')->insert(
            array(
                'product_id' => '1',
                'gateway_id' => '0',
                'type' => 'place',
            )
        );
        DB::table('store_product_gateways')->insert(
            array(
                'product_id' => '2',
                'gateway_id' => '1',
                'type' => 'online',
            )
        );
        DB::table('store_product_gateways')->insert(
            array(
                'product_id' => '2',
                'gateway_id' => '2',
                'type' => 'cart',
            )
        );
        DB::table('store_product_gateways')->insert(
            array(
                'product_id' => '2',
                'gateway_id' => '3',
                'type' => 'cart',
            )
        );
        DB::table('store_product_gateways')->insert(
            array(
                'product_id' => '2',
                'gateway_id' => '3',
                'type' => 'account',
            )
        );

        DB::table('store_product_inventories')->insert(
            array(
                'product_id' => '1',
                'color_code' => '',
                'count' => '50',
                'price' => '5000000',
                'off' => '5',
                'type' => 'p',
                'user_id' => '1',
            )
        );
        DB::table('store_product_inventories')->insert(
            array(
                'product_id' => '2',
                'color_code' => '',
                'count' => '100',
                'price' => '8000000',
                'off' => '0',
                'type' => 'p',
                'user_id' => '1',
            )
        );

        DB::table('store_product_inventory_sizes')->insert(
            array(
                'size' => 'کوچک',
                'price' => '1800000',
                'count' => '100',
                'off' => '0',
                'inventory_id' => '1',
                'product_id' => '1',
            )
        );
        DB::table('store_product_inventory_sizes')->insert(
            array(
                'size' => 'متوسط',
                'price' => '5800000',
                'count' => '100',
                'off' => '0',
                'inventory_id' => '1',
                'product_id' => '1',
            )
        );
        DB::table('store_product_inventory_sizes')->insert(
            array(
                'size' => 'بزرگ',
                'price' => '9100000',
                'count' => '100',
                'off' => '20',
                'inventory_id' => '1',
                'product_id' => '1',
            )
        );

        DB::table('cities')->insert([
            ['name' => 'آمل',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'بابل',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'بابلسر',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'بهشهر',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'تنکابن',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'جویبار',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'چالوس',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'رامسر',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'ساری',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'سوادکوه',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'سوادکوه شمالی',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'سیمرغ',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'عباس آباد',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'فریدونکنار',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'قائم شهر',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'کلاردشت',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'گلوگاه',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'محمودآباد',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'میاندورود',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'نکا',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'نور',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'نوشهر',
                'parent' => 107,
                'status' => 'inactive'],
            ['name' => 'ساری',
                'parent' => 9,
                'status' => 'inactive'],
            ['name' => 'بابل',
                'parent' => 2,
                'status' => 'inactive'],
            ['name' => 'آمل',
                'parent' => 1,
                'status' => 'inactive'],
            ['name' => 'قائم شهر',
                'parent' => 15,
                'status' => 'inactive'],
            ['name' => 'بهشهر',
                'parent' => 4,
                'status' => 'inactive'],
            ['name' => 'چالوس',
                'parent' => 7,
                'status' => 'inactive'],
            ['name' => 'نکا',
                'parent' => 20,
                'status' => 'inactive'],
            ['name' => 'بابلسر',
                'parent' => 3,
                'status' => 'inactive'],
            ['name' => 'تنکابن',
                'parent' => 5,
                'status' => 'inactive'],
            ['name' => 'نوشهر',
                'parent' => 22,
                'status' => 'inactive'],
            ['name' => 'فریدونکنار',
                'parent' => 14,
                'status' => 'inactive'],
            ['name' => 'رامسر',
                'parent' => 8,
                'status' => 'inactive'],
            ['name' => 'جویبار',
                'parent' => 6,
                'status' => 'inactive'],
            ['name' => 'محمودآباد',
                'parent' => 18,
                'status' => 'inactive'],
            ['name' => 'امیرکلا',
                'parent' => 2,
                'status' => 'inactive'],
            ['name' => 'نور',
                'parent' => 21,
                'status' => 'inactive'],
            ['name' => 'گلوگاه',
                'parent' => 2,
                'status' => 'inactive'],
            ['name' => 'کتالم وسادات شهر',
                'parent' => 8,
                'status' => 'inactive'],
            ['name' => 'زیرآب',
                'parent' => 10,
                'status' => 'inactive'],
            ['name' => 'عباس آباد',
                'parent' => 13,
                'status' => 'inactive'],
            ['name' => 'کلاردشت',
                'parent' => 16,
                'status' => 'inactive'],
            ['name' => 'رستمکلا',
                'parent' => 4,
                'status' => 'inactive'],
            ['name' => 'خرم آباد',
                'parent' => 5,
                'status' => 'inactive'],
            ['name' => 'شیرود',
                'parent' => 5,
                'status' => 'inactive'],
            ['name' => 'چمستان',
                'parent' => 21,
                'status' => 'inactive'],
            ['name' => 'خلیل شهر',
                'parent' => 4,
                'status' => 'inactive'],
            ['name' => 'هچیرود',
                'parent' => 7,
                'status' => 'inactive'],
            ['name' => 'ارطه',
                'parent' => 15,
                'status' => 'inactive'],
            ['name' => 'سلمان شهر',
                'parent' => 13,
                'status' => 'inactive'],
            ['name' => 'سورک',
                'parent' => 19,
                'status' => 'inactive'],
            ['name' => 'شیرگاه',
                'parent' => 11,
                'status' => 'inactive'],
            ['name' => 'پل سفید',
                'parent' => 10,
                'status' => 'inactive'],
            ['name' => 'کیاکلا',
                'parent' => 12,
                'status' => 'inactive'],
            ['name' => 'بهنمیر',
                'parent' => 3,
                'status' => 'inactive'],
            ['name' => 'هادی شهر',
                'parent' => 3,
                'status' => 'inactive'],
            ['name' => 'رویان',
                'parent' => 21,
                'status' => 'inactive'],
            ['name' => 'ایزدشهر',
                'parent' => 21,
                'status' => 'inactive'],
            ['name' => 'گتاب',
                'parent' => 2,
                'status' => 'inactive'],
            ['name' => 'سرخرود',
                'parent' => 18,
                'status' => 'inactive'],
            ['name' => 'مرزن آباد',
                'parent' => 7,
                'status' => 'inactive'],
            ['name' => 'نشتارود',
                'parent' => 5,
                'status' => 'inactive'],
            ['name' => 'کلارآباد',
                'parent' => 13,
                'status' => 'inactive'],
            ['name' => 'امامزاده عبدالله',
                'parent' => 1,
                'status' => 'inactive'],
            ['name' => 'خوش رودپی',
                'parent' => 2,
                'status' => 'inactive'],
            ['name' => 'زرگرمحله',
                'parent' => 2,
                'status' => 'inactive'],
            ['name' => 'کیاسر',
                'parent' => 9,
                'status' => 'inactive'],
            ['name' => 'پول',
                'parent' => 22,
                'status' => 'inactive'],
            ['name' => 'کجور',
                'parent' => 22,
                'status' => 'inactive'],
            ['name' => 'کوهی خیل',
                'parent' => 6,
                'status' => 'inactive'],
            ['name' => 'دابودشت',
                'parent' => 1,
                'status' => 'inactive'],
            ['name' => 'آلاشت',
                'parent' => 10,
                'status' => 'inactive'],
            ['name' => 'رینه',
                'parent' => 1,
                'status' => 'inactive'],
            ['name' => 'بلده',
                'parent' => 21,
                'status' => 'inactive'],
            ['name' => 'پایین هولار',
                'parent' => 9,
                'status' => 'inactive'],
            ['name' => 'مرزیکلا',
                'parent' => 2,
                'status' => 'inactive'],
            ['name' => 'فریم',
                'parent' => 9,
                'status' => 'inactive'],
            ['name' => 'گزنک',
                'parent' => 1,
                'status' => 'inactive'],
            ['name' => 'گلوگاه',
                'parent' => 2,
                'status' => 'inactive'],
            ['name' => 'آذربایجان شرقی',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'آذربایجان غربی',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'اردبیل',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'اصفهان',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'البرز',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'ایلام',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'بوشهر',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'تهران',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'چهارمحال و بختیاری',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'خراسان جنوبی',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'خراسان رضوی',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'خراسان شمالی',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'خوزستان',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'زنجان',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'سمنان',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'سیستان و بلوچستان',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'فارس',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'قزوین',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'قم',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'کردستان',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'کرمان',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'کرمانشاه',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'کهگیلویه و بویراحمد',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'گلستان',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'گیلان',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'لرستان',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'مازندران',
                'parent' => 0,
                'status' => 'active'],
            ['name' => 'مرکزی',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'هرمزگان',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'همدان',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'یزد',
                'parent' => 0,
                'status' => 'inactive'],
            ['name' => 'متل قو (سلمان شهر)',
                'parent' => 107,
                'status' => 'active'],
            ['name' => 'دریاگوشه',
                'parent' => 118,
                'status' => 'active']]);

        DB::table('setting_transportations')->insert(
            [
                [
                    'title' => 'پست',
                    'time' => 3
                ], [
                'title' => 'پیک',
                'time' => 1
            ], [
                'title' => 'پست پیشتاز',
                'time' => 2
            ],
            ]
        );

        DB::table('charity_payment_paterns')->insert(
            [
                'title' => 'قربانی',
                'description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.',
                'periodic' => '0',
                'system' => '0',
                'min' => '10000',
                'max' => '9000000000',
                'type' => 'vow',
            ]
        );
        DB::table('charity_payment_paterns')->insert(
            [
                'title' => 'عقیقه',
                'description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.',
                'periodic' => '0',
                'system' => '0',
                'min' => '20000',
                'max' => '9000000000',
                'type' => 'vow',
            ]
        );


        DB::table('charity_payment_fields')->insert(
            [
                'label' => 'نام نیکوکار',
                'require' => '1',
                'ch_pay_pattern_id' => '3',
                'type' => '0',
            ]
        );
        DB::table('charity_payment_fields')->insert(
            [
                'label' => 'شماره همراه',
                'require' => '1',
                'ch_pay_pattern_id' => '3',
                'type' => '2',
            ]
        );
        DB::table('charity_payment_fields')->insert(
            [
                'label' => 'آدرس',
                'require' => '0',
                'ch_pay_pattern_id' => '3',
                'type' => '1',
            ]
        );
        DB::table('charity_payment_fields')->insert(
            [
                'label' => 'توضیحات',
                'require' => '0',
                'ch_pay_pattern_id' => '3',
                'type' => '1',
            ]
        );
        DB::table('charity_payment_fields')->insert(
            [
                'label' => 'نام نیکوکار',
                'require' => '1',
                'ch_pay_pattern_id' => '4',
                'type' => '0',
            ]
        );
        DB::table('charity_payment_fields')->insert(
            [
                'label' => 'شماره همراه',
                'require' => '1',
                'ch_pay_pattern_id' => '4',
                'type' => '2',
            ]
        );
        DB::table('charity_payment_fields')->insert(
            [
                'label' => 'آدرس',
                'require' => '0',
                'ch_pay_pattern_id' => '4',
                'type' => '1',
            ]
        );
        DB::table('charity_payment_fields')->insert(
            [
                'label' => 'توضیحات',
                'require' => '0',
                'ch_pay_pattern_id' => '4',
                'type' => '1',
            ]
        );
        DB::table('charity_payment_fields')->insert(
            [
                'label' => 'نام پدر',
                'require' => '1',
                'ch_pay_pattern_id' => '4',
                'type' => '0',
            ]
        );
        DB::table('charity_payment_fields')->insert(
            [
                'label' => 'نام فرزند',
                'require' => '1',
                'ch_pay_pattern_id' => '4',
                'type' => '0',
            ]
        );

        DB::table('charity_payment_titles')->insert(
            [
                'title' => 'کمک',
                'ch_pay_pattern_id' => '2',
            ]
        );
        DB::table('charity_payment_titles')->insert(
            [
                'title' => 'طرح سپاس',
                'ch_pay_pattern_id' => '2',
            ]
        );
        DB::table('charity_payment_titles')->insert(
            [
                'title' => 'طرح همه',
                'ch_pay_pattern_id' => '2',
            ]
        );
    }
}