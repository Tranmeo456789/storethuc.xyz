<?php
    return [
        'token_check_login' => 'UAqaYzPVrCW56UgKumKdSN7t',
        'format'           => [
            'long_time'         => 'd/m/Y H:i:s',
            'short_time'        => 'd/m/Y',
            'my_sql_date'       => 'Y-m-d',
            'my_sql_date_time'  => 'Y-m-d H:i:s',
            'number_decimals'   => 0,
            'dec_point'       => ',',
            'thousands_sep'   => '.',
        ],
        'time_cookie' => 30*24*60*60,
        'url' => [
            'api' => 'http://tdoctor.xyz/',
            'prod' => 'shop.tdoctor.vn',
            'dev' => 'shop.tdoctor.xyz',
            'prefix_admin' => 'admincp',
            'prefix_frontEnd'  => '',
        ],
        'baseRequest' => [
            'login' => 'api/v0.4/login',
            'register' => 'api/v0.4/register',
            'getListProvince' => 'api/v0.3/province/get-list',
            'checkLoginStatus' => 'api/v0.3/checkLoginStatus',
        ],
        'template' => [
            'star' => "<span class='text-red ml-2'>*</span>",
            'form_element' => [
                'label' => ['class'=>'col-form-label'],
                'input' => [
                    'class' => 'form-control'
                ],
                'input_frontend' => [
                    'class' => 'input-frontend form-control'
                ],
                'input_radio' => [
                    'class' => 'form-check-input'
                ],
                'input_number' => [
                    'class' => 'form-control number'
                ],
                'editor' => [
                    'class' => 'form-control editor'
                ],
                'select2' => [
                    'class' => 'form-control col-md-12 col-xs-12 select2'
                ],
                'input_datemask' => [
                    'class' => 'form-control datemask',
                    'data-inputmask-alias'=>"dd/mm/yyyy",
                    'data-inputmask-inputformat'=>"dd/mm/yyyy",
                    'im-insert'=>"false"
                ],
                'get_child' =>[
                    'class' => 'get_child'
                ],
                'get_data' =>[
                    'class' => 'get_data'
                ],
            ],
            'label' => [
                'fullname' => 'Họ tên',
                'password' => 'Mật khẩu',
                'phone' => 'Số điện thoại',
                'email' => 'Email',
                'member_id' => 'Mã thành viên',
                'province_id' => 'Tỉnh, thành phố',
                'district_id' => 'Quận, Huyện',
                'ward_id' => 'Xã, phường, thị trấn',
                'sell_area' => 'Khu vực bán hàng',
                'tax_code' => 'Mã số thuế',
                'person_represent' =>'Người đại diện pháp luật',
                'address' => 'Địa chỉ',
                'parent_id' => 'Danh mục cha',
                'cat_product_id' => 'Danh mục thuốc',
                'user_type_id' => 'Đối tượng',
                'producer_id' => 'Nhà sản xuất',
                'trademark_id' =>'Thương hiệu',
                'dosage_forms' => 'Dạng bào chế',
                'specification' => 'Quy cách',
                'country_id' => 'Nước sản xuất',
                'long' => 'Chiều dài (mm)',
                'wide' => 'Chiều rộng (mm)',
                'high' => 'Chiều cao (mm)',
                'mass' => 'Khối lượng (g)',
                'coefficient' => 'Hệ số VAT (%)',
                'price' => 'Giá bán thuốc (chưa VAT)',
                'price_vat' => 'Giá bán thuốc (có VAT)',
                'type_vat' => 'Loại VAT',
                'packing' => 'Quy cách đóng gói',
                'unit_id' => 'Đơn vị',
                'amout_max' => 'Số lượng đặt hàng lớn nhất',
                'inventory_min' => 'Số lượng tồn tối thiếu',
                'type_price' => 'Loại giá bán hàng',
                'general_info' =>'Thông tin chung',
                'benefit' => 'Công dụng',
                'prescribe' => 'Chỉ định',
                'dosage' => 'Cách dùng, liều lượng',
                'note' => 'Lưu ý',
                'preserve' => 'Bảo quản',
                'local' => 'Số nhà, đường, ấp, khóm',
                'warehouse_id' => 'Kho hàng',
                'quantity' => 'Số lượng',
                'price_import' => 'Giá nhập',
                'code_order' => 'Mã đơn hàng',
                'status_order' => 'Trạng thái đơn hàng'
            ],
            'type_user' => [
                '1' => 'Thành viên',
                '2' => 'Bác sĩ',
                '3' => 'Phòng khám',
                '4' => 'Nhà thuốc',
                '5' => 'Bệnh viện',
                '6' => 'Trung tâm y tế',
                '7' => 'Nha khoa',
                '8' => 'Thẩm mỹ viện',
                '9' => 'Công ty dược phẩm'
            ],
            'type_gender' => [
                '1' => 'Anh',
                '2' => 'Chị',
            ],
            'type_product' => [
                '1' => 'Sản phẩm loại thường',
                '2' => 'Quà tặng'
            ],
            'tick'=>[
                '1' => 'Hàng dễ vỡ',
                '2' => 'Hàng bảo quản lạnh'
            ],
            'yes_no' => [
                'yes' => 'Có',
                'no' => 'Không'
            ],
            'type_price' => [
                '1' => 'Giá bán hàng niêm yết',
                '2' => 'Giá theo doanh thu'
            ],
            'type_featurer' => [
                'noi_bat' => 'Sản phẩm nổi bật',
                'hau_covid' => 'Sản phẩm hậu covid',
                'tre_em' => 'Trẻ em',
                'nguoi_cao_tuoi' => 'Người cao tuổi',
                'phu_nu_cho_con_bu' => 'Phụ nữ cho con bú'
            ],

            'char_level' => "|---",
            'column' => [
                'typeProduct'      => [
                    'all'           => ['name' => 'Tất cả', 'class' => 'item-tab'],
                    'dang_ban'      => ['name' => 'Đang bán', 'class'      => 'item-tab'],
                    'ngung_ban'   => ['name' => 'Ngừng bán', 'class' => 'item-tab'],
                    'tam_het_hang' => ['name' => 'Tạm hết hàng', 'class' => 'item-tab'],
                    'gan_het_hang' => ['name' => 'Gần hết hàng', 'class' => 'item-tab'],
                    'cho_kiem_duyet' => ['name' => 'Chờ kiểm duyệt', 'class' => 'item-tab'],
                    'tu_choi' => ['name' => 'Từ chối', 'class' => 'item-tab'],
                ],
                'status_product'      => [                 
                    'cho_kiem_duyet' => ['name' => 'Chờ kiểm duyệt', 'class' => 'item-tab'],
                    'da_duyet' => ['name' => 'Đã duyệt', 'class' => 'item-tab'],
                    'tu_choi' => ['name' => 'Từ chối', 'class' => 'item-tab'],
                ],
                'status_order' => [
                    'all'          => ['name' => 'Tất cả', 'class' => 'item-tab'],
                    'dangXuLy'     => ['name' => 'Đang xử lý', 'class' => 'item-tab'],
                    'dangGiaoHang' => ['name' => 'Đang giao hàng', 'class' => 'item-tab'],
                    'daXacNhan'    => ['name' => 'Đã xác nhận', 'class' => 'item-tab'],
                    'daGiaoHang'   => ['name' => 'Đã giao hàng', 'class' => 'item-tab'],
                    'daHuy'        => ['name' => 'Đã hủy', 'class' => 'item-tab'],
                    'hoanTat'      => ['name' => 'Hoàn tất', 'class' => 'item-tab']
                ],
            ],
            'search'       => [
                'all'      => ['name'=>'Tìm kiếm Tất cả'],
                'name'     => ['name'=>'Tìm kiếm theo Tên'],
                'fullname' => ['name'=>'Tìm kiếm theo Họ tên'],
                'email' => ['name'=>'Tìm kiếm theo Email'],
            ],
        ],
        'folderUpload' => [
            'mainFolder' =>'fileUpload'
        ],
        'config' => [
            'search' => [
                'default'  => ['name'],
                'user' => ['email','fullname']
            ]
        ]
    ];
?>