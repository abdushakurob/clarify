# Clarify App – Project Plan

## 1. Core Entities & Relationships

- **Idea**
  - Fields: title, notes, status, tags
  - Can be linked to other ideas (self-referencing many-to-many)
  - Can be clarified (problem, audience, solution)
  - Can be marked “ready” to become a Project

- **Project**
  - Created from an Idea
  - Has features and tasks
  - Has tags/categories
  - Tracks progress (todo, in progress, done)

- **Task**
  - Belongs to a Project
  - Has status and can be scheduled (calendar)

- **Log**
  - Types: Daily, Future, Progress
  - Linked to ideas/projects/tasks

- **Tag**
  - Used for Ideas and Projects (many-to-many)

## 2. Main Features & Flow

- **Ideas Inbox**
  - Quick capture of ideas (title, notes, tags)
  - Link ideas together
  - Clarify ideas (add context)
  - Mark as ready → becomes a project

- **Project Builder**
  - Define features and tasks
  - Assign tags/categories
  - Track progress

- **Logs**
  - Daily: Journal thoughts
  - Future: Dump ideas not ready for action
  - Progress: Updates on projects

- **Calendar View**
  - Assign tasks to time blocks
  - Visualize tasks/projects on a calendar

## 3. How Everything Connects

- Ideas are the starting point. You capture them quickly, clarify them, and link them to other ideas.
- When an idea is ready, you convert it into a project.
- Projects are broken down into features and tasks.
- Tasks can be scheduled and tracked via the calendar.
- Logs help you reflect, plan, and track progress.
- Tags help you organize and filter ideas/projects.

## 4. Technical Structure

- **Models:** Idea, Project, Task, Log, Tag (+ pivot tables)
- **Controllers:** IdeaController, ProjectController, TaskController, LogController
- **Views:** Blade templates for each feature (ideas, projects, logs, calendar)
- **Routes:** Resource routes for each main entity
- **Database:** Migrations for all tables and relationships


//RANDOM STUFFS THAT ARENT IN THE PLAN AND CAN BE IMPLEMENTED LATER

- Create TODOs for your projects
- Manage the todos