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
                'select2_feeship' => [
                    'class' => 'form-control col-md-12 col-xs-12 select2 get_fee_ship'
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
                'cat_id' => 'Danh mục',
                'user_type_id' => 'Đối tượng',
                'price' => 'Giá bán',
                'unit_id' => 'Đơn vị',
                'thumbnail'=>'Chọn ảnh đại diện cho sản phẩm',
                'status'=>'Trạng thái sản phẩm',
                'content' =>'Thông tin chung',
                'describe' => 'Mô tả ngắn',
                'prescribe' => 'Chỉ định',
                'dosage' => 'Cách dùng, liều lượng',
                'note' => 'Lưu ý',
                'preserve' => 'Bảo quản',
                'local' => 'Số nhà, đường, ấp, khóm',
                'warehouse_id' => 'Kho hàng',
                'quantity' => 'Số lượng',
                'price_import' => 'Giá nhập',
                'code_order' => 'Mã đơn hàng',
                'status_order' => 'Trạng thái đơn hàng',
                'delivery_service'=>'Đơn vị vận chuyển',
                'image'=>'Hình ảnh',
                'role_id'=>'Chọn nhóm quyền',
                'inventory'=>'Số lượng tồn kho',
                'promotion'=>'Khuyến mãi(%)'
            ],
            'status_product' => [
                'con_hang' => 'Còn hàng',
                'het_hang' => 'Hết hàng',
            ],
            'status_page' => [
                'cong_khai' => 'Công khai',
                'cho_duyet' => 'Chờ duyệt',
            ],
            'status_slider' => [
                'cong_khai' => 'Công khai',
                'cho_duyet' => 'Chờ duyệt',
            ],
            'status_user' => [
                'kich_hoat' => 'Kích hoạt',
                'vo_hieu_hoa' => 'Vô hiệu hóa',
            ],
            'status_post' => [
                'cong_khai' => 'Công khai',
                'cho_duyet' => 'Chờ duyệt',
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
                'status_product'      => [
                   
                    'con_hang'      => ['name' => 'Còn hàng', 'class' => 'item-tab'],
                    'het_hang'      => ['name' => 'Hết hàng', 'class'  => 'item-tab']                   
                ],
                'status_page'      => [
                   
                    'cong_khai'      => ['name' => 'Công khai', 'class' => 'item-tab'],
                    'cho_duyet'      => ['name' => 'Chờ duyệt', 'class'  => 'item-tab']                   
                ],
                'status_slider'      => [
                   
                    'cong_khai'      => ['name' => 'Công khai', 'class' => 'item-tab'],
                    'cho_duyet'      => ['name' => 'Chờ duyệt', 'class'  => 'item-tab']                   
                ],
                'status_user'      => [
                   
                    'kich_hoat'      => ['name' => 'Kích hoạt', 'class' => 'item-tab'],
                    'vo_hieu_hoa'      => ['name' => 'Vô hiệu hóa', 'class'  => 'item-tab']                   
                ],
                'status_post'      => [
                   
                    'cong_khai'      => ['name' => 'Công khai', 'class' => 'item-tab'],
                    'cho_duyet'      => ['name' => 'Chờ duyệt', 'class'  => 'item-tab']                   
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
                'delivery_service'=> [
                    ''     => ['name' => 'Cửa hàng tự ship', 'class' => 'item-tab','link'=>''],
                    'viettel_post'     => ['name' => 'Viettel Post', 'class' => 'item-tab','link'=>'https://viettelpost.com.vn/tra-cuu-hanh-trinh-don/'],
                    'buu_dien' => ['name' => 'Bưu điện', 'class' => 'item-tab','link'=>'http://www.vnpost.vn/vi-vn/dinh-vi/buu-pham?key='],
                    'giao_hang_tiet_kiem' => ['name' => 'Giao hàng tiết kiệm', 'class' => 'item-tab','link'=>'https://i.ghtk.vn/'],
                    'giao_hang_nhanh' => ['name' => 'Giao hàng nhanh', 'class' => 'item-tab','link'=>'https://donhang.ghn.vn/?order_code='],
                    'j_and_t' => ['name' => 'J&T', 'class' => 'item-tab','link'=>'https://jtexpress.vn/vi/tracking?type=track&billcode=']                   
                ]
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