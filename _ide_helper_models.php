<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $priority
 * @property string $status
 * @property int|null $user_story_id
 * @property int|null $feature_id
 * @property int|null $sprint_id
 * @property int $reporter_id
 * @property int|null $assignee_id
 * @property string|null $steps_to_reproduce
 * @property string|null $expected_behavior
 * @property string|null $actual_behavior
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $assignee
 * @property-read \App\Models\Feature|null $feature
 * @property-read \App\Models\User $reporter
 * @property-read \App\Models\Sprint|null $sprint
 * @property-read \App\Models\Task|null $userStory
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug whereActualBehavior($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug whereAssigneeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug whereExpectedBehavior($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug whereFeatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug whereReporterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug whereSprintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug whereStepsToReproduce($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bug whereUserStoryId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperBug {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int|null $value_score
 * @property string|null $quarter
 * @property int|null $year
 * @property string $status
 * @property int $program_id
 * @property \Illuminate\Support\Carbon|null $target_date
 * @property numeric|null $budget
 * @property numeric|null $prognose
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Epic> $epics
 * @property-read int|null $epics_count
 * @property-read \App\Models\Program $program
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TestCase> $testCases
 * @property-read int|null $test_cases_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $userStories
 * @property-read int|null $user_stories_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessGoal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessGoal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessGoal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessGoal whereBudget($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessGoal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessGoal whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessGoal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessGoal wherePrognose($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessGoal whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessGoal whereQuarter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessGoal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessGoal whereTargetDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessGoal whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessGoal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessGoal whereValueScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessGoal whereYear($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperBusinessGoal {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $business_goal_id
 * @property string $priority
 * @property numeric|null $expected_value
 * @property string $status
 * @property int|null $story_points
 * @property \Illuminate\Support\Carbon|null $target_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BusinessGoal $businessGoal
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Feature> $features
 * @property-read int|null $features_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Note> $notes
 * @property-read int|null $notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $userStories
 * @property-read int|null $user_stories_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Epic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Epic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Epic query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Epic whereBusinessGoalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Epic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Epic whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Epic whereExpectedValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Epic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Epic wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Epic whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Epic whereStoryPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Epic whereTargetDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Epic whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Epic whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperEpic {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $epic_id
 * @property string|null $pi
 * @property string|null $sprint
 * @property string $status
 * @property int|null $story_points
 * @property \Illuminate\Support\Carbon|null $target_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bug> $bugs
 * @property-read int|null $bugs_count
 * @property-read \App\Models\Epic $epic
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TestCase> $testCases
 * @property-read int|null $test_cases_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $userStories
 * @property-read int|null $user_stories_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feature query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feature whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feature whereEpicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feature wherePi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feature whereSprint($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feature whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feature whereStoryPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feature whereTargetDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feature whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feature whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperFeature {}
}

namespace App\Models{
/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $entity_type
 * @property int|null $entity_id
 * @property string $body
 * @property int|null $user_id
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent|null $entity
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperNote {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $strategic_goals
 * @property numeric|null $business_value
 * @property string|null $owner
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BusinessGoal> $businessGoals
 * @property-read int|null $business_goals_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Note> $notes
 * @property-read int|null $notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $projects
 * @property-read int|null $projects_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereBusinessValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereOwner($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereStrategicGoals($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperProgram {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property int $created_by
 * @property int|null $program_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $createdBy
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Note> $notes
 * @property-read int|null $notes_count
 * @property-read \App\Models\Program|null $program
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sprint> $sprints
 * @property-read int|null $sprints_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read int|null $tasks_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperProject {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property int $sprint_number
 * @property int $project_id
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property int $planned_story_points
 * @property int $completed_story_points
 * @property numeric $completion_percentage
 * @property string $status
 * @property string|null $goals
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bug> $bugs
 * @property-read int|null $bugs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Note> $notes
 * @property-read int|null $notes_count
 * @property-read \App\Models\Project $project
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $userStories
 * @property-read int|null $user_stories_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereCompletedStoryPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereCompletionPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereGoals($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint wherePlannedStoryPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereSprintNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sprint whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperSprint {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $priority
 * @property \Illuminate\Support\Carbon|null $due_date
 * @property int|null $project_id
 * @property int|null $assigned_to
 * @property int|null $sprint_id
 * @property int|null $feature_id
 * @property int|null $epic_id
 * @property int|null $business_goal_id
 * @property int|null $story_points
 * @property string|null $acceptance_criteria
 * @property string|null $definition_of_done
 * @property string $kanban_status
 * @property int $kanban_order
 * @property array<array-key, mixed>|null $tags
 * @property \Illuminate\Support\Carbon|null $started_at
 * @property \Illuminate\Support\Carbon|null $completed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $assignedTo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bug> $bugs
 * @property-read int|null $bugs_count
 * @property-read \App\Models\BusinessGoal|null $businessGoal
 * @property-read \App\Models\Epic|null $epic
 * @property-read \App\Models\Feature|null $feature
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Note> $notes
 * @property-read int|null $notes_count
 * @property-read \App\Models\Project|null $project
 * @property-read \App\Models\Sprint|null $sprint
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TestCase> $testCases
 * @property-read int|null $test_cases_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereAcceptanceCriteria($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereAssignedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereBusinessGoalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereDefinitionOfDone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereEpicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereFeatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereKanbanOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereKanbanStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereSprintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereStoryPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperTask {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $expected_result
 * @property string|null $actual_result
 * @property string $status
 * @property int|null $business_goal_id
 * @property int|null $feature_id
 * @property int|null $user_story_id
 * @property int|null $tester_id
 * @property \Illuminate\Support\Carbon|null $test_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BusinessGoal|null $businessGoal
 * @property-read \App\Models\Feature|null $feature
 * @property-read \App\Models\User|null $tester
 * @property-read \App\Models\Task|null $userStory
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TestCase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TestCase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TestCase query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TestCase whereActualResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TestCase whereBusinessGoalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TestCase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TestCase whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TestCase whereExpectedResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TestCase whereFeatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TestCase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TestCase whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TestCase whereTestDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TestCase whereTesterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TestCase whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TestCase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TestCase whereUserStoryId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperTestCase {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $type
 * @property string|null $kvk_nummer
 * @property string|null $bedrijfsnaam
 * @property string|null $telefoon
 * @property string|null $adres
 * @property string|null $postcode
 * @property string|null $plaats
 * @property string|null $land
 * @property string|null $btw_nummer
 * @property string|null $iban
 * @property string|null $website
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bug> $assignedBugs
 * @property-read int|null $assigned_bugs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $assignedTasks
 * @property-read int|null $assigned_tasks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $createdProjects
 * @property-read int|null $created_projects_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bug> $reportedBugs
 * @property-read int|null $reported_bugs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TestCase> $testCases
 * @property-read int|null $test_cases_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAdres($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBedrijfsnaam($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBtwNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIban($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereKvkNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePlaats($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTelefoon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

