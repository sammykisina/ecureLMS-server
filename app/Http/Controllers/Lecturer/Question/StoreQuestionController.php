<?php

declare(strict_types=1);

namespace App\Http\Controllers\Lecturer\Question;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lecturer\QuestionStoreRequest;
use App\Http\Resources\TaskResource;
use App\Http\Services\Lecturer\TaskQnService;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class StoreQuestionController extends Controller {
    public function __invoke(
        QuestionStoreRequest $request,
        TaskQnService $taskQnService,
    ): JsonResponse {
        DB::beginTransaction();
        try {
            $question = $taskQnService->createTaskQn(newTaskQnData: $request->getNewTaskQnData());

            foreach ($request->get(key: "answers") as $answer) {
                $taskQnService->createTaskQnAnswer([
                    'identity' => $answer['identity'],
                    'answer' => $answer['answer'],
                    'question_id' => $question->id
                ]);
            }

            $task = Task::query()
                    ->with(['unit', 'questions.answers'])
                    ->where('id', $request->get(key: 'task_id'))
                    ->first();

            if ($task->numberOfQuestions == count($task->questions)) {
                $task->update([
                    'published' => true,
                    'dueDate' => Carbon::now()->addDays($task->numberOfValidDays)
                ]);
            }

            DB::commit();

            return response()->json(
                data: [
                    'error' => 0,
                    'task' => new TaskResource(
                        resource: $task
                    ),
                    'message' => 'Question Created Successfully.'
                ],
                status: Http::CREATED()
            );
        } catch (\Throwable $th) {
            Log::info($th);
            DB::rollBack();
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Question not created.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
