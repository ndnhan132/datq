<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use Faker\Factory as Faker;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\Photo;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

 
        $productNames = [
            "Bánh trứng đường đen", "Bánh dẻo nhân đậu đỏ", "Bánh bao ngọt", "Bánh gạo nếp xào", "Mì trường thọ",
            "Hạt dưa hành tỏi", "Hạt dẻ cười", "Chè đậu xanh", "Mứt hoa quả", "Khô bò",
            "Hạt hướng dương rang muối", "Bánh pía", "Chè sữa dừa", "Hạt sen sấy khô", "Bánh quy bơ",
            "Cốm sữa", "Chè trân châu đường đen", "Bánh nếp nhân thịt", "Mứt hạt sen", "Mứt dừa",
            "Bánh bột lọc", "Bánh da lợn", "Bánh trôi nước", "Chè khúc bạch", "Bánh bông lan",
            "Bánh su kem", "Khoai lang kén", "Hạt chia sấy", "Dưa lưới sấy khô", "Chè hạt sen",
            "Mì gói Trung Quốc", "Gạo lứt sấy", "Cơm cháy", "Bánh tráng nướng", "Chả giò cuốn",
            "Chả cá chiên", "Cải thìa xào tỏi", "Mứt chanh đào", "Chè long nhãn", "Đậu phộng chiên muối",
            "Chè thập cẩm", "Bánh khọt", "Bánh cuốn", "Xôi lá cẩm", "Bánh cuốn nhân thịt",
            "Bánh xèo", "Chè sương sa hạt lúa", "Bánh nướng nhân dừa", "Chè đậu ván", "Chả lụa",
            // "Hột é", "Xoài lắc", "Chè hạt é", "Bánh chuối nướng", "Bánh cam", "Gỏi cuốn",
            // "Bánh tráng cuốn thịt heo", "Bánh mì nhân thịt", "Món tôm chua", "Mực chiên giòn", "Đậu bắp xào",
            // "Thịt gà xào", "Bánh bắp", "Gà quay", "Mực khô", "Bánh rán", "Gà rán", "Đậu hũ chiên",
            // "Gỏi gà", "Bánh phồng tôm", "Bánh bèo", "Bánh đa cua", "Chè đậu đen", "Mì xào", "Bánh chưng",
            // "Gà hấp lá chanh", "Bánh trung thu", "Chè khoai môn", "Bánh nếp nhân đậu đỏ", "Cá kho tộ", "Hủ tiếu",
            // "Chè trứng", "Mực xào", "Gà nướng", "Bánh mì kẹp thịt", "Cơm rang", "Bánh giò", "Bánh tráng cuốn",
            // "Bánh ngọt", "Bánh tráng mắm ruốc", "Nước mía", "Chè ngô", "Thịt heo xào sả ớt", "Bánh bột chiên",
            // "Mực xào chua ngọt", "Chè khoai tây", "Bánh khoai tây chiên", "Bánh chảo", "Chè hạt lúa mạch", "Món bún riêu",
            // "Cá chiên giòn", "Chè đậu xanh dừa", "Xôi gấc", "Cơm cuộn", "Chè mè đen", "Bánh trứng lòng đỏ",
            // "Bánh mỳ chảo", "Bánh mì nướng", "Bánh mỳ cuốn", "Bánh tráng cuốn thịt bò", "Bánh tráng cuốn gà",
            // "Chè đậu phộng", "Bánh đậu xanh", "Gỏi đu đủ", "Chè bột báng", "Bánh bột lọc nhân tôm", "Bánh tráng cuốn dưa leo",


            // "Bánh tráng cuốn gà xé", "Chè khoai môn hạt sen", "Món canh sườn nấu chua", "Bánh xèo giòn", "Bánh tráng cuốn tôm",
            // "Chè đậu đen hạt lúa", "Món đậu phụ sốt dầu hào", "Bánh bột lọc nhân tôm thịt", "Gỏi ngó sen", "Cơm gà xối mỡ",
            // "Mực ống chiên giòn", "Bánh mì kẹp thịt nướng", "Bánh tráng cuốn rau củ", "Chè đậu đỏ nấu dừa", "Bánh khoai lang nướng",
            // "Mì xào hải sản", "Bánh tráng nướng phô mai", "Xôi mặn", "Bánh kem trái cây", "Cá hấp xì dầu",
            // "Gỏi cuốn bún", "Chè trân châu đỏ", "Chè thạch đen", "Gà quay xôi", "Chè sầu riêng", "Bánh chuối hấp",
            // "Bánh mì giòn", "Món bắp nướng bơ", "Chè khoai sọ", "Xôi mực", "Bánh tráng cuốn giò heo", "Chả giò chiên giòn",
            // "Chè dưa hấu", "Bánh tráng cuốn mực", "Bánh mì thịt nướng", "Mực xào me", "Chè đậu trắng", "Chè khoai tây bọc sữa",
            // "Bánh bột chiên ngọt", "Chè hạt sen dừa tươi", "Gỏi cá", "Mực khô nướng", "Bánh tráng cuốn cá hồi",
            // "Chè bí đỏ", "Gà nướng mật ong", "Cơm cuộn trứng", "Mực hấp sả", "Bánh giò nhân đậu xanh", "Cơm chiên bò băm",
            // "Bánh bao nhân tôm", "Bánh tráng cuốn thịt nướng", "Chè đậu đỏ lá dứa", "Cá chiên giòn muối ớt", "Bánh quy kem",
            // "Sushi cuộn rau củ", "Bánh dẻo bột gạo", "Chè đậu đen hạt sen", "Xôi cẩm", "Bánh khoai mì nướng",
            // "Món tôm nướng tiêu", "Bánh gạo cay", "Chè thạch găng", "Bánh mì nóng", "Bánh cuốn nhân trứng",
            // "Chè dừa nạo", "Bánh tráng cuốn cá ngừ", "Chè hạt mè", "Bánh xốp", "Bánh trứng đường mạch nha",
            // "Mực xào gừng tỏi", "Bánh bao chiên nhân thịt", "Bánh khoai tây chiên giòn", "Chè ngô nếp", "Xôi lạc",
            // "Bánh đậu xanh nhân dừa", "Chè đậu ván khoai môn", "Bánh ngọt nướng", "Gà xào sả", "Chè sầu riêng đậu đỏ",
            // "Mứt dâu tây", "Chè bưởi", "Bánh bột chiên nhân mực", "Xôi đậu xanh", "Bánh bột lọc gà", "Món lươn xào",
            // "Bánh ngọt nhân đậu xanh", "Chè long nhãn bột báng", "Xôi thịt", "Bánh bao nhân cá hồi", "Chè hạt é trân châu",
            // "Chè đậu xanh hạt sen", "Bánh su su", "Mực xào cay", "Bánh tráng cuốn cá ngừ", "Bánh bông lan sữa tươi",
            // "Xôi lá cẩm", "Món hải sản chiên giòn", "Chè đậu đen nấu dừa tươi", "Bánh bao chiên nhân cá", "Bánh mì kẹp thịt gà",
            // "Chè sương sa đậu xanh", "Bánh gạo tráng nướng", "Chè đậu xanh đậu đỏ", "Gà xào sả ớt", "Bánh tôm chiên giòn",
            // "Bánh nướng nhân đậu đỏ", "Mực chiên giòn sốt mayonnaise", "Bánh mì phô mai", "Chè bí đỏ sữa tươi", "Bánh gạo xào tôm",

            // "Bánh gạo nướng trứng muối", "Mì xào tôm khô", "Bánh khoai tây kẹp tôm", "Gà rang muối", "Bánh cuốn nhân thập cẩm",
            // "Chè ba màu", "Xôi dẻo đậu đỏ", "Chè đậu đen ngọt", "Bánh nếp nhân thịt", "Bánh tráng cuốn gà xé phay", 
            // "Sò điệp nướng mỡ hành", "Chè bí đỏ sữa", "Bánh bao chiên giòn nhân thịt", "Mực xào hành tây", "Chè bưởi",
            // "Bánh chưng nhân đậu xanh", "Bánh mì nướng mật ong", "Gỏi cuốn tôm thịt", "Cá chiên xù", "Bánh tráng cuốn ốc",
            // "Chè nhãn nhục", "Cà phê trứng", "Chè đậu xanh sữa dừa", "Bánh khoai tây chiên giòn", "Gà xào gừng tỏi",
            // "Chè đậu đỏ sầu riêng", "Xôi cuộn thịt xông khói", "Chè trôi nước", "Bánh mì nhân thịt bò nướng", "Chè đậu ván nấu dừa",
            // "Bánh su kem", "Chè hạt sen", "Xôi chiên giòn", "Bánh mì thịt heo nướng", "Bánh nếp nhân đậu đỏ",
            // "Chè khoai môn", "Bánh mì hạt sen", "Sushi cá ngừ", "Chè ngọc trai", "Mực xào chua ngọt", 
            // "Bánh quy bơ", "Chè gạo nếp", "Bánh bao ngọt", "Bánh xèo tôm thịt", "Bánh tráng cuốn thịt bò",
            // "Chè sữa dừa", "Bánh tráng cuốn thập cẩm", "Gà nướng ngũ vị", "Cơm chiên trứng", "Chè hạt é", 
            // "Bánh bột chiên mặn", "Cơm chiên dưa leo", "Bánh tráng cuốn tôm thịt", "Chè hoa quả", "Gà rang gừng",
            // "Mực xào sả", "Bánh bao chiên nhân tôm", "Chè dừa tươi", "Bánh tráng cuốn chả lụa", "Chè đậu xanh hạt sen",
            // "Món thịt xông khói", "Bánh khoai tây bọc phô mai", "Bánh chuối nướng", "Gỏi ngũ sắc", "Chè thạch rau câu",
            // "Bánh mì xíu mại", "Bánh tráng cuốn thịt xiên nướng", "Mực chiên mắm tỏi", "Xôi mặn trứng cút", "Chè khoai lang",
            // "Bánh bột lọc nhân thịt", "Cá chiên xù sốt mayonnaise", "Chè đậu đen đường phèn", "Gỏi chay", "Chè sương sa",
            // "Bánh chuối hấp", "Mực xào me cay", "Bánh tráng cuốn chả giò", "Bánh mì bơ tỏi", "Chè nếp cẩm",
            // "Xôi ngọt", "Bánh tráng cuốn gà xé", "Món gà rán", "Chè sầu riêng bột báng", "Bánh xốp phô mai", 
            // "Bánh bao hấp thịt", "Chè bưởi nước cốt dừa", "Gà xào mướp", "Mực chiên giòn muối", "Chè đậu đỏ hạt sen",
            // "Chè ba màu thạch", "Bánh tráng cuốn bò", "Mực nướng tiêu", "Bánh bao chiên giòn", "Chè đậu xanh thập cẩm",
            // "Gỏi cuốn ngó sen", "Chè dừa hạt đác", "Bánh khoai mì chiên", "Chè đậu đỏ nước dừa", "Xôi ngọt nhân hạt sen",
            // "Bánh bao nhân nấm", "Món tôm nướng sả", "Chè đậu đen ngọt ngào", "Bánh mỳ thịt nướng bơ tỏi", "Bánh bèo nhân tôm",
            // "Chè bí đỏ sữa dừa", "Bánh xếp nhân thịt", "Món gỏi rau củ", "Chè đậu xanh khô", "Bánh tráng cuốn heo quay",
            // "Chè đậu ván sữa", "Bánh mì xíu mại thịt", "Xôi chiên thập cẩm", "Bánh ngọt sầu riêng", "Mực nướng sả",
            // "Bánh bao hấp", "Chè đậu đen khoai môn", "Chè mực nước dừa", "Bánh chuối hấp", "Bánh tráng cuốn hải sản",
            // "Bánh bao nhân đậu", "Gỏi hải sản", "Mực nướng mỡ hành", "Xôi lá cẩm trộn thịt", "Chè đậu đen trân châu",
            // "Bánh quy chocolate", "Chè khoai lang bột báng", "Bánh mì bơ", "Chè bánh lọt", "Bánh xèo thịt bò",
            // "Chè sương sa hạt lúa", "Món thịt heo nướng", "Bánh tráng cuốn tôm nướng", "Bánh khoai môn chiên", "Gà nướng muối",
            // "Chè đậu đỏ đậu xanh", "Bánh tráng cuốn cá", "Chè đậu xanh nấu nước cốt dừa", "Mực xào chua ngọt", "Bánh tráng cuốn tôm",
            // "Gà rán cay", "Bánh bao nhân đậu đỏ", "Chè đậu xanh nước dừa", "Chè đậu hủ", "Bánh gạo cay",
            // "Chè đậu đen hạt sen", "Xôi trứng muối", "Bánh bao chiên tôm", "Chè ngọt hạt sen", "Bánh nướng nhân đậu",
            // "Mực khô xào sả", "Bánh mì ốp la", "Chè hạt é", "Xôi mặn thịt băm", "Bánh su kem ngọt",
            // "Bánh gạo tráng phô mai", "Gỏi cuốn thịt bò", "Chè chuối nướng", "Bánh su su", "Bánh tráng cuốn cá hồi",
            // "Chè đậu xanh đậu đỏ", "Xôi đậu đỏ", "Bánh tráng cuốn chả tôm", "Mực xào cay chua", "Chè đậu đen khoai môn",
            // "Xôi sầu riêng", "Chè long nhãn", "Bánh nướng đậu đỏ", "Món sò nướng bơ", "Chè hạt sen sữa tươi",
            // "Bánh gạo xào tôm", "Chè đậu hủ thập cẩm", "Bánh tráng cuốn thịt heo", "Chè hạt bàng", "Bánh ngọt sầu riêng",
            // "Chè bột lọc", "Bánh tráng cuốn trứng", "Chè đậu xanh tươi", "Bánh tráng cuốn xíu mại", "Bánh bao chiên nhân gà",
            // "Mực chiên giòn bột chiên", "Chè đậu đen đậu đỏ", "Bánh xèo đậu phụ", "Bánh su kem trứng", "Chè long nhãn khoai môn",
            // "Bánh bao chiên nhân đậu xanh", "Mực hấp hành", "Chè dừa trân châu", "Bánh khoai tây chiên sốt", "Mực xào me",
            // "Bánh tráng cuốn ngọc trai", "Chè bí đỏ đậu xanh", "Gà nướng nguyên con", "Bánh quy bơ chocolate", "Bánh mì kẹp xúc xích",
            // "Xôi dừa", "Bánh tráng cuốn khoai tây", "Bánh mì nướng", "Mực xào ngải cứu", "Chè khoai môn dừa",
            // "Chè đậu đỏ xương sâm", "Gỏi cuốn tôm", "Bánh nếp nhân thịt", "Mực nướng trộn thảo mộc", "Bánh gạo chiên giòn",
            // "Chè đậu đen trái cây", "Bánh mì thịt xào",

            // "Bánh khoai lang chiên giòn", "Chè thạch dừa", "Mực nướng ngũ vị", "Chè đậu đen ngọt ngào", "Xôi bắp",
            // "Chè sầu riêng trân châu", "Bánh tráng cuốn bò viên", "Chè hạt lúa", "Món thịt nướng kiểu Trung Quốc", "Chè khoai sọ",
            // "Bánh bao nhân sầu riêng", "Mực chiên giòn sốt tỏi", "Bánh bột lọc nhân tôm", "Cá nướng lá chuối", "Bánh mỳ bơ tỏi",
            // "Chè bột sắn", "Mực xào lăn", "Bánh tráng cuốn dưa leo", "Chè đậu xanh hạt sen", "Chè đậu đỏ dừa",
            // "Bánh bao chiên giòn", "Mực nướng sốt chanh", "Chè nếp cẩm bọc dừa", "Gà xào sả ớt", "Bánh khoai tây phô mai",
            // "Bánh xèo nhân gà", "Chè bắp", "Món nem rán", "Gỏi tôm cuốn", "Bánh bao nướng", "Sò điệp nướng tỏi",
            // "Chè hạt lựu", "Bánh tráng cuốn thịt nguội", "Chè thạch bột sắn", "Mực chiên xù", "Bánh tráng cuốn thịt bò cuộn",
            // "Bánh mì thịt bò nướng phô mai", "Chè gạo nếp nấu dừa", "Bánh bao nhân đậu đỏ", "Bánh khoai mì chiên", "Chè đậu đen đậu ván",
            // "Gà chiên xù", "Bánh mì nhân trứng", "Chè sương sa chanh dây", "Bánh khoai tây xào tôm", "Bánh chưng",
            // "Chè đậu đỏ trân châu", "Gỏi cuốn hải sản", "Bánh mì nướng mật ong", "Chè đậu đen trân châu", "Bánh cuốn thịt nướng",
            // "Bánh tráng cuốn gà nướng", "Chè bột báng", "Xôi ngọt nấu đường", "Bánh nếp sầu riêng", "Gỏi cuốn thịt lợn",
            // "Chè đậu xanh bột báng", "Bánh gạo cuộn thịt", "Chè sầu riêng thạch rau câu", "Bánh cuốn thịt heo", "Chè đậu đỏ",
            // "Xôi dẻo gừng", "Bánh mì xíu mại", "Chè hạt sen phô mai", "Bánh tráng cuốn tôm hùm", "Chè đậu xanh nấu đường",
            // "Mực nướng mỡ hành", "Bánh mì ốp la", "Chè thạch bưởi", "Bánh bao chiên tôm", "Chè đậu đen ngọt",
            // "Món cá hồi nướng", "Bánh bao hấp", "Xôi nếp đậu xanh", "Bánh bột lọc nhân đậu xanh", "Chè hạt sen đậu đen",
            // "Mực chiên bơ tỏi", "Chè đậu xanh thơm ngọt", "Bánh mì dưa leo", "Bánh mì tỏi nướng", "Chè bí đỏ đậu xanh",
            // "Bánh quy mè", "Xôi mặn gà nướng", "Bánh nếp nhân thịt heo", "Mực xào cay ngọt", "Chè đậu ván nước cốt dừa",
            // "Xôi thập cẩm", "Bánh xếp nhân gà", "Chè đậu xanh sữa dừa", "Bánh mì chiên nhân tôm", "Chè bột lọc đậu đỏ",
            // "Mực chiên giòn bột chiên", "Bánh khoai lang nướng", "Chè bí đỏ đậu xanh", "Bánh bột chiên nhân thịt", "Chè ngọt bột sắn",
            // "Bánh bao chiên nhân thịt", "Chè hạt đác", "Bánh bao nhân thịt gà", "Chè thạch rau câu nước cốt dừa", "Chè đậu đỏ nấu sữa",
            // "Mực xào rau củ", "Bánh khoai lang chiên bơ", "Xôi lá cẩm", "Chè đậu đen khoai môn", "Bánh mì bơ nướng",
            // "Chè đậu xanh bột báng", "Gà rang ngũ vị", "Bánh tráng cuốn đậu hũ", "Chè ngọt gạo nếp", "Bánh mì chiên",
            // "Mực nướng hành tỏi", "Xôi trứng muối", "Bánh mì cuộn thịt", "Chè đậu đen khoai tây", "Bánh tráng cuốn tôm thịt",
            // "Bánh xèo thập cẩm", "Chè đậu đỏ hạt sen", "Bánh nếp đậu đỏ", "Bánh bao nướng nhân thịt", "Chè đậu đỏ nước cốt dừa",
            // "Mực chiên xù muối ớt", "Bánh tráng cuốn thịt gà", "Chè đậu xanh nấu đậu đỏ", "Bánh xèo thịt bò nướng",
            // "Chè hạt lúa ngọt", "Bánh mì nhân thịt bò", "Xôi ngọt đậu xanh", "Bánh tráng cuốn chả lụa", "Chè đậu xanh nước dừa",
        ];


        $maxphotoId =  Photo::count();
        $maxCateId =  Category::count();

        $unitAr = ['gói', 'thùng', 'chai', 'lon', ];
        $faker = Faker::create();

        foreach ($productNames as $name) {
            $randomKey = array_rand($unitAr);
            $tt = $faker->sentence($nbWords = 10, $variableNbWords = true);



            $description = "<p>" . "Mô tả cho " . $name . "</p><br>";
            $description .= "<ul>";
            // for ($i = 0; $i < 50; $i++) {
            for ($i = 0; $i < 5; $i++) {
                $description .= "<li>" . $faker->paragraph($nbSentences = 3, $variableNbSentences = true) . "</li>";
            }
            $description .= "</ul>";

            $unit = $unitAr[$randomKey] ;
            $product = Product::create([
                'fullname_vi' => $name,
                'fullname_zh' => 'cn ' . $name,
                'slug' => Str::slug($name) . "-" .  rand(1 , 10000) , 
                'description_vi' => $description,
                'description_zh' => 'cn' . $description,
                // 'price' => rand(1 , 100) * 1000,
                // 'cost_price' => rand(1 , 100) * 500,
                // 'discount_percent' => rand(0 , 7) * 5,
                // 'stock_quantity' => rand(50, 500),
                // 'sold_quantity' => rand(0, 500),
                'unit' => $unit,
            ]);

            $product->variants()->create([
                // 'variant_title' => '1 ' . $unit,
                'package_item_count' => 0,
                'package_item_unit' => $unit,
                'net_unit_value' => 0,
                'price' => rand(1 , 100) * 1000,
                'cost_price' => rand(1 , 100) * 1000,
                'discount_percent' =>  rand(0 , 7) * 5,
                'stock_quantity' =>  rand(50, 500),
                'sold_quantity' => rand(50, 500),
            ]);

            $product->categories()->attach( [rand( 2, $maxCateId ) ,rand( 2, $maxCateId )] );

            $product->photos()->attach([ 
                rand( 1, $maxphotoId ),
                rand( 1, $maxphotoId ),
                rand( 1, $maxphotoId ),
                rand( 1, $maxphotoId ),
                rand( 1, $maxphotoId ),
            ]);
        }

        $nuocTangLuc = Product::create([
            'fullname_vi' => "Nước tăng lực Redbull Thái Kẽm Vitamin 250ml",
            'fullname_zh' => 'cn ' . "Nước tăng lực Redbull Thái Kẽm Vitamin 250ml",
            'slug' => Str::slug("Nước tăng lực Redbull Thái Kẽm Vitamin 250ml"), 
            'description_vi' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'description_zh' => 'cn ' . $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            // 'price' => rand(1 , 100) * 1000,
            // 'cost_price' => rand(1 , 100) * 500,
            // 'discount_percent' => rand(0 , 7) * 5,
            // 'stock_quantity' => rand(50, 500),
            // 'sold_quantity' => rand(0, 500),
            'unit' => 'lon',
        ]);
        $nuocTangLuc->categories()->attach( [2] );

        $nuocTangLuc->photos()->attach([ 
            rand( 1, $maxphotoId ),
            rand( 1, $maxphotoId ),
            rand( 1, $maxphotoId ),
            rand( 1, $maxphotoId ),
            rand( 1, $maxphotoId ),
        ]);

        $nuocTangLuc->variants()->create([
            'variant_title' => 'lon',
            'package_item_count' => 1,
            'package_item_unit' => 'lon',
            'net_unit_value' => 0,
            'price' => 13200,
            'cost_price' => 13200,
            'discount_percent' => rand(0 , 7) * 5,
            'stock_quantity' => rand(50, 500),
            'sold_quantity' => rand(0, 500),
        ]);

        $nuocTangLuc->variants()->create([
            'variant_title' => 'lốc 6 lon',
            'package_item_count' => 6,
            'package_item_unit' => 'lon',
            'net_unit_value' => 0,
            'price' => 55000,
            'cost_price' => 55000,
            'discount_percent' => rand(0 , 7) * 5,
            'stock_quantity' => rand(50, 500),
            'sold_quantity' => rand(0, 500),
        ]);

        $nuocTangLuc->variants()->create([
            'variant_title' => 'thùng 24 lon',
            'package_item_count' => 24,
            'package_item_unit' => 'lon',
            'net_unit_value' => 0,
            'price' => 279000,
            'cost_price' => 279000,
            'discount_percent' => rand(0 , 7) * 5,
            'stock_quantity' => rand(50, 500),
            'sold_quantity' => rand(0, 500),
        ]);


        $keoDeoTraiCay = Product::create([
            'fullname_vi' => "Kẹo dẻo trái cây",
            'fullname_zh' => 'cn ' . "Kẹo dẻo trái cây",
            'slug' => Str::slug("Kẹo dẻo trái cây"), 
            'description_vi' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'description_zh' => 'cn ' . $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'unit' => 'Kg',
        ]);
        $keoDeoTraiCay->categories()->attach( [2] );

        $keoDeoTraiCay->photos()->attach([ 
            rand( 1, $maxphotoId ),
            rand( 1, $maxphotoId ),
            rand( 1, $maxphotoId ),
            rand( 1, $maxphotoId ),
            rand( 1, $maxphotoId ),
        ]);

        $keoDeoTraiCay->variants()->create([
            'variant_title' => '300 gram',
            'package_item_count' => 0,
            'package_item_unit' => 'Kg',
            'net_unit_value' => 0.3,
            'price' => 13200,
            'cost_price' => 13200,
            'discount_percent' => rand(0 , 7) * 5,
            'stock_quantity' => rand(50, 500),
            'sold_quantity' => rand(0, 500),
        ]);

        $keoDeoTraiCay->variants()->create([
            'variant_title' => '400 gram',
            'package_item_count' => 0,
            'package_item_unit' => 'Kg',
            'net_unit_value' => 0.4,
            'price' => 13200,
            'cost_price' => 13200,
            'discount_percent' => rand(0 , 7) * 5,
            'stock_quantity' => rand(50, 500),
            'sold_quantity' => rand(0, 500),
        ]);

        $keoDeoTraiCay->variants()->create([
            'variant_title' => '500 gram',
            'package_item_count' => 0,
            'package_item_unit' => 'Kg',
            'net_unit_value' => 0.5,
            'price' => 13200,
            'cost_price' => 13200,
            'discount_percent' => rand(0 , 7) * 5,
            'stock_quantity' => rand(50, 500),
            'sold_quantity' => rand(0, 500),
        ]);

 

        $snackKhoaiTay = Product::create([
            'fullname_vi' => " Snack khoai tây",
            'fullname_zh' => 'cn ' . " Snack khoai tây",
            'slug' => Str::slug(" Snack khoai tây"), 
            'description_vi' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'description_zh' => 'cn ' . $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'unit' => 'gói',
        ]);
        $snackKhoaiTay->categories()->attach( [2] );

        $snackKhoaiTay->photos()->attach([ 
            rand( 1, $maxphotoId ),
            rand( 1, $maxphotoId ),
            rand( 1, $maxphotoId ),
            rand( 1, $maxphotoId ),
            rand( 1, $maxphotoId ),
        ]);

        $snackKhoaiTay->variants()->create([
            'variant_title' => 'Vàng (Không cay)',
            'package_item_count' => 0,
            'package_item_unit' => 'gói',
            'net_unit_value' => 0,
            'price' => 14900,
            'cost_price' => 13000,
            'discount_percent' => rand(0 , 7) * 5,
            'stock_quantity' => rand(50, 500),
            'sold_quantity' => rand(0, 500),
        ]);
        $snackKhoaiTay->variants()->create([
            'variant_title' => 'Đỏ (Cay)',
            'package_item_count' => 0,
            'package_item_unit' => 'gói',
            'net_unit_value' => 0,
            'price' => 14900,
            'cost_price' => 13000,
            'discount_percent' => rand(0 , 7) * 5,
            'stock_quantity' => rand(50, 500),
            'sold_quantity' => rand(0, 500),
        ]);















        // $nuocTangLuc1Lon = Product::create([
        //     'fullname_vi' => "Nước tăng lực Redbull Thái Kẽm Vitamin 250ml",
        //     'fullname_zh' => 'cn ' . "Nước tăng lực Redbull Thái Kẽm Vitamin 250ml",
        //     // 'slug' => Str::slug("Nước tăng lực Redbull Thái Kẽm Vitamin 250ml"), 
        //     'description_vi' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //     'description_zh' => 'cn ' . $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            // 'price' => 13200,
            // 'cost_price' => 13200,
            // 'discount_percent' => rand(0 , 7) * 5,
            // 'stock_quantity' => rand(50, 500),
            // 'sold_quantity' => rand(0, 500),
        //     'unit' => 'lon',
            // 'package_item_count' => 1,
            // 'package_item_unit' => 'lon',
            // 'variant_title' => 'lon',
            // 'parent_id' => $nuocTangLuc->id,
        // ]);

        
        // $nuocTangLuc1Lon->photos()->attach([ 
        //     rand( 1, $maxphotoId ),
        //     rand( 1, $maxphotoId ),
        // ]);
        
        // $nuocTangLucLoc6Lon = Product::create([
        //     'fullname_vi' => "6 lon nước tăng lực Redbull Thái kẽm và vitamin 250ml",
        //     'fullname_zh' => 'cn ' . "6 lon nước tăng lực Redbull Thái kẽm và vitamin 250ml",
        //     // 'slug' => Str::slug("6 lon nước tăng lực Redbull Thái kẽm và vitamin 250ml"), 
        //     'description_vi' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //     'description_zh' => 'cn ' . $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            // 'price' => 13200,
            // 'cost_price' => 13200,
            // 'discount_percent' => rand(0 , 7) * 5,
            // 'stock_quantity' => rand(50, 500),
            // 'sold_quantity' => rand(0, 500),
        //     'unit' => 'lon',
        //     // 'package_item_count' => 6,
        //     // 'package_item_unit' => 'lon',
        //     // 'variant_title' => 'Lốc 6 Lon',
        //     // 'parent_id' => $nuocTangLuc->id,
        // ]);

        // $nuocTangLucLoc6Lon->photos()->attach([ 
        //     rand( 1, $maxphotoId ),
        //     rand( 1, $maxphotoId ),
        // ]);

        // $nuocTangLucThung24Lon = Product::create([
        //     'fullname_vi' => "NThùng 24 lon nước tăng lực Redbull Thái kẽm và vitamin 250ml",
        //     'fullname_zh' => 'cn ' . "Thùng 24 lon nước tăng lực Redbull Thái kẽm và vitamin 250ml",
        //     // 'slug' => Str::slug("Thùng 24 lon nước tăng lực Redbull Thái kẽm và vitamin 250ml"), 
        //     'description_vi' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //     'description_zh' => 'cn ' . $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //     'price' => 279000,
        //     'cost_price' => 279000,
        //     'discount_percent' => rand(0 , 7) * 5,
        //     'stock_quantity' => rand(50, 500),
        //     'sold_quantity' => rand(0, 500),
        //     'unit' => 'lon',
        // //     'package_item_count' => 24,
        // //     'package_item_unit' => 'lon',
        // //     'variant_title' => 'lon',
        // //     'parent_id' => $nuocTangLuc->id,
        // ]);

        // $nuocTangLucThung24Lon->photos()->attach([ 
        //     rand( 1, $maxphotoId ),
        //     rand( 1, $maxphotoId ),
        // ]);






    }
}
