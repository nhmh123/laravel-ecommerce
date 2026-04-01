<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load TGDD categories first (existing base)
        // $this->loadJsonCategories(base_path('document/tgdd_categories.json'), 'tgdd');

        // Load DMX categories to supplement missing ones (add from dmx_categories.json)
        // $this->loadJsonCategories(base_path('document/dmx_categories.json'), 'dmx');

        $this->runHardcoded(); // Optional: keep hardcoded as fallback or for manual use
    }

    /**
     * Load categories from JSON file in specified format.
     */
    private function loadJsonCategories(string $jsonPath, string $format): void
    {
        if (!file_exists($jsonPath)) {
            return;
        }

        $jsonContent = file_get_contents($jsonPath);
        $data = json_decode($jsonContent, true);

        if (!$data || !is_array($data)) {
            return;
        }

        if ($format === 'tgdd') {
            $this->loadTGDDFormat($data);
        } elseif ($format === 'dmx') {
            $this->loadDMXFormat($data);
        }
    }

    /**
     * Load TGDD format: array of {name, slug, groups: [{group_name, items: [{name, slug}]}]}
     */
    private function loadTGDDFormat(array $data): void
    {
        foreach ($data as $mainCat) {
            $mainSlug = isset($mainCat['slug']) ? ltrim($mainCat['slug'], '/') : $this->slugify($mainCat['name']);
            $main = Category::firstOrCreate(
                ['slug' => $mainSlug],
                ['name' => $mainCat['name']]
            );

            $groups = $mainCat['groups'] ?? [];
            foreach ($groups as $group) {
                $groupName = $group['group_name'] ?? 'group-' . uniqid();
                $groupSlug = $this->slugify($groupName);
                $subgroup = Category::firstOrCreate(
                    ['slug' => $groupSlug, 'parent_id' => $main->id],
                    ['name' => $groupName]
                );

                $items = $group['items'] ?? [];
                foreach ($items as $item) {
                    $itemSlug = isset($item['slug']) ? ltrim($item['slug'], '/') : $this->slugify($item['name']);
                    Category::firstOrCreate(
                        ['slug' => $itemSlug, 'parent_id' => $subgroup->id],
                        ['name' => $item['name']]
                    );
                }
            }
        }
    }

    /**
     * Load DMX format: array of {category, group, items: [{label, url, img}]}
     */
    private function loadDMXFormat(array $data): void
    {
        foreach ($data as $entry) {
            $categoryName = $entry['category'] ?? 'chuong-trinh-hot';
            $mainSlug = $this->slugify($categoryName);
            $main = Category::firstOrCreate(
                ['slug' => $mainSlug],
                ['name' => $categoryName]
            );

            $groupName = $entry['group'] ?? 'group-' . uniqid();
            $groupSlug = $this->slugify($groupName);
            $groupCat = Category::firstOrCreate(
                ['slug' => $groupSlug, 'parent_id' => $main->id],
                ['name' => $groupName]
            );

            $items = $entry['items'] ?? [];
            foreach ($items as $item) {
                $itemName = $item['label'] ?? 'unnamed';
                $itemSlug = $this->slugify($itemName);
                Category::firstOrCreate(
                    ['slug' => $itemSlug, 'parent_id' => $groupCat->id],
                    ['name' => $itemName]
                );
            }
        }
    }

    /**
     * Fallback hardcoded categories (kept but not used unless manually called).
     */
    private function runHardcoded(): void
    {
        $hardcoded = [
            [
                "parent" => "Điện thoại",
                "slug" => "dtdd",
                "children" => [
                    ["name" => "Sạc dự phòng", "slug" => "sac-dtdd"],
                    ["name" => "Sạc, cáp", "slug" => "sac-cap"],
                    ["name" => "Ốp lưng điện thoại", "slug" => "op-lung-flipcover"],
                    ["name" => "Ốp lưng máy tính bảng", "slug" => "op-lung-may-tinh-bang"],
                    ["name" => "Miếng dán", "slug" => "mieng-dan-man-hinh"],
                    ["name" => "Miếng dán Camera", "slug" => "mieng-dan-camera"],
                    ["name" => "Túi đựng AirPods", "slug" => "tui-dung-airpods"],
                    ["name" => "Quạt mini", "slug" => "quat-mini"],
                    ["name" => "Bút tablet", "slug" => "phu-kien-thong-minh"],
                    ["name" => "Giá đỡ điện thoại/laptop/máy tính bảng", "slug" => "gia-do-dien-thoai"],
                    ["name" => "Dây đeo điện thoại", "slug" => "phu-kien-op-lung"],
                    ["name" => "Ống kinh điện thoại", "slug" => "ong-kinh-tele"]
                ]
            ],
            [
                "parent" => "Sản phẩm cao cấp",
                "slug" => "hang-cao-cap",
                "children" => [
                    ["name" => "Xem tất cả", "slug" => "hang-cao-cap"],
                    ["name" => "Sản phẩm Nổi Bật", "slug" => "hang-cao-cap-san-pham-hot"],
                    ["name" => "Đồng hồ thông minh", "slug" => "dong-ho-thong-minh"],
                    ["name" => "Thiết bị giải trí", "slug" => "hang-cao-cap-thiet-bi-giai-tri"],
                    ["name" => "Thiết bị điện lạnh", "slug" => "hang-cao-cap-thiet-bi-dien-lanh"],
                    ["name" => "Gia dụng nhà bếp", "slug" => "hang-cao-cap-gia-dung-nha-bep"],
                    ["name" => "Thiết bị di động", "slug" => "hang-cao-cap-thiet-bi-di-dong"],
                    ["name" => "Gia dụng sắc màu", "slug" => "hang-cao-cap-gia-dung-sac-mau"],
                    ["name" => "Gia dụng sức khỏe", "slug" => "hang-cao-cap-gia-dung-suc-khoe"]
                ]
            ],
            [
                "parent" => "Điện tử - Điện lạnh",
                "slug" => "dien-tu-dien-lanh",
                "children" => [
                    ["name" => "Tivi", "slug" => "tivi"],
                    ["name" => "Máy lạnh", "slug" => "may-lanh"],
                    ["name" => "Tủ lạnh", "slug" => "tu-lanh"],
                    ["name" => "Máy giặt", "slug" => "may-giat"],
                    ["name" => "Máy sấy", "slug" => "may-say"],
                    ["name" => "Tủ đông", "slug" => "tu-dong"],
                    ["name" => "Tủ mát", "slug" => "tu-mat"],
                    ["name" => "Loa Dàn âm thanh", "slug" => "am-thanh"],
                    ["name" => "Tủ ướp rượu", "slug" => "tu-uop-ruou"],
                    ["name" => "Máy chiếu", "slug" => "may-chieu"]
                ]
            ],
            [
                "parent" => "Điện gia dụng",
                "slug" => "dien-gia-dung",
                "children" => [
                    ["name" => "Xem tất cả", "slug" => "gia-dung"],
                    ["name" => "Máy lọc nước", "slug" => "may-loc-nuoc"],
                    ["name" => "Nồi cơm điện", "slug" => "noi-com-dien"],
                    ["name" => "Nồi chiên Nồi nướng", "slug" => "noi-chien-noi-nuong"],
                    ["name" => "Máy nước nóng", "slug" => "may-nuoc-nong"],
                    ["name" => "Quạt điều hòa", "slug" => "may-lam-mat-quat-dieu-hoa"],
                    ["name" => "Quạt", "slug" => "quat"],
                    ["name" => "Máy xay sinh tố", "slug" => "may-xay-sinh-to"],
                    ["name" => "Máy/Robot hút bụi", "slug" => "may-hut-bui-robot-hut-bui"],
                    ["name" => "Máy rửa / Sấy chén", "slug" => "may-rua-chen-say-chen"],
                    ["name" => "Máy ép trái cây", "slug" => "may-ep-trai-cay"],
                    ["name" => "Ấm - Ca - Bình Đun", "slug" => "am-ca-binh-dun"],
                    ["name" => "Máy làm sữa hạt", "slug" => "may-lam-sua-hat"],
                    ["name" => "Bếp từ - hồng ngoại", "slug" => "bep-tu-hong-ngoai"],
                    ["name" => "Bếp gas dương-âm", "slug" => "bep-ga-duong-am"],
                    ["name" => "Lò vi sóng", "slug" => "lo-vi-song"],
                    ["name" => "Máy lọc không khí", "slug" => "may-loc-khong-khi"],
                    ["name" => "Lò nướng", "slug" => "lo-nuong"],
                    ["name" => "Máy xay thịt", "slug" => "may-xay-thit"],
                    ["name" => "Máy vắt cam", "slug" => "may-vat-cam"],
                    ["name" => "Máy hút mùi - hút khói", "slug" => "may-hut-mui-hut-khoi"],
                    ["name" => "Nồi áp suất - hấp", "slug" => "noi-ap-suat-hap"],
                    ["name" => "Máy pha cà phê", "slug" => "may-pha-ca-phe"],
                    ["name" => "Bình thủy điện", "slug" => "binh-thuy-dien"],
                    ["name" => "Máy đánh trứng", "slug" => "may-danh-trung"],
                    ["name" => "Bàn ủi", "slug" => "ban-ui"],
                    ["name" => "Máy đo huyết áp", "slug" => "may-do-huyet-ap"],
                    ["name" => "Sấy tóc", "slug" => "say-toc"],
                    ["name" => "Đồ dùng nhà bếp", "slug" => "do-dung-nha-bep"],
                    ["name" => "Đồ dùng gia đình", "slug" => "do-dung-gia-dinh"],
                    ["name" => "Bình - ly giữ nhiệt", "slug" => "binh-ly-giu-nhiet"],
                    ["name" => "Thiết bị chiếu sáng", "slug" => "thiet-bi-chieu-sang"],
                    ["name" => "Máy làm tỏi đen", "slug" => "may-lam-toi-den"],
                    ["name" => "Bình lọc nước", "slug" => "binh-loc-nuoc"],
                    ["name" => "Máy sấy trái cây", "slug" => "may-say-trai-cay"],
                    ["name" => "Cân sức khỏe", "slug" => "can-suc-khoe"],
                    ["name" => "Nồi lẩu điện", "slug" => "noi-lau-dien"],
                    ["name" => "Máy cạo râu", "slug" => "may-cao-rau"],
                    ["name" => "Ghế Massage", "slug" => "ghe-massage"],
                    ["name" => "Ổn áp", "slug" => "on-ap"],
                    ["name" => "Thiết bị sưởi ấm", "slug" => "thiet-bi-suoi-am"],
                    ["name" => "Máy nóng lạnh", "slug" => "may-nong-lanh"],
                    ["name" => "Bàn chải", "slug" => "suc-khoe-lam-dep"],
                    ["name" => "Lõi lọc nước", "slug" => "loi-may-loc-nuoc"],
                    ["name" => "Nồi chảo", "slug" => "noi-chao"]
                ]
            ],
            [
                "parent" => "Gia dụng",
                "slug" => "gia-dung",
                "children" => [
                    ["name" => "Nồi, chảo", "slug" => "noi-chao"],
                    ["name" => "Đồ dùng thú cưng", "slug" => "do-dung-thu-cung"],
                    ["name" => "Dao, kéo, thớt", "slug" => "gia-dung"],
                    ["name" => "Thùng rác", "slug" => "thung-rac"],
                    ["name" => "Màng bọc, Hộp bảo quản thực phẩm", "slug" => "do-dung-nha-bep"],
                    ["name" => "Bình ly", "slug" => "binh-ly"],
                    ["name" => "Vợt muỗi", "slug" => "den-bat-muoi"],
                    ["name" => "Chén đĩa vá muỗng", "slug" => "do-dung-nha-bep"],
                    ["name" => "Dụng cụ nhà bếp", "slug" => "do-dung-nha-bep"],
                    ["name" => "Tủ kệ đa năng", "slug" => "ghe-ke-da-nang"],
                    ["name" => "Gia vị", "slug" => "gia-vi"],
                    ["name" => "Kệ thao chậu rỗ", "slug" => "thiet-bi-nha-bep"]
                ]
            ],
            [
                "parent" => "Điện thoại, Tablet",
                "slug" => "di-dong-tablet",
                "children" => [
                    ["name" => "Xem tất cả", "slug" => "di-dong-tablet"],
                    ["name" => "Điện thoại", "slug" => "dien-thoai-di-dong"],
                    ["name" => "Máy tính bảng", "slug" => "may-tinh-bang"],
                    ["name" => "Đồng hồ thông minh", "slug" => "dong-ho-thong-minh"],
                    ["name" => "Máy chơi game", "slug" => "game-playstation"],
                    ["name" => "Laptop", "slug" => "laptop"],
                    ["name" => "Camera", "slug" => "camera"],
                    ["name" => "Tai nghe", "slug" => "tai-nghe"],
                    ["name" => "Phụ kiện điện thoại", "slug" => "phu-kien-di-dong"],
                    ["name" => "↓ Cho HSSV & Tài xế công nghệ", "slug" => "giam-them-den-5-toi-da-500000d-cho-hoc-sinh-sinh-vien-tai-xe-cong-nghe-khi-mua-di-dong-samsung-oppo-vivo"]
                ]
            ],
            [
                "parent" => "Phụ kiện",
                "slug" => "phu-kien",
                "children" => [
                    ["name" => "Phụ kiện điện tử", "slug" => "phu-kien-dien-tu"],
                    ["name" => "Phụ kiện điện lạnh", "slug" => "phu-kien"]
                ]
            ],
            [
                "parent" => "Sản phẩm khác",
                "slug" => "san-pham-khac",
                "children" => [
                    ["name" => "Khóa điện tử", "slug" => "khoa-dien-tu"],
                    ["name" => "Máy xịt cao áp", "slug" => "may-xit-rua"],
                    ["name" => "Máy khoan", "slug" => "may-khoan"],
                    ["name" => "Đèn pin", "slug" => "thiet-bi-chieu-sang"],
                    ["name" => "Đèn điện quang", "slug" => "thiet-bi-chieu-sang"],
                    ["name" => "Dụng cụ đa năng", "slug" => "bo-dung-cu-da-nang"],
                    ["name" => "Máy mài", "slug" => "may-mai"],
                    ["name" => "Máy vặn vít", "slug" => "may-van-vit"],
                    ["name" => "Ổ cắm điện", "slug" => "o-cam-dien"]
                ]
            ],
            [
                "parent" => "Nội thất",
                "slug" => "noi-that",
                "children" => [
                    ["name" => "Xem tất cả", "slug" => "noi-that"],
                    ["name" => "Ghế", "slug" => "ghe"],
                    ["name" => "Tủ quần áo", "slug" => "tu-quan-ao"],
                    ["name" => "Sofa", "slug" => "sofa"],
                    ["name" => "Kệ tủ", "slug" => "ke-tu"],
                    ["name" => "Giường", "slug" => "giuong"],
                    ["name" => "Bàn", "slug" => "ban"],
                    ["name" => "Bộ Phòng Ngủ", "slug" => "bo-phong-ngu"],
                    ["name" => "Bộ phòng khách", "slug" => "bo-phong-khach"],
                    ["name" => "Bộ phòng ăn", "slug" => "bo-phong-an"]
                ]
            ]
        ];

        foreach ($hardcoded as $group) {
            $main = Category::firstOrCreate(
                ['slug' => $group['slug']],
                ['name' => $group['parent']]
            );

            foreach ($group['children'] as $child) {
                Category::firstOrCreate(
                    ['slug' => $child['slug'], 'parent_id' => $main->id],
                    ['name' => $child['name']]
                );
            }
        }
    }

    /**
     * Slugify text for URLs.
     */
    private function slugify(string $text): string
    {
        // Convert Vietnamese to ASCII, lowercase, replace spaces with -, remove special chars
        $text = strtolower(trim($text));
        $text = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $text);
        $text = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $text);
        $text = preg_replace('/[íìỉĩị]/u', 'i', $text);
        $text = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $text);
        $text = preg_replace('/[úùủũụưứừửữự]/u', 'u', $text);
        $text = preg_replace('/[ýỳỷỹỵ]/u', 'y', $text);
        $text = preg_replace('/đ/u', 'd', $text);
        $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
        $text = preg_replace('/[\s-]+/', '-', $text);
        return $text;
    }
}
