<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Menu;
use App\SystemInfo;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SystemInfosTableSeeder::class);
        $this->call(MenusTableSeeder::class);
    }
}

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles') -> delete();
    	DB::table('users') -> delete();
        User::create(['id'=>1,'user_name'=>'admin','password'=>bcrypt('admin')]);
    }
}

class SystemInfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_infos')->delete();
        SystemInfo::create(['id'=>1,'info_name'=>'company_name','info_value'=>'杭州派兹坊网络科技有限公司', 'info_desc'=>'公司名称']);
        SystemInfo::create(['id'=>2,'info_name'=>'icp_number','info_value'=>'', 'info_desc'=>'备案号']);
        SystemInfo::create(['id'=>3,'info_name'=>'right_time','info_value'=>'2014-2018', 'info_desc'=>'版权时间']);
        SystemInfo::create(['id'=>4,'info_name'=>'index_seo','info_value'=>'', 'info_desc'=>'首页关键字']);
    }
}

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus') -> delete();
        Menu::create(['id'=>1,'menu_name'=>'后台首页', 'power_name'=>'index', 'menu_url'=>'/admin/home', 
            'menu_icon'=>'fa fa-home', 'parent_id'=>0, 'sort'=>0, 'is_show'=>1]);
        Menu::create(['id'=>2,'menu_name'=>'用户管理', 'power_name'=>'index', 'menu_url'=>'/admin/user', 
            'menu_icon'=>'fa fa-user-secret', 'parent_id'=>0, 'sort'=>1, 'is_show'=>1]);
        Menu::create(['id'=>3,'menu_name'=>'添加用户', 'power_name'=>'add', 'menu_url'=>'/admin/user/create', 
            'menu_icon'=>'fa fa-circle-o', 'parent_id'=>2, 'sort'=>1, 'is_show'=>0]);
        Menu::create(['id'=>4,'menu_name'=>'编辑用户', 'power_name'=>'edit', 'menu_url'=>'/admin/user/{id}', 
            'menu_icon'=>'fa fa-circle-o', 'parent_id'=>2, 'sort'=>1, 'is_show'=>0]);
        Menu::create(['id'=>5,'menu_name'=>'删除用户', 'power_name'=>'delete', 'menu_url'=>'/admin/user/{id}/delete', 
            'menu_icon'=>'fa fa-circle-o', 'parent_id'=>2, 'sort'=>1, 'is_show'=>0]);
        Menu::create(['id'=>6,'menu_name'=>'角色管理', 'power_name'=>'index', 'menu_url'=>'/admin/role', 
            'menu_icon'=>'fa fa-group', 'parent_id'=>0, 'sort'=>2, 'is_show'=>1]);
        Menu::create(['id'=>7,'menu_name'=>'添加角色', 'power_name'=>'add', 'menu_url'=>'/admin/role/create', 
            'menu_icon'=>'fa fa-circle-o', 'parent_id'=>6, 'sort'=>2, 'is_show'=>0]);
        Menu::create(['id'=>8,'menu_name'=>'编辑角色', 'power_name'=>'edit', 'menu_url'=>'/admin/role/{id}', 
            'menu_icon'=>'fa fa-circle-o', 'parent_id'=>6, 'sort'=>2, 'is_show'=>0]);
        Menu::create(['id'=>9,'menu_name'=>'删除角色', 'power_name'=>'delete', 'menu_url'=>'/admin/role/{id}/delete', 
            'menu_icon'=>'fa fa-circle-o', 'parent_id'=>6, 'sort'=>2, 'is_show'=>0]);
        Menu::create(['id'=>10,'menu_name'=>'授权管理', 'power_name'=>'power', 'menu_url'=>'/admin/role/{id}/power', 
            'menu_icon'=>'fa fa-circle-o', 'parent_id'=>6, 'sort'=>2, 'is_show'=>0]);
        Menu::create(['id'=>11,'menu_name'=>'系统设置', 'power_name'=>'index', 'menu_url'=>'/admin/system', 
            'menu_icon'=>'fa fa-gear', 'parent_id'=>0, 'sort'=>999, 'is_show'=>1]);
        Menu::create(['id'=>12,'menu_name'=>'菜单管理', 'power_name'=>'index', 'menu_url'=>'/admin/menu', 
            'menu_icon'=>'fa fa-th-list', 'parent_id'=>11, 'sort'=>999, 'is_show'=>1]);
        Menu::create(['id'=>13,'menu_name'=>'添加菜单', 'power_name'=>'add', 'menu_url'=>'/admin/menu/create', 
            'menu_icon'=>'fa fa-circle-o', 'parent_id'=>12, 'sort'=>999, 'is_show'=>0]);
        Menu::create(['id'=>14,'menu_name'=>'编辑菜单', 'power_name'=>'edit', 'menu_url'=>'/admin/menu/{id}', 
            'menu_icon'=>'fa fa-circle-o', 'parent_id'=>12, 'sort'=>999, 'is_show'=>0]);
        Menu::create(['id'=>15,'menu_name'=>'删除菜单', 'power_name'=>'delete', 'menu_url'=>'/admin/menu/{id}/delete', 
            'menu_icon'=>'fa fa-circle-o', 'parent_id'=>12, 'sort'=>999, 'is_show'=>0]);
        Menu::create(['id'=>16,'menu_name'=>'系统信息', 'power_name'=>'index', 'menu_url'=>'/admin/system_info', 
            'menu_icon'=>'fa fa-info-circle', 'parent_id'=>11, 'sort'=>999, 'is_show'=>1]);
    }
}