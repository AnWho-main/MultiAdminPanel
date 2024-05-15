<?php

return [
    "rules" => [
        'user_id'               => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'country_id'            => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'category_id'           => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'state_id'              => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'city_id'               => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'address_id'            => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'product_id'            => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'name'                  => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'flat_house_no'         => "bail|required|string",
        'first_name'            => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'last_name'             => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'address'               => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'keyword'               => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'address1'              => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'address2'              => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'street'                => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'landmark'              => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'city'                  => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'state'                 => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'country'               => "bail|required|regex:/^[a-z A-Z\.]*$/|min:2|max:120",
        'zip'                   => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'location'              => "bail|required|string|in:home,work,others",
        'email'                 => "bail|required|email|unique:users",
        'email_id'              => "bail|required|email",
        'email_key'             => "bail|required|string",
        'mobile'                => "required|numeric|regex:/^[6-9]\d{9}$/",
        'mobile_no'             => "required|numeric|regex:/^[6-9]\d{9}$/",
        'from_date'             => "required|date|date_format:Y-m-d",
        'to_date'               => "required|date|date_format:Y-m-d",
        'password'              => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        'current_password'      => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        'new_password'          => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        'retype_password'       => 'required|same:new_password',
        
        
    ],


    "api_validations" =>[
        
         



        /*
            Country, State & City
        */

        "allStateByCountry" => [
            "required" => [
                 "country_id"
            ],
            "optional" => [
            ]
        ], 
        "allCityByStateCountry" => [
            "required" => [
                "country_id", "state_id"
            ],
            "optional" => [
            ]
        ], 

        "allUserAddressGet" => [
            "required" => [
                "user_id"
            ],
            "optional" => [
            ]
        ], 

        "addressGetById" => [
            "required" => [
                "user_id", "address_id"
            ],
            "optional" => [

            ]
        ], 

        "userAddressAdd" => [
            "required" => [
                "user_id", 
                "flat_house_no",
                "address1",
                "street",
                "landmark",
                "city",
                "state",
                "country",
                "zip",
                "location",
            ],
            "optional" => [

            ]
        ], 

        "userAddressEdit" => [
            "required" => [
                "address_id",
                "user_id", 
                "flat_house_no",
                "address1",
                "street",
                "landmark",
                "city",
                "state",
                "country",
                "zip",
                "location",
            ],
            "optional" => [

            ]
        ],

        "userAddressDelete" => [
            "required" => [
                "address_id",
                "user_id", 
            ],
            "optional" => [

            ]
        ], 



        /*
            Login, Register, Forgot, Change forgot
        
        */

        "register" => [
            "required" => [
                "name",
                "email",
                "mobile",
                "password"
            ],
            "optional" => [
            ]
        ], 

        "userLogin" => [
            "required" => [
                "email_id",
                "password"
            ],
            "optional" => [
            ]
        ], 

        "forgotPass" => [
            "required" => [
                "email",
            ],
            "optional" => [
            ]
        ], 

        "changeforgotPass" => [
            "required" => [
                "email", "new_password", "retype_password"
            ],
            "optional" => [
            ]
        ],





        /*
            User Profile
        */
        "userProfileGet" => [
            "required" => [
                "user_id"
            ],
            "optional" => [
            ]
        ], 
        "passwordChange" => [
            "required" => [
                "user_id", 'current_password', 'new_password', 'retype_password'
            ],
            "optional" => [
            ]
        ],
        
         
        /*
            Dasboard
        */
        "allCollectionGetByCategory" => [
            "required" => [
                "category_id"
            ],
            "optional" => [
            ]
        ],
        "productSearch" => [
            "required" => [
                "keyword"
            ],
            "optional" => [
            ]
        ],
        "productDetails" => [
            "required" => [
                "product_id"
            ],
            "optional" => [
            ]
        ],
        
        

       

    ],
];
