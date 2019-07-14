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
    }
}
