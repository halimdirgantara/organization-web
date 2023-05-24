<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SyncRoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::find(1);
        $adminSKPD = Role::find(2);
        $editor = Role::find(3);
        $verifikator = Role::find(3);


        $superAdmin->syncPermissions([
            'create category','read category','update category','delete category','create contactus', 'read contactus','update contactus', 'delete contactus','create file'
            ,'read file','update file','delete file','create file_gallery','read file_gallery','update file_gallery','delete file_gallery','create file_post'
            ,'read file_post','update file_post','delete file_post','create gallery','read gallery','update gallery','delete gallery','create menu'
            ,'read menu','update menu','delete menu','create organization','read organization','update organization','delete organization','create post'
            ,'read post','update post','delete post','create post_organization','read post_organization','update post_organization','delete post_organization','create post_tag'
            ,'read post_tag','update post_tag','delete post_tag','create social_media','read social_media','update social_media','delete social_media','create tag'
            ,'read tag','update tag','delete tag','create team','read team','update team','delete team','create testimony'
            ,'read testimony','update testimony','delete testimony','create user','read user','update user','delete user','create visitor'
            ,'read visitor','update visitor','delete visitor','create visitor_log','read visitor_log','update visitor_log','delete visitor_log',
        ]);
        $adminSKPD->syncPermissions([
            'read category','read contactus','update contactus','create file','read file','update file','delete file','create gallery','read gallery',
            'update gallery','delete gallery','create post','read post','update post','delete post','create post_organization','read post_organization',
            'update post_organization','delete post_organization','create social_media','read social_media','update social_media','delete social_media','create tag','read tag',
            'update tag','delete tag','create team','read team','update team','delete team','read testimony','update testimony',
            'create user','read user','update user','read visitor','read visitor_log',
        ]);
        $editor->syncPermissions([
            'create file',
            'read file',
            'update file',            
            'create file_post',
            'read file_post',
            'update file_post',
            'delete file_post',
            'create post',
            'read post',
            'update post',
            'delete post',
            'create post_tag',
            'read post_tag',
            'update post_tag',
            'delete post_tag',
            'create tag',
            'read tag',
            'update tag',
        ]);
        $verifikator->syncPermissions([
            'create file',
            'read file',
            'update file',            
            'create file_post',
            'read file_post',
            'update file_post',
            'delete file_post',
            'create post',
            'read post',
            'update post',
            'delete post',
            'create post_tag',
            'read post_tag',
            'update post_tag',
            'delete post_tag',
            'create tag',
            'read tag',
            'update tag',
        ]);
    }
}
