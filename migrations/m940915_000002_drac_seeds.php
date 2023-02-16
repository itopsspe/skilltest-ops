<?php

use yii\db\Migration;

class m940915_000002_drac_seeds extends Migration
{
    public function up()
    {
        $initialAuth = Yii::$app->params['initial_auth'];
        
        Yii::$app->db->createCommand()->batchInsert($initialAuth['item'], ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at'], [
            ['/#', 2, NULL, NULL, NULL, '1567564434', '1567564434'],
            ['/admin/blank/default/index', 2, NULL, NULL, NULL, '1567563908', '1567563908'],
            ['/admin/default/index', 2, NULL, NULL, NULL, '1567563908', '1567563908'],
            ['/admin/log/application/detail', 2, NULL, NULL, NULL, '1567563905', '1567563905'],
            ['/admin/log/application/index', 2, NULL, NULL, NULL, '1567563905', '1567563905'],
            ['/admin/log/default/index', 2, NULL, NULL, NULL, '1567563905', '1567563905'],
            ['/admin/log/login/index', 2, NULL, NULL, NULL, '1567563906', '1567563906'],
            ['/admin/rbac/assignment/assign', 2, NULL, NULL, NULL, '1567563906', '1567563906'],
            ['/admin/rbac/assignment/index', 2, NULL, NULL, NULL, '1567563906', '1567563906'],
            ['/admin/rbac/assignment/revoke', 2, NULL, NULL, NULL, '1567563906', '1567563906'],
            ['/admin/rbac/assignment/view', 2, NULL, NULL, NULL, '1567563906', '1567563906'],
            ['/admin/rbac/default/index', 2, NULL, NULL, NULL, '1567563906', '1567563906'],
            ['/admin/rbac/menu/create', 2, NULL, NULL, NULL, '1567563906', '1567563906'],
            ['/admin/rbac/menu/delete', 2, NULL, NULL, NULL, '1567563906', '1567563906'],
            ['/admin/rbac/menu/index', 2, NULL, NULL, NULL, '1567563906', '1567563906'],
            ['/admin/rbac/menu/update', 2, NULL, NULL, NULL, '1567563906', '1567563906'],
            ['/admin/rbac/permission/assign', 2, NULL, NULL, NULL, '1567563906', '1567563906'],
            ['/admin/rbac/permission/create', 2, NULL, NULL, NULL, '1567563906', '1567563906'],
            ['/admin/rbac/permission/delete', 2, NULL, NULL, NULL, '1567563906', '1567563906'],
            ['/admin/rbac/permission/index', 2, NULL, NULL, NULL, '1567563906', '1567563906'],
            ['/admin/rbac/permission/remove', 2, NULL, NULL, NULL, '1567563906', '1567563906'],
            ['/admin/rbac/permission/update', 2, NULL, NULL, NULL, '1567563906', '1567563906'],
            ['/admin/rbac/permission/view', 2, NULL, NULL, NULL, '1567563906', '1567563906'],
            ['/admin/rbac/role/assign', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/role/create', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/role/delete', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/role/index', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/role/remove', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/role/update', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/role/view', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/route/assign', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/route/create', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/route/index', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/route/refresh', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/route/remove', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/rule/create', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/rule/delete', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/rule/index', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/rule/update', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/rule/view', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/user/create', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/user/delete', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/user/index', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/user/update', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/rbac/user/detail', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/setting/default/index', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/admin/setting/under-maintenance/index', 2, NULL, NULL, NULL, '1567563907', '1567563907'],
            ['/change-password/index', 2, NULL, NULL, NULL, '1567694957', '1567694957'],
            ['/debug/default/db-explain', 2, NULL, NULL, NULL, '1567563908', '1567563908'],
            ['/debug/default/download-mail', 2, NULL, NULL, NULL, '1567563908', '1567563908'],
            ['/debug/default/index', 2, NULL, NULL, NULL, '1567563908', '1567563908'],
            ['/debug/default/toolbar', 2, NULL, NULL, NULL, '1567563908', '1567563908'],
            ['/debug/default/view', 2, NULL, NULL, NULL, '1567563908', '1567563908'],
            ['/debug/user/reset-identity', 2, NULL, NULL, NULL, '1567563908', '1567563908'],
            ['/debug/user/set-identity', 2, NULL, NULL, NULL, '1567563908', '1567563908'],
            ['/error/index', 2, NULL, NULL, NULL, '1567563908', '1567563908'],
            ['/forgot-password/index', 2, NULL, NULL, NULL, '1567694957', '1567694957'],
            ['/forgot-password/proceed', 2, NULL, NULL, NULL, '1567694957', '1567694957'],
            ['/gii/default/action', 2, NULL, NULL, NULL, '1567563908', '1567563908'],
            ['/gii/default/diff', 2, NULL, NULL, NULL, '1567563908', '1567563908'],
            ['/gii/default/index', 2, NULL, NULL, NULL, '1567563908', '1567563908'],
            ['/gii/default/preview', 2, NULL, NULL, NULL, '1567563908', '1567563908'],
            ['/gii/default/view', 2, NULL, NULL, NULL, '1567563908', '1567563908'],
            ['/home/index', 2, NULL, NULL, NULL, '1567563908', '1567563908'],
            ['/language/index', 2, NULL, NULL, NULL, '1567694957', '1567694957'],
            ['/login/index', 2, NULL, NULL, NULL, '1567563908', '1567563908'],
            ['/logout/index', 2, NULL, NULL, NULL, '1567694957', '1567694957'],
            ['Development', 1, 'Development Access', NULL, NULL, '1567564398', '1567564398'],
            ['log_application', 2, 'Log - Application', NULL, NULL, '1567694978', '1567694978'],
            ['log_login', 2, 'Log - Login', NULL, NULL, '1567695011', '1567695011'],
            ['rbac_assignment', 2, 'RBAC - Assignment', NULL, NULL, '1567564235', '1567564235'],
            ['rbac_menu', 2, 'RBAC - Menu', NULL, NULL, '1567564342', '1567564342'],
            ['rbac_permission', 2, 'RBAC - Permission', NULL, NULL, '1567564288', '1567564288'],
            ['rbac_role', 2, 'RBAC - Role', NULL, NULL, '1567564262', '1567564262'],
            ['rbac_route', 2, 'RBAC - Route', NULL, NULL, '1567564315', '1567564315'],
            ['rbac_user', 2, 'RBAC - User', NULL, NULL, '1567564364', '1567564364'],
            ['setting_under_maintenance', 2, 'Setting - Under Maintenance', NULL, NULL, '1567564364', '1567564364'],
            ['welcome', 2, 'Welcome Page', NULL, NULL, '1567706881', '1567706881']
        ])->execute();

        Yii::$app->db->createCommand()->batchInsert($initialAuth['item_child'], ['parent', 'child'], [
            ['Development', 'log_application'],
            ['Development', 'log_login'],
            ['Development', 'rbac_assignment'],
            ['Development', 'rbac_menu'],
            ['Development', 'rbac_permission'],
            ['Development', 'rbac_role'],
            ['Development', 'rbac_route'],
            ['Development', 'rbac_user'],
            ['Development', 'setting_under_maintenance'],
            ['Development', 'welcome'],
            ['log_application', '/admin/log/application/detail'],
            ['log_application', '/admin/log/application/index'],
            ['log_login', '/admin/log/login/index'],
            ['rbac_assignment', '/admin/rbac/assignment/assign'],
            ['rbac_assignment', '/admin/rbac/assignment/index'],
            ['rbac_assignment', '/admin/rbac/assignment/revoke'],
            ['rbac_assignment', '/admin/rbac/assignment/view'],
            ['rbac_menu', '/admin/rbac/menu/create'],
            ['rbac_menu', '/admin/rbac/menu/delete'],
            ['rbac_menu', '/admin/rbac/menu/index'],
            ['rbac_menu', '/admin/rbac/menu/update'],
            ['rbac_permission', '/admin/rbac/permission/assign'],
            ['rbac_permission', '/admin/rbac/permission/create'],
            ['rbac_permission', '/admin/rbac/permission/delete'],
            ['rbac_permission', '/admin/rbac/permission/index'],
            ['rbac_permission', '/admin/rbac/permission/remove'],
            ['rbac_permission', '/admin/rbac/permission/update'],
            ['rbac_permission', '/admin/rbac/permission/view'],
            ['rbac_role', '/admin/rbac/role/assign'],
            ['rbac_role', '/admin/rbac/role/create'],
            ['rbac_role', '/admin/rbac/role/delete'],
            ['rbac_role', '/admin/rbac/role/index'],
            ['rbac_role', '/admin/rbac/role/remove'],
            ['rbac_role', '/admin/rbac/role/update'],
            ['rbac_role', '/admin/rbac/role/view'],
            ['rbac_route', '/admin/rbac/route/assign'],
            ['rbac_route', '/admin/rbac/route/create'],
            ['rbac_route', '/admin/rbac/route/index'],
            ['rbac_route', '/admin/rbac/route/refresh'],
            ['rbac_route', '/admin/rbac/route/remove'],
            ['rbac_user', '/admin/rbac/user/create'],
            ['rbac_user', '/admin/rbac/user/delete'],
            ['rbac_user', '/admin/rbac/user/index'],
            ['rbac_user', '/admin/rbac/user/detail'],
            ['rbac_user', '/admin/rbac/user/update'],
            ['setting_under_maintenance', '/admin/setting/under-maintenance/index'],
            ['welcome', '/admin/default/index']
        ])->execute();

        Yii::$app->db->createCommand()->batchInsert($initialAuth['menu'], ['id', 'name', 'parent', 'route', 'order', 'icon', 'data'], [
            [1, 'RBAC', NULL, '/admin/rbac/assignment/index', 1, 'fa fa-key', NULL],
            [2, 'Log', NULL, NULL, 2, 'fa fa-database', NULL],
            [3, 'Application', 2, '/admin/log/application/index', 1, 'fa fa-database', NULL],
            [4, 'Login', 2, '/admin/log/login/index', 2, 'fa fa-database', NULL],
            [5, 'Setting', NULL, NULL, 3,  'fa fa-cogs', NULL],
            [6, 'Under Maintenance', 5, '/admin/setting/under-maintenance/index', 1, 'fa fa-cogs', NULL]
        ])->execute();

        Yii::$app->db->createCommand()->batchInsert($initialAuth['user'], ['id', 'name', 'username', 'email', 'auth_key', 'password_hash', 'password_reset_token',  'status', 'last_login_datetime', 'created_datetime', 'updated_datetime'], [
            [1, 'David Rivaldy', 'david', 'admin@admin.com', NULL, '$2y$13$JJtgiguD5tiE/NK5h.kyLObMjJIK9WAMyow8P6BEcItw3r6qjfbuK', NULL, 'active', '2019-09-17 08:25:50', '2018-11-05 09:24:36', '2019-09-17 15:25:50'],
        ])->execute();

        Yii::$app->db->createCommand()->batchInsert($initialAuth['assignment'], ['item_name', 'user_id', 'created_at'], [
            ['Development', '1', '1567564412']
        ])->execute();

        Yii::$app->db->createCommand()->batchInsert('under_maintenance', ['id', 'status', 'updated_at'], [
            [1, 0, '1994-09-15 00:00:00']
        ])->execute();
    }
}
