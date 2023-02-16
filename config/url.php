<?php

return [
    /* ===== LANGUAGE ===== */
    '/language/<language:\w+>'                                              => '/language/index',

    /* ===== HOME ===== */
    '/'                                                                     => '/home/index',

    /* ===== ACCESS ===== */
    '/login'                                                                => '/login/index',
    '/logout'                                                               => '/logout/index',
    '/forgot-password'                                                      => '/forgot-password/index',
    '/forgot-password/proceed/<key>'                                        => '/forgot-password/proceed',
    '/change-password/<key>'                                                => '/change-password/index',

    /* ==== Employees ==== */
    '/employees'                                                            => '/admin/employees/employees/index',
    '/employees/view'                                                       => '/admin/employees/employees/view',

    /* ===== ADMIN | RBAC ===== */
    '/admin/rbac/assignment/<page:\d+>'                                     => '/admin/rbac/assignment/index',
    '/admin/rbac/assignment'                                                => '/admin/rbac/assignment/index',
    '/admin/rbac/assignment/view/<id:\d+>'                                  => '/admin/rbac/assignment/view',
    '/admin/rbac/role/<page:\d+>'                                           => '/admin/rbac/role/index',
    '/admin/rbac/role'                                                      => '/admin/rbac/role/index',
    '/admin/rbac/role/view/<id:\w+>'                                        => '/admin/rbac/role/view',
    '/admin/rbac/permission/<page:\d+>'                                     => '/admin/rbac/permission/index',
    '/admin/rbac/permission'                                                => '/admin/rbac/permission/index',
    '/admin/rbac/permission/view/<id:\w+>'                                  => '/admin/rbac/permission/view',
    '/admin/rbac/route'                                                     => '/admin/rbac/route/index',
    '/admin/rbac/user'                                                      => '/admin/rbac/user/index',
    '/admin/rbac/user/detail/<id:\d+>'                                      => '/admin/rbac/user/detail',
    '/admin/rbac/user/update/<id:\d+>'                                      => '/admin/rbac/user/update',
    '/admin/rbac/user/delete/<id:\d+>'                                      => '/admin/rbac/user/delete',
    '/admin/rbac/user/<page:\d+>'                                           => '/admin/rbac/user/index',
    '/admin/rbac/menu/<page:\d+>'                                           => '/admin/rbac/menu/index',
    '/admin/rbac/menu'                                                      => '/admin/rbac/menu/index',
    '/admin/rbac/menu/update/<id:\d+>'                                      => '/admin/rbac/menu/update',

    /* ===== ADMIN | Log ===== */
    '/admin/log/application'                                                => '/admin/log/application/index',
    '/admin/log/application/detail/<id:\d+>'                                => '/admin/log/application/detail',
    '/admin/log/login'                                                      => '/admin/log/login/index',

    /* ===== ADMIN | Setting ===== */
    '/admin/setting/under-maintenance'                                      => '/admin/setting/under-maintenance/index',
    '/admin/setting/under-maintenance/<status:\d+>'                         => '/admin/setting/under-maintenance/index',

];
