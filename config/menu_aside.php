<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Web Site',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ],

/*
|--------------------------------------------------------------------------
| FAQS (Frequently Asked Questions Section)
|--------------------------------------------------------------------------
*/
        [
            'title' => 'FAQS',
            'icon' => 'media/svg/icons/Communication/Group-chat.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add FAQ',
                    'page' => "/dashboard/faqs/create"
                ],
                [
                    'title' => 'View FAQS',
                    'page' => '/dashboard/faqs'
                ],

            ]
        ],
        [
            'title' => 'Insurances',
            'icon' => 'media/svg/icons/General/Shield-check.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Insurance companies',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add Insurance',
                            'page' => "/dashboard/insurance/create"
                        ],
                        [
                            'title' => 'View Insurance',
                            'page' => '/dashboard/insurance'
                        ],

                    ]
                ],
                [
                    'title' => 'Insurance offers',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add offer',
                            'page' => "/dashboard/insurance-offer/create"
                        ],
                        [
                            'title' => 'View offers',
                            'page' => '/dashboard/insurance-offer'
                        ],

                    ]
                ],
                [
                    'title' => 'Offers plan',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add Plan',
                            'page' => "/dashboard/offer-plan/create"
                        ],
                        [
                            'title' => 'View Plans',
                            'page' => '/dashboard/offer-plan'
                        ],

                    ]
                ],

            ]
        ],
        [
            'title' => 'Agences',
            'icon' => 'fas fa-landmark',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Agency companies',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add agency',
                            'page' => "/dashboard/agency/create"
                        ],
                        [
                            'title' => 'View agencies',
                            'page' => '/dashboard/agency'
                        ],

                    ]
                ],

            ]
        ],
        [
            'title' => 'Location',
            'icon' => 'fas fa-map-marked-alt',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Countries',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add Country',
                            'page' => "/dashboard/country/create"
                        ],
                        [
                            'title' => 'View Countries',
                            'page' => '/dashboard/country'
                        ],

                    ]
                ],
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
        [
            'title' => 'Cars Settings',
            'icon' => 'fas fa-car',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Car Make',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Add Car Make',
                            'page' => "/dashboard/car/maker/create"
                        ],
                        [
                            'title' => 'View Car Makers',
                            'page' => '/dashboard/car/maker'
                        ],

                    ]

                ],
                [
                    'title' => 'Car Model',
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
                    'title' => 'Car Options',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'Sell A car ',
                            'page' => "/dashboard/car/create"
                        ],
                        [
                            'title' => 'View Cars',
                            'page' => '/dashboard/car'
                        ],

                    ]
                ],
                [

                ],

            ]
        ],
        [
            'title' => 'Badges',
            'icon' => 'media/svg/icons/General/Star.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add Badge',
                    'page' => "/dashboard/badge/create"
                ],
                [
                    'title' => 'View Badges',
                    'page' => '/dashboard/badge'
                ],

            ]
        ],
        [
            'title' => 'Features',
            'icon' => 'fas fa-feather',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add Feature',
                    'page' => "/dashboard/feature/create"
                ],
                [
                    'title' => 'View Features',
                    'page' => '/dashboard/feature'
                ],

            ]
        ],
        [
            'title' => 'News',
            'icon' => 'far fa-newspaper',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add news',
                    'page' => "/dashboard/news/create"
                ],
                [
                    'title' => 'View news',
                    'page' => '/dashboard/news'
                ],

            ]
        ],
        [
            'title' => 'Categories',
            'icon' => 'fas fa-pager',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add category',
                    'page' => "/dashboard/category/create"
                ],
                [
                    'title' => 'View Categories',
                    'page' => '/dashboard/category'
                ],

            ]
        ],
        [
            'title' => 'Pages',
            'icon' => 'fas fa-scroll',
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
        [
            'title' => 'Finacne Requests',
            'icon' => 'fas fa-pencil-alt',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'View requests',
                    'page' => "/dashboard/finance-request"
                ],

            ]
        ],
        [
            'title' => 'Contact',
            'icon' => 'fas fa-phone-square-alt',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    [
                        'title' => 'Ask An Expert',
                        'bullet' => 'dot',
                        'root' => true,
                        'submenu' => [
                            [
                                'title' => 'View questions',
                                'page' => "/dashboard/AskExpert"
                            ],
                        ]
                    ],
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
        [
            'title' => 'roles & permissions',
            'icon' => 'media/svg/icons/General/Settings-1.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'roles',
                    'page' => '/dashboard/roles',

                ],
                [
                    'title' => 'permissions',
                    'page' => '/dashboard/permissions'
                ],

            ]
        ],
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
