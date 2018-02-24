<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Menu;

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
        DB::table('do_logs') -> delete();
        DB::table('user_roles') -> delete();
    	DB::table('users') -> delete();
        User::create(['id'=>1,'user_name'=>'admin','password'=>bcrypt('admin')]);
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
        Menu::create(['id'=>1,'menu_name'=>'后台首页','menu_url'=>'/admin/index', 'menu_icon'=>'fa fa-home', 'parent_id'=>0, 'sort'=>0]);
        Menu::create(['id'=>2,'menu_name'=>'系统设置','menu_url'=>'/admin/system', 'menu_icon'=>'fa fa-gear', 'parent_id'=>0, 'sort'=>999]);
        Menu::create(['id'=>3,'menu_name'=>'菜单管理','menu_url'=>'/admin/menu', 'menu_icon'=>'fa fa-th-list', 'parent_id'=>2, 'sort'=>999]);
        Menu::create(['id'=>4,'menu_name'=>'用户管理','menu_url'=>'/admin/user', 'menu_icon'=>'fa fa-user-secret', 'parent_id'=>0, 'sort'=>1]);
        Menu::create(['id'=>5,'menu_name'=>'角色管理','menu_url'=>'/admin/role', 'menu_icon'=>'fa fa-group', 'parent_id'=>0, 'sort'=>2]);
    }
}