<!-- resources/views/child.blade.php -->
@extends('principal.app')
@section('content')
    <div class="modal grid grid-cols-2">
        <form id="updateForm" method="POST">
            @csrf
            <article class="cont gap-10 flex">
                <a class="relative block bg-white overflow-hidden rounded-lg border border-gray-100 p-4 sm:p-6 lg:p-8">
                    <div class="sm:flex sm:justify-between sm:gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 sm:text-xl">
                                Editar usuario <span class="username"></span>
                            </h3>

                        

                            <p class="mt-1 text-xs font-medium text-gray-600"><span id="nombreUsuario"></span></p>
                        </div>

                        <button type="button" id="closeModal"
                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="popup-modal">
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="md:col-span-5">
                        <label for="full_name">Name</label>
                        <input type="text" name="name" id="user_name"
                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 @error('name') border-red-500 @enderror" 
                            value="{{ old('name') }}" />
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-5">
                        <label for="full_name">Email</label>

                        <input type="text" name="email" id="user_email"
                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 @error('email') border-red-500 @enderror" 
                            value="{{ old('email') }}" />
                        
                        @error('email')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="small flex gap-2">
                        <div class="md:col-span-5">
                            <label for="full_name">Phone</label>
                            <input type="text" name="phone" id="user_phone"
                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 @error('phone') border-red-500 @enderror" 
                                value="{{ old('phone') }}" />
                            @error('phone')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-5">
                            <label for="full_name">Role</label>
                            <input type="text" name="role" id="user_role"
                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 @error('role') border-red-500 @enderror"
                                value="{{ old('role') }}" />

                            @error('role')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="buttons flex justify-end items-end">
                        <button id="edit"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Aceptar
                        </button>
                    </div>
                </a>
            </article>
        </form>

        <div class="tables">
            <div class="overflow-x-auto">
                @if ($users->isEmpty())
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
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $user->id }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $user->name }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $user->email }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $user->phone }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $user->role }}</td>
                                    @if ($user->is_active)
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                            <div class="relative">
                                                <span
                                                    class="absolute top-0 left-5 transform -translate-y-1/2 w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                                            </div>
                                        </td>
                                    @else
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                            <div class="relative">
                                                <span
                                                    class="absolute top-0 left-5 transform -translate-y-1/2 w-3.5 h-3.5 bg-red-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                                            </div>
                                        </td>
                                    @endif
                                    <td class="whitespace-nowrap px-4 py-2">
                                        <a
                                            class="inline-block rounded bg-indigo-600 px-2 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                            <svg
                                                id="edit_usuario"
                                                class="cursor-pointer refillUser" user_id="{{ $user->id }}"
                                                user_name="{{ $user->name }}" user_email="{{ $user->email }}"
                                                user_phone="{{ $user->phone }}" user_role="{{ $user->role }}"
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg>
                                        </a>
                                        <a
                                            class="inline-block rounded bg-red-600 px-2 py-2 text-xs font-medium text-white hover:bg-red-700">
                                            <svg
                                                class="mostrarModalDelete cursor-pointer" user = "{{ $user->name }}"
                                                id="{{ $user->id }}" xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor"
                                                class="bi bi-trash2-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.037 3.225A.7.7 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2a.7.7 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671zm9.89-.69C10.966 2.214 9.578 2 8 2c-1.58 0-2.968.215-3.926.534-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466-.18-.14-.498-.307-.975-.466z" />
                                            </svg>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <div style="display: none" id="modalDelete">
                    <x-delete-modal />
                </div>
            </div>
        </div>
    </div>


    <script>
document.addEventListener('DOMContentLoaded', function() {
    const roleInput = document.getElementById('user_role');
    const nameInput = document.getElementById('user_name');
    const emailInput = document.getElementById('user_email');
    const phoneInput = document.getElementById('user_phone');
    const submitEdit = document.getElementById('edit');
    const editButton = document.getElementById('edit_usuario');

    function updateInputStatus() {
        const anyInputHasValue = roleInput.value.trim() !== '' || nameInput.value.trim() !== '' ||
            emailInput.value.trim() !== '' || phoneInput.value.trim() !== '';

        roleInput.disabled = !anyInputHasValue;
        nameInput.disabled = !anyInputHasValue;
        emailInput.disabled = !anyInputHasValue;
        phoneInput.disabled = !anyInputHasValue;
        submitEdit.disabled = !anyInputHasValue;
    }

    updateInputStatus();

    editButton.addEventListener('click', function() {
        // Enable all inputs when the "Edit" button is clicked
        roleInput.disabled = false;
        nameInput.disabled = false;
        emailInput.disabled = false;
        phoneInput.disabled = false;
        submitEdit.disabled = false;
    });

    // Listen for input changes and update the status accordingly
    roleInput.addEventListener('input', updateInputStatus);
    nameInput.addEventListener('input', updateInputStatus);
    emailInput.addEventListener('input', updateInputStatus);
    phoneInput.addEventListener('input', updateInputStatus);
});



        var idUser
        document.getElementById('edit').addEventListener('click', function() {
            var id = getId()
            var form = document.getElementById('updateForm');
            url = '/edit/user/' + id;
            form.action = url;
            form.submit();
        });


        const buttonsRefillUser = document.querySelectorAll('.refillUser');
        const buttonsDelete = document.querySelectorAll('.mostrarModalDelete');

        function refillUser(event) {
            if (setData(event)) {
                setData(event);
            }
        }

        function cerrarModal() {
            document.getElementById('modal').style.display = 'none';
        }

        function showModalDelete(event) {
            const idUser = event.target.getAttribute('id');
            const user = event.target.getAttribute('user');
            document.getElementById('user_id').innerHTML = idUser;
            if(idUser){
                document.getElementById('modalDelete').style.display = 'block';
            }
        }

        function cerrarModalDelete() {
            document.getElementById('modalDelete').style.display = 'none';
        }

        function setData(event) {
            const nombreUsuario = event.target.getAttribute('user_name');
            const emailUsuario = event.target.getAttribute('user_email');
            const phoneUsuario = event.target.getAttribute('user_phone');
            const roleUsuario = event.target.getAttribute('user_role');
            const idUsuario = event.target.getAttribute('user_id');

            document.getElementById('user_id').innerHTML = nombreUsuario;
            const elementoUsername = document.querySelector('.username');
            elementoUsername.innerHTML = nombreUsuario;
            setId(idUsuario)
            
            if (nombreUsuario) {
                document.getElementById('user_name').placeholder = nombreUsuario;
                document.getElementById('user_email').placeholder = emailUsuario;
                document.getElementById('user_phone').placeholder = phoneUsuario;
                document.getElementById('user_role').placeholder = roleUsuario;
                return true;
            }
        }

        function setId(id){
            idUser = id
        }
        function getId(){
            return idUser
        }
        buttonsRefillUser.forEach(button => {
            button.addEventListener('click', refillUser);
        });

        buttonsDelete.forEach(button => {
            button.addEventListener('click', showModalDelete);
        });

        document.getElementById('closeModal').addEventListener('click', cerrarModal);
        document.getElementById('closeDelete').addEventListener('click', cerrarModalDelete);
        document.getElementById('delete').addEventListener('click', deleteUser);
    </script>

@endsection
