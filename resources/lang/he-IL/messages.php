<?php

return [

    'success' => [
        'added'             => ':type נוסף!',
        'updated'           => ':type עודכן!',
        'deleted'           => ':type נמחק!',
        'duplicated'        => ':type שוכפל!',
        'imported'          => ':type יובא!',
    ],
    'error' => [
        'over_payment'      => 'שגיאה: התשלום לא הוסף! הסכום עובר את הסכום הכולל.',
        'not_user_company'  => 'שגיאה: אינך מורשה לנהל החברה זאת!',
        'customer'          => 'שגיאה: המשתמש לא נוצר! :name כבר משתמש בכתוב הזאת.',
        'no_file'           => 'שגיאה: אין קובץ שנבחר!',
        'last_category'     => 'שגיאה: לא ניתן למחוק האחרונים :type קטגוריה!',
        'invalid_token'     => 'שגיאה: ה-token שהוזן אינו חוקי!',
    ],
    'warning' => [
        'deleted'           => 'אזהרה: אסור לך למחוק <b>:name</b> כי יש לו :text מקושר.',
        'disabled'          => 'אזהרה: אינך מורשה לכבות <b>:name</b> כי יש לו :text מקושר.',
    ],

];
