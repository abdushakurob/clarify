<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Test route to check authentication
Route::get('/test-auth', function() {
    if (auth()->check()) {
        return 'Authenticated as: ' . auth()->user()->email;
    }
    return 'Not authenticated';
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    if (!$user) {
        return redirect()->route('login');
    }
    
    return view('dashboard', [
        'activeProjects' => $user->projects()->whereIn('status', ['todo', 'in_progress'])->count(),
        'tasksDueToday' => $user->tasks()->whereDate('due_date', today())->count(),
        'recentIdeas' => $user->ideas()->where('created_at', '>=', now()->subDays(7))->count(),
        'completedTasks' => $user->tasks()->where('status', 'done')->count(),
        'upcomingTasks' => $user->tasks()
            ->with('project')
            ->whereIn('status', ['todo', 'in_progress'])
            ->whereNotNull('due_date')
            ->orderBy('due_date')
            ->limit(5)
            ->get(),
        'recentProjects' => $user->projects()
            ->withCount('tasks')
            ->latest()
            ->limit(5)
            ->get(),
    ]);
})->middleware(['web', 'auth'])->name('dashboard');

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Ideas routes
    Route::resource('ideas', IdeaController::class);
    
    // Projects routes
    Route::resource('projects', ProjectController::class);
    Route::post('/projects/{project}/features', [ProjectController::class, 'addFeature'])->name('projects.features.add');
    Route::delete('/projects/{project}/features/{feature}', [ProjectController::class, 'removeFeature'])->name('projects.features.remove');
    
    // Tasks routes
    Route::resource('tasks', TaskController::class);
});

require __DIR__.'/auth.php';
