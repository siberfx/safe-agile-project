<?php

namespace App\Http\Controllers\Admin;

use App\Models\Program;
use App\Models\BusinessGoal;
use App\Models\Epic;
use App\Models\Feature;
use App\Models\Sprint;
use App\Models\Task;
use App\Models\Bug;
use App\Models\TestCase;

class SystemController extends AdminBaseController
{
    public function index()
    {
        return view('admin.index');
    }

    public function stakeholderDashboard()
    {
        // High-level KPIs and roadmap view
        $programs = Program::with(['businessGoals', 'projects'])->get();
        $businessGoals = BusinessGoal::with(['epics'])->get();
        
        return view('admin.dashboard.stakeholder', compact('programs', 'businessGoals'));
    }

    public function projectManagerDashboard()
    {
        // Sprint board, velocity charts, operational view
        $sprints = Sprint::with(['userStories', 'bugs'])->get();
        $activeSprint = Sprint::where('status', 'active')->first();
        $bugs = Bug::with(['userStory', 'assignee'])->get();
        
        return view('admin.dashboard.project-manager', compact('sprints', 'activeSprint', 'bugs'));
    }

    public function teamDashboard()
    {
        // Kanban board, my tasks, test cases
        $userStories = Task::where('agile_status', '!=', 'done')
            ->with(['feature', 'epic', 'sprint'])
            ->get();
        $myTasks = Task::where('assigned_to', auth()->id())->get();
        $testCases = TestCase::where('tester_id', auth()->id())->get();
        
        return view('admin.dashboard.team', compact('userStories', 'myTasks', 'testCases'));
    }

    public function kanbanBoard()
    {
        // Kanban board for User Stories
        $toDoStories = Task::where('agile_status', 'to_do')->with(['feature', 'epic'])->get();
        $inProgressStories = Task::where('agile_status', 'in_progress')->with(['feature', 'epic'])->get();
        $readyForTestStories = Task::where('agile_status', 'ready_for_test')->with(['feature', 'epic'])->get();
        $approvedStories = Task::where('agile_status', 'approved')->with(['feature', 'epic'])->get();
        $doneStories = Task::where('agile_status', 'done')->with(['feature', 'epic'])->get();
        
        return view('admin.kanban.index', compact(
            'toDoStories', 
            'inProgressStories', 
            'readyForTestStories', 
            'approvedStories', 
            'doneStories'
        ));
    }

    public function sprintReports()
    {
        // Sprint reports and velocity charts
        $sprints = Sprint::with(['userStories'])->orderBy('created_at', 'desc')->get();
        
        return view('admin.reports.sprints', compact('sprints'));
    }

    public function quarterlyReports()
    {
        // Quarterly business value realization reports
        $businessGoals = BusinessGoal::with(['epics.features.userStories'])->get();
        
        return view('admin.reports.quarterly', compact('businessGoals'));
    }

    public function kpiDashboard()
    {
        // KPI dashboard with charts
        $programs = Program::with(['businessGoals'])->get();
        $velocityData = Sprint::selectRaw('sprint_number, completed_story_points')
            ->orderBy('sprint_number')
            ->get();
        
        return view('admin.reports.kpi', compact('programs', 'velocityData'));
    }
}
