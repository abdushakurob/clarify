# Clarify Project TODOs

## 1. Ideas Inbox (COMPLETED)
- [X] Create Idea model, migration, and controller
- [X] Implement quick capture (title, notes, tags)
- [X] Allow linking ideas to each other
- [X] Set up tags system for ideas
    - [X] Create Tag model and migration
    - [X] Create idea_tag pivot table
    - [X] Implement tag relationships

## 2. Idea Clarification (COMPLETED)
- [X] Add fields for problem, audience, possible solution
- [X] Mark idea as "ready" to convert to a project
- [X] Add status tracking for ideas
- [X] Implement idea-to-project conversion flow

## 3. Project Builder (IN PROGRESS)
- [X] Create Project model, migration, and controller
- [X] Link projects to ideas
- [X] Create Task model and migration
- [X] Set up project-tag relationships
- [ ] Define project structure
    - [ ] Add UI for managing project features
    - [ ] Implement feature breakdown into tasks
    - [ ] Add task dependencies
- [ ] Implement progress tracking
    - [X] Add status fields (todo, in progress, done)
    - [ ] Add progress calculation
    - [ ] Add task completion tracking
- [ ] Custom fields
    - [X] Add tags/categories support
    - [ ] Add custom field definitions
    - [ ] Implement field validation

## 4. Task Management (IN PROGRESS)
- [X] Create Task model and migration
- [X] Set up project-task relationships
- [X] Implement basic task status (todo, in progress, done)
- [ ] Add task scheduling
    - [ ] Implement due dates
    - [ ] Add time estimation
    - [ ] Set up task priorities
- [ ] Task organization
    - [ ] Add task grouping
    - [ ] Implement task sorting
    - [ ] Add task filters

## 5. Logs (NOT STARTED)
- [ ] Create Log model, migration, and controller
- [ ] Set up log types
    - [ ] Daily Log (journal)
    - [ ] Future Log (idea dump)
    - [ ] Progress Log (project updates)
- [ ] Log features
    - [ ] Add timestamps and dating
    - [ ] Link logs to projects/ideas
    - [ ] Add log categories
    - [ ] Implement log search
    - [ ] Add log templates

## 6. Calendar View (NOT STARTED)
- [ ] Create calendar infrastructure
    - [ ] Set up calendar grid
    - [ ] Implement date navigation
- [ ] Task scheduling
    - [ ] Assign tasks to time blocks
    - [ ] Add drag-and-drop support
    - [ ] Implement task duration
- [ ] Calendar features
    - [ ] Add different view modes (day, week, month)
    - [ ] Implement recurring tasks
    - [ ] Add calendar export/import
    - [ ] Set up task reminders

## 7. User System and Authentication (IN PROGRESS)
- [X] Set up basic authentication
    - [X] User registration
    - [X] Login/logout
    - [X] Password reset
- [ ] User data isolation
    - [ ] Add user_id to ideas
    - [ ] Add user_id to projects
    - [ ] Add user_id to tasks
    - [ ] Add user_id to logs
    - [ ] Implement data access control
- [ ] User preferences
    - [ ] Add user settings
    - [ ] Theme preferences
    - [ ] Notification settings

## 8. UI/UX Implementation
- [ ] Create Blade views for all features
    - [ ] Dashboard view
    - [ ] Ideas management views
    - [ ] Project management views
    - [ ] Task management views
    - [ ] Calendar views
    - [ ] Log management views
- [ ] Implement modern UI components
    - [ ] Add responsive design
    - [ ] Implement dark/light mode
    - [ ] Add loading states
    - [ ] Implement error handling
- [ ] Enhanced features
    - [ ] Add search functionality
    - [ ] Implement filters
    - [ ] Add sorting options
    - [ ] Create data export options

## 9. API and Integration
- [ ] Create API endpoints
    - [ ] Ideas API
    - [ ] Projects API
    - [ ] Tasks API
    - [ ] Logs API
- [ ] Set up API authentication
- [ ] Add API documentation
- [ ] Implement webhooks
