<?php
declare(strict_types = 1);

namespace App\Composers\Constructors;

use App\Services\Auth\Auth;
use App\Services\Auth\Permissions;

class AdminBlockConstructor
{
    /**
     * @var Auth
     */
    private $auth;

    private $items;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
        $this->items = [
            [
                'title' => __('content.layout.shop.sidebar.admin.control.title'),
                'icon' => 'settings_applications',
                'subItems' => [
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.control.sub_items.main_settings'),
                        'permissions' => [Permissions::ADMIN_CONTROL_BASIC_ACCESS]
                    ],
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.control.sub_items.payments')
                    ],
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.control.sub_items.api')
                    ],
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.control.sub_items.security')
                    ],
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.control.sub_items.optimization')
                    ],
                ]
            ],
            [
                'title' => __('content.layout.shop.sidebar.admin.servers.title'),
                'icon' => 'storage',
                'subItems' => [
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.servers.sub_items.add')
                    ],
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.servers.sub_items.edit')
                    ],
                ]
            ],
            [
                'title' => __('content.layout.shop.sidebar.admin.products.title'),
                'icon' => 'apps',
                'subItems' => [
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.products.sub_items.add')
                    ],
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.products.sub_items.edit')
                    ],
                ]
            ],
            [
                'title' => __('content.layout.shop.sidebar.admin.items.title'),
                'icon' => 'beach_access',
                'subItems' => [
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.items.sub_items.add')
                    ],
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.items.sub_items.edit')
                    ],
                ]
            ],
            [
                'title' => __('content.layout.shop.sidebar.admin.news.title'),
                'icon' => 'library_books',
                'subItems' => [
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.news.sub_items.add')
                    ],
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.news.sub_items.add')
                    ],
                ]
            ],
            [
                'title' => __('content.layout.shop.sidebar.admin.pages.title'),
                'icon' => 'insert_drive_file',
                'subItems' => [
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.pages.sub_items.add')
                    ],
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.pages.sub_items.edit')
                    ],
                ]
            ],
            [
                'title' => __('content.layout.shop.sidebar.admin.users.title'),
                'icon' => 'people_outline',
                'subItems' => [
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.users.sub_items.edit')
                    ]
                ]
            ],
            [
                'title' => __('content.layout.shop.sidebar.admin.other.title'),
                'icon' => 'more_horiz',
                'subItems' => [
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.other.sub_items.rcon')
                    ],
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.other.sub_items.debug')
                    ],
                ]
            ],
            [
                'title' => __('content.layout.shop.sidebar.admin.statistic.title'),
                'icon' => 'show_chart',
                'subItems' => [
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.statistic.sub_items.show')
                    ],
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.statistic.sub_items.payments')
                    ],
                ]
            ],
            [
                'title' => __('content.layout.shop.sidebar.admin.info.title'),
                'icon' => 'info',
                'subItems' => [
                    [
                        'link' => 'https://github.com/D3lph1/L-shop/wiki',
                        'title' => __('content.layout.shop.sidebar.admin.info.sub_items.docs'),
                        'target' => '_blank'
                    ],
                    [
                        'link' => '',
                        'title' => __('content.layout.shop.sidebar.admin.info.sub_items.about'),
                        'permissions' => [Permissions::ADMIN_INFORMATION_ABOUT_ACCESS]
                    ],
                ]
            ]
        ];
    }

    public function construct(): array
    {
        if (!$this->auth->check()) {
            return [];
        }

        foreach ($this->items as $k => &$item) {
            foreach ($item['subItems'] as $key => &$subItem) {
                if (isset($subItem['permissions'])) {
                    if (!$this->auth->getUser()->hasAllPermission($subItem['permissions'])) {
                        unset($item['subItems'][$key]);
                    }
                }
            }

            if (count($item['subItems']) === 0) {
                unset($this->items[$k]);
            }
        }

        return $this->items;
    }
}