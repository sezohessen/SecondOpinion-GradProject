<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        /*  [
            'title' => 'Web Site',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ], */
/*
|--------------------------------------------------------------------------
| FAQS (Frequently Asked Questions Section)
|--------------------------------------------------------------------------
*/
        // Location
        [
            'title' => 'Location',
            'icon' => 'media/svg/icons/Map/Marker2.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Governorates',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add governorate',
                            'page' => "/dashboard/governorate/create"
                        ],
                        [
                            'title' => 'View governorates',
                            'page' => '/dashboard/governorate'
                        ],

                    ]
                ],
                [
                    'title' => 'Cities',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add city',
                            'page' => "/dashboard/city/create"
                        ],
                        [
                            'title' => 'View cities',
                            'page' => '/dashboard/city'
                        ],

                    ]
                ],

            ]
        ],
        // Specialties
        [
            'title' => 'Specialties',
            'icon' => 'fas fa-clinic-medical',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    [
                        'title' => 'Add Specialty',
                        'page' => "/dashboard/specialty/create"
                    ],
                    [
                        'title' => 'View Specialties',
                        'page' => '/dashboard/specialty'
                    ],
                ],
            ]
        ],
        // Doctors
        [
            'title' => 'Doctors',
            'icon' => 'fas fa-user-md',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    [
                        'title' => 'Add Doctor',
                        'page' => "/dashboard/doctor/create"
                    ],
                    [
                        'title' => 'View Doctors',
                        'page' => '/dashboard/doctor'
                    ],
                ],
            ]
        ],
        /*
        // Cars Settings
        [
            'title' => 'Cars Settings',
            'icon' => 'fas fa-car',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Brand Classification',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add Class',
                            'page' => "/dashboard/car/class/create"
                        ],
                        [
                            'title' => 'View Classes',
                            'page' => '/dashboard/car/class'
                        ],

                    ]
                ],
                [
                    'title' => 'Car Options',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add A car ',
                            'page' => "/dashboard/car/create"
                        ],
                        [
                            'title' => 'View Cars',
                            'page' => '/dashboard/car'
                        ],

                    ]
                ],
                [
                    'title' => 'Car Makers',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add a manufacturer',
                            'page' => "/dashboard/car/maker/create"
                        ],
                        [
                            'title' => 'View manufacturing',
                            'page' => '/dashboard/car/maker'
                        ],

                    ]

                ],
                [
                    'title' => 'Car Models',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add Car Model',
                            'page' => "/dashboard/car/model/create"
                        ],
                        [
                            'title' => 'View Car Models',
                            'page' => '/dashboard/car/model'
                        ],

                    ]

                ],
                [
                    'title' => 'Years of manufacture',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => "Add Year ",
                            'page' => "/dashboard/car/year/create"
                        ],
                        [
                            'title' => 'View years',
                            'page' => '/dashboard/car/year'
                        ],

                    ]
                ],
                [
                    'title' => 'Car Capacities',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => "Add Capacity ",
                            'page' => "/dashboard/car/capacity/create"
                        ],
                        [
                            'title' => 'View Capacities',
                            'page' => '/dashboard/car/capacity'
                        ],

                    ]
                ],
            ]
        ],
        // Car parts
        [
            'title' => 'Car parts',
            'icon' => 'fas fa-tools',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add part',
                    'page' => "/dashboard/part/create"
                ],
                [
                    'title' => 'View parts',
                    'page' => '/dashboard/part'
                ],
            ]
        ],
        // Sellers
        [
            'title' => 'Sellers',
            'icon' => 'fas fa-users-cog',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'View sellers',
                    'page' => '/dashboard/seller'
                ],
            ]
        ],
        // Manage Users
        [
            'title' => 'Manage Users',
            'icon' => 'media/svg/icons/Communication/Group.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add User',
                    'page' => "/dashboard/users/create"
                ],
                [
                    'title' => 'View Users',
                    'page' => '/dashboard/users'
                ],

            ]
        ],
        */
        // Contact
        [
            'title' => 'Contact',
            'icon' => 'media/svg/icons/Communication/Incoming-mail.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    [
                        'title' => 'Contact Us',
                        'bullet' => 'dot',
                        'root' => true,
                        'submenu' => [
                            [
                                'title' => 'View Contacts',
                                'page' => "/dashboard/contact"
                            ],
                        ]
                    ],
                ],
            ]
        ],
        //Pages
        [
            'title' => 'Pages',
            'icon' => 'media/svg/icons/General/Duplicate.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    [
                        'title' => 'Terms',
                        'bullet' => 'dot',
                        'root' => true,
                        'submenu' => [
                            [
                                'title' => 'Update Terms',
                                'page' => "/dashboard/terms"
                            ],
                            [
                                'title' => 'View Terms',
                                'page' => "terms"
                            ]
                        ]
                    ],
                    [
                        'title' => 'Privacy&Policy',
                        'bullet' => 'dot',
                        'root' => true,
                        'submenu' => [
                            [
                                'title' => 'Update Privacy&Policy',
                                'page' => "/dashboard/PPolicy"
                            ],
                            [
                                'title' => 'View Privacy&Policy',
                                'page' => "PPolicy"
                            ]
                        ]
                    ],
                ],
            ]
        ],
        //Settings
        [
            'title' => 'Settings',
            'icon' => 'media/svg/icons/General/Settings-2.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'View Setting',
                    'page' => '/dashboard/settings',

                ]

            ]
        ],

    ]

];
