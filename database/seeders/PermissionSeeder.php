<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category Permissions
        Permission::create(['name' => 'create category']);
        Permission::create(['name' => 'read category']);
        Permission::create(['name' => 'update category']);
        Permission::create(['name' => 'delete category']);

        // ContactUs Permissions
        Permission::create(['name' => 'create contactus']);
        Permission::create(['name' => 'read contactus']);
        Permission::create(['name' => 'update contactus']);
        Permission::create(['name' => 'delete contactus']);

        // File Permissions
        Permission::create(['name' => 'create file']);
        Permission::create(['name' => 'read file']);
        Permission::create(['name' => 'update file']);
        Permission::create(['name' => 'delete file']);

        // FileGallery Permissions
        Permission::create(['name' => 'create file_gallery']);
        Permission::create(['name' => 'read file_gallery']);
        Permission::create(['name' => 'update file_gallery']);
        Permission::create(['name' => 'delete file_gallery']);

        // FilePost Permissions
        Permission::create(['name' => 'create file_post']);
        Permission::create(['name' => 'read file_post']);
        Permission::create(['name' => 'update file_post']);
        Permission::create(['name' => 'delete file_post']);

        // Gallery Permissions
        Permission::create(['name' => 'create gallery']);
        Permission::create(['name' => 'read gallery']);
        Permission::create(['name' => 'update gallery']);
        Permission::create(['name' => 'delete gallery']);

        // Menu Permissions
        Permission::create(['name' => 'create menu']);
        Permission::create(['name' => 'read menu']);
        Permission::create(['name' => 'update menu']);
        Permission::create(['name' => 'delete menu']);

        // Organization Permissions
        Permission::create(['name' => 'create organization']);
        Permission::create(['name' => 'read organization']);
        Permission::create(['name' => 'update organization']);
        Permission::create(['name' => 'delete organization']);

        // Post Permissions
        Permission::create(['name' => 'create post']);
        Permission::create(['name' => 'read post']);
        Permission::create(['name' => 'update post']);
        Permission::create(['name' => 'delete post']);

        // PostOrganization Permissions
        Permission::create(['name' => 'create post_organization']);
        Permission::create(['name' => 'read post_organization']);
        Permission::create(['name' => 'update post_organization']);
        Permission::create(['name' => 'delete post_organization']);

        // PostTag Permissions
        Permission::create(['name' => 'create post_tag']);
        Permission::create(['name' => 'read post_tag']);
        Permission::create(['name' => 'update post_tag']);
        Permission::create(['name' => 'delete post_tag']);

        // SocialMedia Permissions
        Permission::create(['name' => 'create social_media']);
        Permission::create(['name' => 'read social_media']);
        Permission::create(['name' => 'update social_media']);
        Permission::create(['name' => 'delete social_media']);

        // Tag Permissions
        Permission::create(['name' => 'create tag']);
        Permission::create(['name' => 'read tag']);
        Permission::create(['name' => 'update tag']);
        Permission::create(['name' => 'delete tag']);

        // Team Permissions
        Permission::create(['name' => 'create team']);
        Permission::create(['name' => 'read team']);
        Permission::create(['name' => 'update team']);
        Permission::create(['name' => 'delete team']);

        // Testimony Permissions
        Permission::create(['name' => 'create testimony']);
        Permission::create(['name' => 'read testimony']);
        Permission::create(['name' => 'update testimony']);
        Permission::create(['name' => 'delete testimony']);

        // User Permissions
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'read user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        // Visitor Permissions
        Permission::create(['name' => 'create visitor']);
        Permission::create(['name' => 'read visitor']);
        Permission::create(['name' => 'update visitor']);
        Permission::create(['name' => 'delete visitor']);

        // VisitorLog Permissions
        Permission::create(['name' => 'create visitor_log']);
        Permission::create(['name' => 'read visitor_log']);
        Permission::create(['name' => 'update visitor_log']);
        Permission::create(['name' => 'delete visitor_log']);
    }
}
