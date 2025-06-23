<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Получаем текущего админа
        $admin = Auth::guard('admin')->user();
        
        if (!$admin) {
            return redirect()->route('login')->with('error', 'Требуется авторизация администратора');
        }

        // Получаем параметры поиска
        $search = $request->input('search');
        $searchBy = $request->input('search_by', 'username'); // по умолчанию ищем по имени пользователя

        // Получаем номера страниц из запроса
        $activePage = $request->input('active_page', 1);
        $deletedPage = $request->input('deleted_page', 1);
        $tab = $request->input('tab', 'active-users');

        // Базовые запросы с поиском
        $activeUsersQuery = User::whereNull('deleted_at');
        $deletedUsersQuery = User::onlyTrashed();

        // Применяем поиск если есть поисковый запрос
        if ($search) {
            $searchTerm = '%' . $search . '%';
            if ($searchBy === 'email') {
                $activeUsersQuery->where('email', 'LIKE', $searchTerm);
                $deletedUsersQuery->where('email', 'LIKE', $searchTerm);
            } else {
                $activeUsersQuery->where('username', 'LIKE', $searchTerm);
                $deletedUsersQuery->where('username', 'LIKE', $searchTerm);
            }
        }

        // Получаем активных пользователей
        $activeUsers = $activeUsersQuery
            ->orderBy('created_at', 'desc')
            ->paginate(100, ['*'], 'active_page', $activePage)
            ->appends(['search' => $search, 'search_by' => $searchBy]);

        // Получаем удаленных пользователей
        $deletedUsers = $deletedUsersQuery
            ->orderBy('deleted_at', 'desc')
            ->paginate(100, ['*'], 'deleted_page', $deletedPage)
            ->appends(['search' => $search, 'search_by' => $searchBy]);


            

        // Добавляем отладочную информацию
        \Log::info('Search term: ' . $search);
        \Log::info('Search by: ' . $searchBy);
        \Log::info('Active Users Count: ' . $activeUsers->count());
        \Log::info('Deleted Users Count: ' . $deletedUsers->count());
        
        return view('users.index', compact('admin', 'activeUsers', 'deletedUsers', 'tab', 'search', 'searchBy'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    
        return redirect()->back()->with('success', "User account {$user->username} has been deleted.");
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
    
        return redirect()->back()->with('success', "User account {$user->username} has been restored.");
    }
}
