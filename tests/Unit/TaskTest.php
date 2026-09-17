<?php

namespace Tests\Unit;

use App\Models\Task;
use Carbon\Carbon;
use Tests\TestCase;

class TaskTest extends TestCase
{
    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    public function test_a_pending_task_with_a_past_due_date_is_overdue(): void
    {
        Carbon::setTestNow('2026-09-17 12:00:00');

        $task = new Task([
            'status' => Task::STATUS_PENDING,
            'due_date' => '2026-09-16',
        ]);

        $this->assertTrue($task->isOverdue());
    }

    public function test_a_completed_task_is_not_overdue(): void
    {
        Carbon::setTestNow('2026-09-17 12:00:00');

        $task = new Task([
            'status' => Task::STATUS_COMPLETED,
            'due_date' => '2026-09-16',
        ]);

        $this->assertFalse($task->isOverdue());
    }

    public function test_a_task_due_today_is_not_overdue(): void
    {
        Carbon::setTestNow('2026-09-17 12:00:00');

        $task = new Task([
            'status' => Task::STATUS_PENDING,
            'due_date' => '2026-09-17',
        ]);

        $this->assertFalse($task->isOverdue());
    }

    public function test_a_task_without_a_due_date_is_not_overdue(): void
    {
        $task = new Task([
            'status' => Task::STATUS_PENDING,
            'due_date' => null,
        ]);

        $this->assertFalse($task->isOverdue());
    }
}
