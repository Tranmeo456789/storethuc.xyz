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
                'fullname' => 'H??? t??n',
                'password' => 'M???t kh???u',
                'phone' => 'S??? ??i???n tho???i',
                'email' => 'Email',
                'member_id' => 'M?? th??nh vi??n',
                'province_id' => 'T???nh, th??nh ph???',
                'district_id' => 'Qu???n, Huy???n',
                'ward_id' => 'X??, ph?????ng, th??? tr???n',
                'sell_area' => 'Khu v???c b??n h??ng',
                'tax_code' => 'M?? s??? thu???',
                'person_represent' =>'Ng?????i ?????i di???n ph??p lu???t',
                'address' => '?????a ch???',
                'parent_id' => 'Danh m???c cha',
                'cat_id' => 'Danh m???c',
                'user_type_id' => '?????i t?????ng',
                'price' => 'Gi?? b??n',
                'unit_id' => '????n v???',
                'thumbnail'=>'Ch???n ???nh ?????i di???n cho s???n ph???m',
                'status'=>'Tr???ng th??i s???n ph???m',
                'content' =>'Th??ng tin chung',
                'describe' => 'M?? t??? ng???n',
                'prescribe' => 'Ch??? ?????nh',
                'dosage' => 'C??ch d??ng, li???u l?????ng',
                'note' => 'L??u ??',
                'preserve' => 'B???o qu???n',
                'local' => 'S??? nh??, ???????ng, ???p, kh??m',
                'warehouse_id' => 'Kho h??ng',
                'quantity' => 'S??? l?????ng',
                'price_import' => 'Gi?? nh???p',
                'code_order' => 'M?? ????n h??ng',
                'status_order' => 'Tr???ng th??i ????n h??ng',
                'delivery_service'=>'????n v??? v???n chuy???n',
                'image'=>'H??nh ???nh',
                'role_id'=>'Ch???n nh??m quy???n'
            ],
            'status_product' => [
                'con_hang' => 'C??n h??ng',
                'het_hang' => 'H???t h??ng',
            ],
            'status_page' => [
                'cong_khai' => 'C??ng khai',
                'cho_duyet' => 'Ch??? duy???t',
            ],
            'status_slider' => [
                'cong_khai' => 'C??ng khai',
                'cho_duyet' => 'Ch??? duy???t',
            ],
            'status_user' => [
                'kich_hoat' => 'K??ch ho???t',
                'vo_hieu_hoa' => 'V?? hi???u h??a',
            ],
            'status_post' => [
                'cong_khai' => 'C??ng khai',
                'cho_duyet' => 'Ch??? duy???t',
            ],
            'type_gender' => [
                '1' => 'Anh',
                '2' => 'Ch???',
            ],
            'type_product' => [
                '1' => 'S???n ph???m lo???i th?????ng',
                '2' => 'Qu?? t???ng'
            ],
            'tick'=>[
                '1' => 'H??ng d??? v???',
                '2' => 'H??ng b???o qu???n l???nh'
            ],
            'yes_no' => [
                'yes' => 'C??',
                'no' => 'Kh??ng'
            ],
            'type_price' => [
                '1' => 'Gi?? b??n h??ng ni??m y???t',
                '2' => 'Gi?? theo doanh thu'
            ],
            'type_featurer' => [
                'noi_bat' => 'S???n ph???m n???i b???t',
                'hau_covid' => 'S???n ph???m h???u covid',
                'tre_em' => 'Tr??? em',
                'nguoi_cao_tuoi' => 'Ng?????i cao tu???i',
                'phu_nu_cho_con_bu' => 'Ph??? n??? cho con b??'
            ],

            'char_level' => "|---",
            'column' => [
                'status_product'      => [
                   
                    'con_hang'      => ['name' => 'C??n h??ng', 'class' => 'item-tab'],
                    'het_hang'      => ['name' => 'H???t h??ng', 'class'  => 'item-tab']                   
                ],
                'status_page'      => [
                   
                    'cong_khai'      => ['name' => 'C??ng khai', 'class' => 'item-tab'],
                    'cho_duyet'      => ['name' => 'Ch??? duy???t', 'class'  => 'item-tab']                   
                ],
                'status_slider'      => [
                   
                    'cong_khai'      => ['name' => 'C??ng khai', 'class' => 'item-tab'],
                    'cho_duyet'      => ['name' => 'Ch??? duy???t', 'class'  => 'item-tab']                   
                ],
                'status_user'      => [
                   
                    'kich_hoat'      => ['name' => 'K??ch ho???t', 'class' => 'item-tab'],
                    'vo_hieu_hoa'      => ['name' => 'V?? hi???u h??a', 'class'  => 'item-tab']                   
                ],
                'status_post'      => [
                   
                    'cong_khai'      => ['name' => 'C??ng khai', 'class' => 'item-tab'],
                    'cho_duyet'      => ['name' => 'Ch??? duy???t', 'class'  => 'item-tab']                   
                ],
                'status_order' => [
                    'all'          => ['name' => 'T???t c???', 'class' => 'item-tab'],
                    'dangXuLy'     => ['name' => '??ang x??? l??', 'class' => 'item-tab'],
                    'dangGiaoHang' => ['name' => '??ang giao h??ng', 'class' => 'item-tab'],
                    'daXacNhan'    => ['name' => '???? x??c nh???n', 'class' => 'item-tab'],
                    'daGiaoHang'   => ['name' => '???? giao h??ng', 'class' => 'item-tab'],
                    'daHuy'        => ['name' => '???? h???y', 'class' => 'item-tab'],
                    'hoanTat'      => ['name' => 'Ho??n t???t', 'class' => 'item-tab']
                ],
                'delivery_service'=> [
                    ''     => ['name' => 'C???a h??ng t??? ship', 'class' => 'item-tab','link'=>''],
                    'viettel_post'     => ['name' => 'Viettel Post', 'class' => 'item-tab','link'=>'https://viettelpost.com.vn/tra-cuu-hanh-trinh-don/'],
                    'buu_dien' => ['name' => 'B??u ??i???n', 'class' => 'item-tab','link'=>'http://www.vnpost.vn/vi-vn/dinh-vi/buu-pham?key='],
                    'giao_hang_tiet_kiem' => ['name' => 'Giao h??ng ti???t ki???m', 'class' => 'item-tab','link'=>'https://i.ghtk.vn/'],
                    'giao_hang_nhanh' => ['name' => 'Giao h??ng nhanh', 'class' => 'item-tab','link'=>'https://donhang.ghn.vn/?order_code='],
                    'j_and_t' => ['name' => 'J&T', 'class' => 'item-tab','link'=>'https://jtexpress.vn/vi/tracking?type=track&billcode=']                   
                ]
            ],
            'search'       => [
                'all'      => ['name'=>'T??m ki???m T???t c???'],
                'name'     => ['name'=>'T??m ki???m theo T??n'],
                'fullname' => ['name'=>'T??m ki???m theo H??? t??n'],
                'email' => ['name'=>'T??m ki???m theo Email'],
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