<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;


Route::get('/ping', function(){
    return ['pong' => true];
});
Route::get('/unauthenticated', function() {
    return ['error' => 'Usuário não está logado.'];
})->name('login');

Route::post('/user', [AuthController::class, 'create']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->post('/auth/logout', [AuthController::class, 'logout']);

Route::middleware('auth:api')->get('/auth/me', [AuthController::class, 'me']);

// CRUD do todo
// POST /todo = Inserir uma tarefa no sistema
// GET /todos = Ler todas as tarefas do sistema
// GET /todo/2 = Ler uma tarefa específica do sistema
// PUT /todo/2 = Atualizar uma tarefa no sistema
// DELETE /todo/2 = Deletar uma tarefa no sistema

Route::middleware('auth:api')->post('/todo', [ApiController::class, 'createTodo']);
Route::get('/todos', [ApiController::class, 'readAllTodos']);
Route::get('/todo/{id}', [ApiController::class, 'readTodo']);
Route::middleware('auth:api')->put('/todo/{id}', [ApiController::class, 'updateTodo']);
Route::middleware('auth:api')->delete('/todo/{id}', [ApiController::class, 'deleteTodo']);