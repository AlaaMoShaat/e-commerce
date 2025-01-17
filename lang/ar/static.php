<?php

################## Translation For All Static Data ##################

return [
    'global' => [
        'site_name' => 'المتجر الاكتروني',
        'dashboard' => 'لوحة التحكم',
        'home' => 'الرئيسية',
        'roles' => 'الأدوار',
        'select_all' => 'تحديد الكل',
        'created_at' => 'تاريخ الانشاء',
        'email' => 'البريد الاكتروني',
        'password' => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'phone' => 'رقم الهاتف',
        'status' => 'الحالة',
        'back_to_home' => 'الرجوع للصفحة الرئيسية',
        'no_items' => 'لا يوجد',
        'select' => 'اختار من هنا',
        'sure' => 'هل انت متأكد!!',
        'users' => 'المستخدمين',
        'search' => 'بحث',
        'price'   => 'السعر',
        'sipping_price' => 'سعر الشحن',
        'change_price' => 'تغيير سعر الشحن',
    ],
    'errors' => [
        '403' => 'عذرًا! ليس لديك صلاحية للوصول إلى هذه الصفحة.',
        '404' => 'عذرًا! الصفحة المطلوبة غير موجودة.',
        '500' => 'عذرًا! حدث خطأ في النظام. يُرجى المحاولة مرة أخرى.',
        '429' => 'عذرًا! تم إرسال عدد كبير جدًا من الطلبات. يُرجى المحاولة لاحقًا.',
        '419' => 'عذرًا! انتهت صلاحية الجلسة. يُرجى تحديث الصفحة والمحاولة مرة أخرى.',

    ],
    'actions' => [
        'title' => 'الإجراءات',
        'delete' => 'حذف',
        'edit' => 'تعديل',
        'show' => 'عرض',
        'save' => 'حفظ',
        'change_status' => 'تغيير الحالة',
        'cancel' => 'الغاء',
    ],
    'status' => [
        'title' => 'الحالة',
        'active' => 'نشط',
        'inactive' => 'غير نشط'
    ],
    'authorization' => [
        'create_role' => 'إنشاء دور',
        'edit_role' => 'تعديل الدور',
        'role_name_ar' => 'اسم الدور بالعربية',
        'role_name_en' => 'اسم الدور بالانجليزية',
        'permassions' => 'الصلاحيات',
        'select_permassions' => 'تحديد الصلاحيات',
        'related_admins' => 'الحاصلين عليها',
        'create_new_role' => 'إنشاء دور جديد',
    ],
    'admins' => [
        'title' => 'المسؤولين',
        'create_admin' => 'إنشاء مسؤول',
        'edit_admin' => 'تعديل المسؤول',
        'admin_name' => 'اسم المسؤول',
        'role' => 'الدور',
        'admin_name_ar' => 'اسم المسؤول بالعربية',
        'admin_name_en' => 'اسم المسؤول بالانجليزية',
        'create_new_admin' => 'إنشاء مسؤول جديد',
    ],
    'regions' => [
        'title' => 'المناطق',

        'countries' => 'الدول',
        'country_name' => 'اسم الدولة',
        'country_name_ar' => 'اسم الدولة باللغة العربية',
        'country_name_en' => 'اسم الدولة باللغة الإنجليزية',
        'create_country' => 'إنشاء دولة',
        'create_new_country' => 'إنشاء دولة جديدة',
        'edit_country' => 'تعديل الدولة',
        'show_country' => 'عرض دولة',
        'country_code' => 'رمز الدولة',
        'phone_code' => 'رمز الهاتف',
        'delete_country_msg' => 'سيتم حذف المحافظات والمدن التي تنتمي إليها!!',


        'governorates' => 'المحافظات',
        'governorate_name' => 'اسم المحافظة',
        'governorate_name_ar' => 'اسم المحافظة باللغة العربية',
        'governorate_name_en' => 'اسم المحافظة باللغة الإنجليزية',
        'create_governorate' => 'إنشاء محافظة',
        'create_new_governorate' => 'إنشاء محافظة جديدة',
        'edit_governorate' => 'تعديل المحافظة',
        'show_governorate' => 'عرض محافظة',
        'delete_governorate_msg' => 'سيتم حذف المدن التي تنتمي إليها!!',
        'governorates_of' => 'محافظات دولة',


        'cities' => 'المدن',
        'city_name' => 'اسم المدينة',
        'city_name_ar' => 'اسم المدينة باللغة العربية',
        'city_name_en' => 'اسم المدينة باللغة الإنجليزية',
        'create_city' => 'إنشاء مدينة',
        'create_new_city' => 'إنشاء مدينة جديدة',
        'edit_city' => 'تعديل المدينة',
        'show_city' => 'عرض مدينة',
        'cities_of' => 'مدن محافظة',
    ],

    'categories' => [
        'title' => 'الفئات',
        'create_category' => 'إنشاء فئة',
        'edit_category' => 'تعديل الفئة',
        'category_name' => 'اسم الفئة',
        'category_name_ar' => 'اسم الفئة بالعربية',
        'category_name_en' => 'اسم الفئة بالإنجليزية',
        'create_new_category' => 'إنشاء فئة جديدة',
    ],

    'brands' => [
        'title' => 'العلامات التجارية',
        'create_brand' => 'إنشاء علامة تجارية',
        'edit_brand' => 'تعديل العلامة التجارية',
        'brand_name' => 'اسم العلامة التجارية',
        'brand_name_ar' => 'اسم العلامة التجارية بالعربية',
        'brand_name_en' => 'اسم العلامة التجارية بالإنجليزية',
        'create_new_brand' => 'إنشاء علامة تجارية جديدة',
    ],

];