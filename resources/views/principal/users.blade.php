<!-- resources/views/child.blade.php -->
@extends('principal.app')

@section('content')

<div class="overflow-x-auto">
    @if($users->isEmpty())
    <div class="flex flex-col items-center justify-center">
        <div class="flex flex-col items-center justify-center">
            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900">No users found</h3>
            <p class="mt-1 text-sm text-gray-500">
                Get started by creating a new user.
            </p>
            <div class="mt-6">
                <a href="/register"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700">
                    Create new user
                </a>
            </div>
        </div>
    </div>
@else
    <table class="min-w-full  rounded-2xl divide-y-2 divide-gray-200 bg-white text-sm">
      <thead class="ltr:text-left rtl:text-right">
        <tr>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"># id</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Email</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Phone</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Role</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Is active</th>
          <th class="px-4 py-2"></th>
        </tr>
      </thead>
  
      <tbody class="divide-y divide-gray-200">
        @foreach ($users as $user)
            <tr>
                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $user->id }}</td>
                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $user->name }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $user->email }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $user->phone }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $user->role }}</td>
                @if ($user->is_active)
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        <div class="relative">
                            <span class="absolute top-0 left-5 transform -translate-y-1/2 w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                        </div>
                    </td>
                @else
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        <div class="relative">
                            <span class="absolute top-0 left-5 transform -translate-y-1/2 w-3.5 h-3.5 bg-red-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                        </div>
                    </td>
                @endif                
            </tr>
        @endforeach
    </tbody>
    </table>
    @endif
    <div style="display: none" id="modalDelete">
        <x-delete-modal />
    </div>
  </div>
 @endsection



