# Multi-User Blog Platform

A robust, multi-user blogging platform built with Laravel where authenticated users can write and manage their content while keeping public readers engaged. The application demonstrates core backend development patterns including role-based authorization, route middleware, and strict data ownership.

## 📌 Project Overview

This platform separates user experiences based on authentication and verification layers:
* **All Visitors:** Can discover, view, and read published blog posts and check author information.
* **Authenticated Users:** Can write, edit, and delete their own draft posts.
* **Verified Users:** Hold the exclusive privilege to officially publish posts live to the public.

An automated policy framework strictly enforces content ownership, preventing users from editing or modifying posts created by other authors.

---

## 🎓 Learning Objectives

By exploring or building this project, you will master the following concepts:

### Laravel Core
* **Authorization & Policies:** Enforcing backend business rules and data ownership.
* **Route Middleware:** Restricting page access based on user state (Guest vs. Auth vs. Verified).
* **Public vs. Private Routes:** Mapping public viewability against secure mutation endpoints.
* **Email Verification:** Implementing activation gates for advanced features.
* **Sessions & Flash Messages:** Persisting temporary status alerts between HTTP requests.

### Fundamental Concepts
* **PHP Patterns:** Utilizing native Enums and explicit authorization helper checks.
* **Database Strategy:** Managing indexation, unique constraints, and conditional publication states via nullable timestamps.

---

## 🚀 Features

### Public Features (All Visitors)
* [x] **Global Feed:** View all published blog posts.
* [x] **Deep Dive:** View a single, detailed blog post layout.
* [x] **Author Profiles:** View basic author attribution details.

### Authenticated Features (Logged-In Users)
* [x] **Draft Engine:** Create new post entries.
* [x] **Owner Modification:** Edit personal blog posts.
* [x] **Owner Erasure:** Delete personal blog posts safely.

### Verified User Features (Activated Accounts)
* [x] **Go Live:** Transition any personal post from draft to a published state.

---

## 🛠️ Technical Specifications

### Database Schema
The database uses a single primary `posts` table structurally linked to Laravel's default `users` engine.

#### `posts` Table Structure

| Column | Type | Attributes | Notes |
| :--- | :--- | :--- | :--- |
| `id` | `bigint` | `Primary Key`, `Auto-Increment` | Unique post identifier |
| `user_id` | `bigint` | `Foreign Key` | Links to the authoring `users.id` |
| `title` | `string` | `Indexed` | The post headline |
| `slug` | `string` | `Unique` | URL-friendly title representation |
| `excerpt` | `text` | - | Brief summary for feeds |
| `body` | `longText` | - | Full markdown or HTML rich body text |
| `published_at`| `timestamp` | `Nullable` | `NULL` represents a draft status |
| `created_at` | `timestamp` | - | System creation record tracking |
| `updated_at` | `timestamp` | - | System mutation record tracking |

### Data Relationships & Performance
* **User Relationship:** `User` hasMany `Posts` (An author can write many articles).
* **Post Relationship:** `Post` belongsTo `User` (Each article traces back to one author).
* **Optimized Table Indexes:** Performance optimizations are implemented on `title`, `slug`, and `published_at` columns to support rapid searching and high-speed query sorting.

---

## 🛣️ Routing Architecture

Secured operations leverage implicit binding, Resource controllers, and a localized patch route endpoint.

```php
// Standard CRUD Operations for Posts
Route::resource('posts', PostController::class);

// Advanced Post Publication State
Route::patch('/posts/{post}/publish', [PostController::class, 'publish'])->name('posts.publish');
```

| Method | URI | Action | Route Name | Access Level |
| :--- | :--- | :--- | :--- | :--- |
| **GET** | `/posts` | `index` | `posts.index` | Public |
| **GET** | `/posts/{post}` | `show` | `posts.show` | Public |
| **GET** | `/posts/create` | `create` | `posts.create` | Authenticated |
| **POST** | `/posts` | `store` | `posts.store` | Authenticated |
| **GET** | `/posts/{post}/edit` | `edit` | `posts.edit` | Authenticated (Owner Only) |
| **PUT/PATCH**| `/posts/{post}` | `update` | `posts.update` | Authenticated (Owner Only) |
| **DELETE** | `/posts/{post}` | `destroy` | `posts.destroy` | Authenticated (Owner Only) |
| **PATCH** | `/posts/{post}/publish` | `publish` | `posts.publish`| Verified (Owner Only) |

---

## 🎯 Stretch Goals

Planned enhancements for future iterations of this platform include:
* 💬 **Comments:** Give authenticated readers the ability to comment on posts.
* 📁 **Categories:** Organize posts under distinct operational topics.
* 🏷️ **Tags:** Add flexible cross-cutting keyword tags.
* ❤️ **Likes:** Implement a system for micro-interactions and liking posts.
* ⏱️ **Reading Time:** Provide algorithmic read-time indicators (e.g., "5 min read").
* ⭐ **Featured Posts:** Allow administrators to pin prominent content at the top of the feed.

## Getting Started

Clone the project and install the dependencies:

```bash
composer install
npm install
```

Create your environment file:

```bash
cp .env.example .env
php artisan key:generate
```

Run the database migrations:

```bash
php artisan migrate
```

Start the development server:

```bash
php artisan serve
```

In a separate terminal, start Vite:

```bash
npm run dev
```

Then visit:

```text
http://127.0.0.1:8000/
```
