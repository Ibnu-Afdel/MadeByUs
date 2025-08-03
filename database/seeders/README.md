# Laravel Seeders & Factories Documentation

This directory contains comprehensive seeders and factories for the MadeByUs project, following Laravel industry best practices.

## 🏗️ Architecture Overview

### Factories
- **UserFactory**: Enhanced with social login states and avatar generation
- **ProjectFactory**: Complete project generation with multiple states (featured, approved, pending, etc.)
- **CommentFactory**: Realistic comment generation with different types (technical, positive, questions)

### Seeders
- **RoleAndPermissionSeeder**: Complete role-based permission system
- **UserSeeder**: Users with different roles and authentication methods  
- **ProjectSeeder**: Projects with realistic data and tags
- **CommentSeeder**: Comments distributed across projects based on engagement patterns
- **DatabaseSeeder**: Orchestrates all seeders in proper order

## 🚀 Quick Start

### Run All Seeders
```bash
php artisan db:seed
```

### Run Individual Seeders
```bash
php artisan db:seed --class=RoleAndPermissionSeeder
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=ProjectSeeder
php artisan db:seed --class=CommentSeeder
```

### Fresh Migration + Seeding
```bash
php artisan migrate:fresh --seed
```

## 👥 User Accounts Created

### Admin Accounts
- **Super Admin**: `superadmin@madebyus.com` (password: `password`)
- **Admin**: `admin@madebyus.com` (password: `password`)
- **Moderator**: `moderator@madebyus.com` (password: `password`)
- **Moderator 2**: `mod2@madebyus.com` (password: `password`)

### Test Accounts
- **Regular User**: `test@example.com` (password: `password`)
- **Premium User**: `premium@example.com` (password: `password`)
- **GitHub User**: `github@example.com` (password: `password`)
- **Google User**: `google@example.com` (password: `password`)

### Generated Users
- 5 Premium users with avatars
- 20 Regular users
- 8 Social login users (GitHub, Google, Twitter, Facebook)
- 3 Unverified users

## 🎯 Roles & Permissions

### Roles Hierarchy
1. **Super Admin** - All permissions
2. **Admin** - Most permissions except super admin specific
3. **Moderator** - Content moderation focused
4. **Premium** - Enhanced user privileges
5. **User** - Basic user permissions
6. **Guest** - Very limited permissions

### Permission Categories
- **Projects**: create, edit, delete, approve, reject, feature, priority
- **Comments**: create, edit, delete, moderate
- **Users**: manage users, roles, permissions
- **System**: admin panel access, file manager, settings

## 📁 Projects Data

### Featured Projects (3 projects)
1. **Advanced Laravel E-commerce Platform** (4,750 views)
   - Tags: Laravel, PHP, E-commerce, Stripe, MySQL, Vue.js
   - Status: Approved, Priority
   
2. **Real-time Chat Application** (3,250 views)
   - Tags: Node.js, React, Socket.io, JavaScript, MongoDB
   - Status: Approved
   
3. **AI-Powered Task Management Dashboard** (2,180 views)
   - Tags: Python, Django, Machine Learning, AI, PostgreSQL
   - Status: Approved, Priority

### Project Distribution
- **Approved**: ~40 projects (including featured and popular)
- **Pending**: ~23 projects (15 recent, 8 older)
- **Rejected**: ~5 projects
- **Priority**: ~10 projects total

### Tags System
Comprehensive tag system with:
- Technology tags (PHP, Laravel, JavaScript, Python, etc.)
- Framework tags (Vue.js, React, Django, etc.)
- Database tags (MySQL, PostgreSQL, MongoDB, etc.)
- Category tags (Web Development, Mobile App, AI, etc.)
- Type tags (Open Source, Commercial, Beginner Friendly, etc.)

## 💬 Comments System

### Comment Distribution
- **Featured Projects**: 8-15 comments each (mix of technical, positive, questions)
- **Popular Projects**: 3-8 comments each
- **Regular Projects**: 0-8 comments each (some have no comments)
- **Recent Projects**: 1-5 comments each

### Comment Types
- **Technical**: Detailed technical discussions and architecture feedback
- **Positive**: Short positive feedback and encouragement
- **Questions**: User questions about implementation, features, etc.
- **General**: Mixed feedback and suggestions

## 🏭 Factory Usage Examples

### Creating Users
```php
// Basic user
User::factory()->create();

// User with avatar
User::factory()->withAvatar()->create();

// Social login user
User::factory()->socialLogin('github')->create();

// Unverified user
User::factory()->unverified()->create();
```

### Creating Projects
```php
// Basic project
Project::factory()->create();

// Featured project
Project::factory()->featured()->create();

// Approved project with high views
Project::factory()->approved()->popular()->create();

// Pending priority project
Project::factory()->pending()->priority()->create();

// Recent project
Project::factory()->recent()->create();
```

### Creating Comments
```php
// Basic comment
Comment::factory()->create();

// Technical comment
Comment::factory()->technical()->create();

// Positive feedback
Comment::factory()->positive()->create();

// Question comment
Comment::factory()->question()->create();

// Recent comment
Comment::factory()->recent()->create();
```

## 🔧 Customization

### Adding New Permissions
Edit `RoleAndPermissionSeeder.php` and add to the `$permissions` array:
```php
$permissions = [
    // ... existing permissions
    'your new permission',
];
```

### Adding New Roles
Edit the `createRoles()` method in `RoleAndPermissionSeeder.php`:
```php
$newRole = Role::firstOrCreate(['name' => 'New Role']);
$newRole->givePermissionTo(['permission1', 'permission2']);
```

### Customizing Project Tags
Edit the `createTags()` method in `ProjectSeeder.php` to add your tags.

### Adjusting Data Volumes
Modify the count parameters in each seeder:
```php
// In ProjectSeeder.php
Project::factory()->count(25) // Change this number
```

## 📊 Database Statistics

After seeding, you'll have approximately:
- **Users**: ~45 users across all roles
- **Projects**: ~65 projects with various statuses
- **Comments**: ~200-300 comments distributed across projects
- **Tags**: ~65 predefined tags
- **Roles**: 6 roles with hierarchical permissions
- **Permissions**: ~25 granular permissions

## 🧪 Testing Factory States

The factories include comprehensive state methods for testing different scenarios:

```php
// Test featured project workflow
$project = Project::factory()->featured()->create();

// Test user role assignment
$user = User::factory()->create();
$user->assignRole('Premium');

// Test comment moderation
$comment = Comment::factory()->technical()->create();
```

## 📝 Best Practices Implemented

1. **Factory States**: Multiple states for different scenarios
2. **Relationship Management**: Proper foreign key handling
3. **Data Consistency**: Realistic data relationships
4. **Performance**: Efficient bulk creation with `recycle()`
5. **Flexibility**: Easy customization and extension
6. **Documentation**: Comprehensive inline documentation
7. **Error Handling**: Graceful fallbacks for missing data
8. **Reporting**: Detailed statistics after seeding

## 🎓 Learning Objectives

This seeder implementation demonstrates:

- **Factory Design Patterns**: State methods, traits, relationships
- **Database Relationships**: One-to-many, many-to-many with pivot data
- **Role-Based Access Control**: Complete RBAC implementation
- **Data Modeling**: Realistic data distribution and relationships
- **Performance Optimization**: Efficient database operations
- **Testing Data**: Comprehensive test scenarios
- **Laravel Best Practices**: Following framework conventions

## 🚨 Production Considerations

- **Never run `db:seed` in production** - use specific seeders only
- **Backup your database** before running seeders
- **Review generated data** before going live
- **Customize default passwords** for security
- **Adjust data volumes** based on your needs

---

*This seeder system provides a solid foundation for development, testing, and learning Laravel's factory and seeder capabilities.* 