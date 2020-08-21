<?php

namespace Modules\ProductProperty\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Database\Seeders\Traits\DisableForeignKeys;
use Modules\Core\Entities\Label;

class LabelTableSeeder extends Seeder
{
    use DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $module = 'productproperty';
        Label::where('module', $module)->delete();

        $labels = [
            ["key" => "pro_pro", "vi" => ["value" => "Thuộc tính sản phẩm"], "en" => ["value" => "Product property"]],
            ["key" => "pro_prop_gr", "vi" => ["value" => "Nhóm phân loại thuộc tính"], "en" => ["value" => "Product property group"]],
        ];

        foreach ($labels as $label) {
            $label['module'] = $module;
            Label::create($label);
        }

        $this->enableForeignKeys();
    }
}
