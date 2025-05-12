
# 📝 Task Management Application

Welcome to the Task Management App! This simple yet powerful tool allows you to manage users, projects, and tasks with drag-and-drop prioritization.

## 🚀 Getting Started

Follow these steps to get up and running:

### 1. Run the Seeder
After logging in for the first time, **run the database seeder**:

```bash
php artisan db:seed
```

This will populate the app with a default admin user.

### 2. Log In

Use the following credentials to log in:

- **Email:** `user@gmail.com`
- **Username:** `Super User`
- **Password:** `password`

> ⚠️ Make sure you run the seeder first, or this account won’t exist.

---

## 🛠️ App Usage Flow

### ✅ Step 1: Create a User
After logging in:
- Navigate to the **Users** section.
- Create a new user.
- Don’t forget to **activate** the user after creation.

### 📁 Step 2: Create a Project
Head over to the **Projects** section and create your first project.

### 📋 Step 3: Create a Task
On the **Home page**, start creating tasks under your project.

- When a task is created, it **has no priority assigned yet**.

### 📌 Step 4: Prioritize Tasks
To assign priorities:
- **Drag and drop** tasks to reorder them.
- The order you arrange them in determines their priority.

### ✔️ Step 5: Manage Tasks
Once tasks are in place:
- **Mark them as completed** when done.
- Or, **delete** them if they’re no longer needed.

---

## 💡 Tips
- Priorities are dynamic — you can always rearrange tasks later.
- Completed tasks are visually marked for easy tracking.

---

Enjoy managing your workflow more effectively!
