<div class="modal">
  <form id="updateForm" action="/edit" method="POST">
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
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <div class="md:col-span-5">
                  <label for="full_name">Name</label>
                  <input type="text" name="name" id="user_name"
                      class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" value="{{ old('name') }}"/>
              </div>
              <div class="md:col-span-5">
                  <label for="full_name">Email</label>
                  <input type="text" name="email" id="user_email"
                      class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" value="{{ old('email') }}"/>
              </div>
              <div class="small flex gap-2">
                  <div class="md:col-span-5">
                      <label for="full_name">Phone</label>
                      <input type="text" name="phone" id="user_phone"
                          class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" value="{{ old('phone') }}"/>
                  </div>
                  <div class="md:col-span-5">
                      <label for="full_name">Role</label>
                      <input type="text" name="role" id="user_role"
                          class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" value="{{ old('role') }}"/>
                  </div>
              </div>

              <div class="buttons flex justify-end items-end">
                <button id="edit" type="submit"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    Aceptar
                </button>
            </div>
          </a>
      </article>
  </form>

  <div class="alert absolute top-0">
      @include('components.alert-modal', ['message' => 'Error personalizad'])
  </div>
</div>

<style>
  .modal {
      position: fixed;
      top: 0;
      left: 0;
      z-index: 9999;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      justify-content: center;
      align-items: center;
  }
</style>

<script>
document.getElementById('edit').addEventListener('click', function() {
    var userEmail = document.getElementById('user_email').placeholder;
    var form = document.getElementById('updateForm');
    form.action = '/edit/' + userEmail;
});
</script>
