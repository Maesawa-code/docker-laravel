<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $storeNames = [
            '札幌店', '青森店', '盛岡店', '仙台店', '秋田店', '山形店', '福島店',
            '水戸店', '宇都宮店', '前橋店', 'さいたま店', '千葉店', '新宿店', '横浜店',
            '新潟店', '富山店', '金沢店', '福井店', '甲府店', '長野店',
            '岐阜店', '静岡店', '名古屋店', '津店', '大津店', '京都店', '大阪店',
            '神戸店', '奈良店', '和歌山店', '鳥取店', '松江店', '岡山店', '広島店',
            '山口店', '徳島店', '高松店', '松山店', '高知店', '福岡店', '佐賀店',
            '長崎店', '熊本店', '大分店', '宮崎店', '鹿児島店', '那覇店'
        ];

        foreach ($storeNames as $name) {
            DB::table('stores')->insert([
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
